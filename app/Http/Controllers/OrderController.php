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
        if($request->from != null  || $request->to != null ){

            if($request->from != null  && $request->from != null && $request->from != $request->to){
                $query->whereBetween('created_at', [$request->from, $request->to]);
            }elseif($request->from != null  && $request->from == null){

                $query->whereBetween('created_at', [$request->from, now()]);
            }elseif($request->from == $request->to){

                $query->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to. ' 23:59:59']);
            }
        }else{
            $query->where('is_clear',0);
        }
        if($request->status != 2){
            $orders =$query->orderby('id','desc')->get();
        }else{
            $orders =$query->get();
        }

        return view('dashboard.orders.index', compact('orders','request'))->render();
    }
    public function refresh(Request $request){
        $query = Order::query();
        if($request->status != null){
            $query->where('status',$request->status);
        }
        if($request->from != null  || $request->to != null ){
            if($request->from != null  && $request->from != null){
                $query->whereBetween('created_at', [$request->from, $request->to]);
            }elseif($request->from != null  && $request->from == null){
                $query->whereBetween('created_at', [$request->from, now()]);
            }elseif($request->from == $request->to){
                $query->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to. ' 23:59:59']);
            }
        }else{
            $query->where('is_clear',0);
        }
        if($request->status != 2){
            $orders =$query->orderby('id','desc')->get();
        }else{
            $orders =$query->get();
        }
        // Return the table content as a response
        return view('dashboard.orders._table', compact('orders','request'))->render();
    }
    public function change_status(Request $request){
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();
        return response()->json(['status' => $request->status]);

    }
    
}
