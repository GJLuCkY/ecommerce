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
                'amount' => (string) $item['price'],
                'currencyCode' => (int) 398
            ]);
        }
        if($request->get('method') == 'cart') {
            $client=new CNPMerchantWebServiceClient();
            $transactionDetails = new TransactionDetails();
            $transactionDetails->merchantId="000000000000001";
            $transactionDetails->terminalId="TEST TID";
            $transactionDetails->totalAmount = 100;//*100;
            $transactionDetails->currencyCode = 398;
            $transactionDetails->description="My first transaction";
            $transactionDetails->returnURL=str_replace("checkout.php", "result.php", $pageURL);
            $transactionDetails->goodsList=$data;
            $transactionDetails->languageCode="ru";
            $transactionDetails->merchantLocalDateTime=date("d.m.Y H:i:s");
            $transactionDetails->orderId= rand(1,10000);		
            $transactionDetails->purchaserName="IVANOV IVAN";		
            $transactionDetails->purchaserEmail="purchaser@processing.kz";		

            $st = new startTransaction();
            $st->transaction = $transactionDetails;
            $startTransactionResult=$client->startTransaction($st);

            if ($startTransactionResult->return->success == true) {
                $_SESSION["customerReference"]=$startTransactionResult->return->customerReference;
                header("Location: " . $startTransactionResult->return->redirectURL);
            } else {
                $errors='Error: ' . $startTransactionResult->return->errorDescription;
            }
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
    }
}
