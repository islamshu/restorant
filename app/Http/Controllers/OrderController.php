<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function get_orders(Request $request){
        $query = Order::query();
        if($request->status != null){
            $query->where('status',$request->status);
        }
        $orders =$query->orderby('id','desc')->get(); // Replace with your actual logic to fetch the updated content

        return view('dashboard.orders.index', compact('orders'))->render();
    }
    public function refresh(Request $request){
        $query = Order::query();
        if($request->status != null){
            $query->where('status',$request->status);
        }
        $orders =$query->orderby('id','desc')->get(); // Replace with your actual logic to fetch the updated content

        // Return the table content as a response
        return view('dashboard.orders._table', compact('orders'))->render();
    }
    public function change_status(Request $request){
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();
        return response()->json(['status' => $request->status]);

    }
    
}
