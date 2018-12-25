<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SEO;
use Session;
use Cart;
use Auth;
use App\Models\Order;
use Toastr;

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
        $order->method = $request->get('method');
        $order->status = 'create';
        $order->products = Cart::content()->toArray();
        $order->delivery_method = $request->get('delivery_method');
        $order->user_type = $request->get('usertype');
        $order->total_price = Cart::total();
        $order->save();
        // $order->products()->attach(array_keys($productsId));
        Cart::destroy();
        Toastr::success('', 'Вы успешно оформили заказ', ["positionClass" => "toast-top-right"]);
        return redirect()->route('homepage');

        $client = new \ProcessingKz\Client();

        // Begin payment transaction ("checkout").
        $details = new \ProcessingKz\Objects\Entity\TransactionDetails();
        $details->setMerchantId("000000000000001")
            ->setTerminalId("TEST TID")
            ->setTotalAmount(1)
            ->setCurrencyCode(398)
            ->setDescription("My first transaction")
            ->setReturnURL("/transaction-result")
            ->setGoodsList($_SESSION["basket"])
            ->setLanguageCode("ru")
            ->setMerchantLocalDateTime(date("d.m.Y H:i:s"))
            ->setOrderId(rand(1, 10000))
            ->setPurchaserName("IVANOV IVAN")
            ->setPurchaserEmail("purchaser@processing.kz");

        $transaction = new \ProcessingKz\Objects\Request\StartTransaction();
        $transaction->setTransaction($details);

        $startResult = $client->startTransaction($transaction);

        if (true === $startResult->getReturn()->getSuccess()) {
            $reference = $startResult->getReturn()->getCustomerReference();

            // Commit payment transaction.
            $complete = new \ProcessingKz\Objects\Request\CompleteTransaction();
            $complete->setMerchantId("000000000000001")
                ->setReferenceNr($reference)
                ->setTransactionSuccess(true);
            $completeResult = $client->completeTransaction($complete);

            // Get status of transaction.
            $status = new \ProcessingKz\Objects\Request\GetTransactionStatus();
            $status->setMerchantId("000000000000001")
                ->setReferenceNr($reference);
            $statusResult = $client->getTransactionStatus($status);
        } else {
            die($startResult->getReturn()->getErrorDescription());
        }
    }
}
