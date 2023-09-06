<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders(Request $request,OrderService $orderService)
    {
        return $orderService->getOrders($request);
    }
    public function order_details(Request $request,OrderService $orderService,$order_id)
    {
        return $orderService->getOrderAdmin($order_id);
    }

    public function saveOrders(Request $request,OrderService $orderService)
    {
        return $orderService->saveOrders($request);

    }

    public function order_response(Request $request,$order_id)
    {
        $order=Order::where('id',$order_id)->first();

        return view('products.order_response',compact('order'));
    }


}
