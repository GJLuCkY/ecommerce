<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SEO;
use Session;
use Cart;
use Auth;
use App\Models\Order;
use Toastr;
use App\Traits\CNPMerchantWebServiceClient;
use App\Traits\TransactionDetails;
use App\Traits\startTransaction;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{

    public function checkout() {
        // Session::forget('cart');
        SEO::setTitle('Оформление заказа');
        SEO::setDescription('Оформление заказа Etalon Holding');
        // dd(Cart::count());
        if(Cart::count() < 1){
            return redirect()->route('cart');
        }
       
        return view('pages.checkout');
    }

    public function postCheckout(Request $request) {
        $data = [];
        foreach(Cart::content()->toArray() as $item) {
            array_push($data, [
                'nameOfGoods' => (string) $item['name'],
                'merchantsGoodsID' => (string) $item['id'],
                'amount' => (string) number_format($item['price'], 2, '', ''),
                'currencyCode' => (int) 398
            ]);
        }
        

        $user = Auth::user();
        
        $order = new Order;
        if($request->get('user_id') != 0) {
            $order->user_id = $request->get('user_id');
            // $order->iin_bin = $request->get('usertype');
        }
        $order->phone = $request->get('phone');
        $order->name = $request->get('name');
        $order->city = 'Almaty';
        $order->address = $request->get('address');
        $order->email = $request->get('email');
        $order->comment = $request->get('comment');
        $order->method = $request->get('method', 'nal');
        $order->status = 'create';
        $order->products = Cart::content()->toArray();
        $order->delivery_method = $request->get('delivery_method', 'dostavka');
        $order->user_type = $request->get('usertype', 'f');
        $order->total_price = Cart::total();
        $order->save();
        if($request->get('method') == 'cart') {
           $client = new \ProcessingKz\Client();

            // Begin payment transaction ("checkout").
            $details = new \ProcessingKz\Objects\Entity\TransactionDetails();
            $details->setMerchantId("000000000000073")
                // ->setTerminalId("TEST TID")
                ->setTotalAmount(number_format(str_replace(' ','',Cart::total()), 2, '', ''))
                ->setCurrencyCode(398)
                ->setDescription("My first transaction")
                ->setReturnURL(route('order.processing', ['id' => $order->id]))
                ->setGoodsList($data)
                ->setLanguageCode("ru")
                ->setMerchantLocalDateTime(date("d.m.Y H:i:s"))
                ->setOrderId($order->id)
                ->setPurchaserName($request->get('name'))
                ->setPurchaserEmail($request->get('email'));

            $transaction = new \ProcessingKz\Objects\Request\StartTransaction();
            $transaction->setTransaction($details);

            $startResult = $client->startTransaction($transaction);

            if (true === $startResult->getReturn()->getSuccess()) {
                $reference = $startResult->getReturn()->getCustomerReference();
                $status = new \ProcessingKz\Objects\Request\GetTransactionStatus();
                $status->setMerchantId("000000000000073")
                    ->setReferenceNr($reference);
                $statusResult = $client->getTransactionStatus($status);
                $order->reference = $reference;
                $order->save();
                Cart::destroy();
                return redirect($startResult->getReturn()->getRedirectURL());


            } else {
                die($startResult->getReturn()->getErrorDescription());
            }
            
        }
        $otvet = 'Наличными';
        Toastr::success('', 'Вы успешно оформили заказ', ["positionClass" => "toast-top-right"]);

        Mail::send('form.order', $order->toArray(), function ($message) use ($order) {
            $message->from('etalon-holding@gmail.com', 'Etalon Holding');
            $message->to($order->email, $order->name)->subject('Ваш заказ принят №' . $order->id .' | Etalon Holding');
            // $message->cc('tamos.kz@mail.ru', 'Tamos');
        });

        Session::forget('cart');

        return redirect()->route('order.processing', ['id' => $order->id]);
    }

    public function processing(Request $request, $id)
    {

        $order  = Order::find($id);
        $otvet = 'Наличными';

        if($order->method == 'cart') {
            $client = new \ProcessingKz\Client();
            $status = new \ProcessingKz\Objects\Request\GetTransactionStatus();
            $status->setMerchantId("000000000000073")
                ->setReferenceNr($order->reference);
    
            $statusResult = $client->getTransactionStatus($status);
            $otvet = $statusResult->getReturn()->getTransactionStatus();
            if($otvet == 'AUTHORISED') {
                $complete = new \ProcessingKz\Objects\Request\CompleteTransaction();
                $complete->setMerchantId("000000000000073")
                ->setReferenceNr($order->reference)
                ->setTransactionSuccess(true);
                $completeResult = $client->completeTransaction($complete);
                $statusResult = $client->getTransactionStatus($status);
                $otvet = $statusResult->getReturn()->getTransactionStatus();
            }
            if($order->status != 'paid') {
                if($otvet == 'PAID') {
                    $order->update([
                        'status' => 'paid'
                    ]);
                }
            }
        }
       
        return view('pages.thanku', compact(['order', 'otvet']));
    }
}
