<?php

namespace App\Services;
use App\Facades\Cart;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\PaystackTransaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Unicodeveloper\Paystack\Facades\Paystack;

class OrderService
{
    public function saveOrders($request)
    {
        if(Auth::guard('customer')->user())
        {
            $customer_id=Auth::guard('customer')->id();
        }else{
           $customer= Customer::firstOrCreate(['email'=>$request->email,'name'=>$request->first_name.' '.$request->last_name,'phone'=>$request->phone]);
            $customer_id=$customer->id;
        }
        $total=Cart::total()+Cart::total_discount();
        $tracking_id=Str::ulid();
        $tax=((company_info()->tax_rate/100)*Cart::total());
        $payable=Cart::total()+$tax;
        $ref=Paystack::genTranxRef();
        $order=Order::create(['customer_id'=>$customer_id,'tracking_id'=>$tracking_id,
            'status'=>0,'payment_status'=>0,'payment_channel'=>'online','amount'=>$total,
            'tax'=>$tax,'total_after_discount'=>Cart::total(),'total_payable'=> $payable,
            'payment_ref'=>$ref]);
        $content= Cart::content();

        foreach ($content as $id => $item)
        {
            $discount= isset($item->get('options')['discount'])?$item->get('options')['discount']*$item->get('quantity'):0;
            $order_line=OrderLine::create(['order_id'=>$order->id,
                'product_id'=>$id,'quantity'=>$item->get('quantity'),'unit_price'=>$item->get('price')+$discount,
                'discount'=>$discount*$item->get('quantity'),'total'=>$item->get('price')*$item->get('quantity')
                ]);

        }

        $data = array(
            "amount" => $payable * 100,
            "reference" => $ref,
            "email" => $order->customer->email,
            "currency" => "NGN",
            "orderID" => $order->id,
        );
        $pt=PaystackTransaction::create(['order_id'=>$order->id,'payment_ref'=>$ref,
            'payload'=>$data]);

        try{
            return Paystack::getAuthorizationUrl($data)->redirectNow();
        }catch(\Exception $e) {
            return back()->with(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }
    }

    public function myOrders($request)
    {
        if(Auth::guard('customer')->user())
        {
            $customer_id=Auth::guard('customer')->id();
            $orders=Order::where(['customer_id'=>$customer_id])->get();
            return view('customer-auth.orders',compact('orders'));
        }
        abort(404);

    }
    public function getOrderCustomer($order_id)
    {
        if(Auth::guard('customer')->user())
        {
            $order=Order::findOrFail($order_id);
            return view('customer-auth.order',compact('order'));
        }
        abort(404);

    }
    public function getOrderAdmin($order_id)
    {
        $order=Order::findOrFail($order_id);
         $customer_purchases=Order::where('customer_id',$order->customer_id)->sum('total_payable');
         $last_purchase_date=Order::where('customer_id',$order->customer_id)->orderByDesc('id')->first()->created_at;
         $customer_order_count=Order::where('customer_id',$order->customer_id)->count();
        $customer_completed_order_count=Order::where(['customer_id'=>$order->customer_id,'status'=>1])->count();
        return view('admin.orders.details',compact('order','customer_purchases'
            ,'customer_order_count','last_purchase_date','customer_completed_order_count'));

    }
    public function getOrders($request)
    {
        $orders = Order::where('id', '<>', 0);
        if ($request->filled('q')) {
            $q = $request->input('q');

            $orders->where(function ($query) use ($q) {
                $query->where('tracking_id',$q);
            });
        }
        if ($request->filled('customer') && $request->customer!=0) {
            $customer_id = $request->input('customer');

            $orders->where('customer_id',$customer_id);
        }
        if ($request->filled('order_status') && $request->order_status!='') {
            $order_status = $request->input('order_status');

            $orders->where('status',$order_status);
        }
        if ($request->filled('payment_status') && $request->payment_status!='') {
            $payment_status = $request->input('payment_status');

            $orders->where('payment_status',$payment_status);
        }
        $customers=Customer::all();
         $orders=$orders->orderByDesc('id')->withCount('order_lines')->paginate(10);
        return view('admin.orders.index',compact('orders','customers'));

    }





}
