<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Models\Order;
use App\Models\PaystackTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return back()->with(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }
    }


    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();


        $ref=$paymentDetails["data"]["reference"];
        $order=Order::where('payment_ref',$ref)->first();
        if($order && $paymentDetails['status']==true )
        {
            $order->update(['payment_status'=>1]);
            $pt=PaystackTransaction::where('payment_ref',$ref)->first();
            $pt->update(['status'=>$paymentDetails['status'],'message'=>$paymentDetails['message'],
                'details'=>$paymentDetails["data"]]);
            Cart::clear();
        }else{
            $order->update(['payment_status'=>2]);
        }
        return redirect()->route('order_response',['order_id'=>$order->id]);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
