<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OrderDetail;
use App\Models\Order;

class OrderManagementController extends Controller
{
    public function index()
    {
        // Join orders with users table
        $orders = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.*', 'users.name')
            ->orderBy('orders.created_at', 'DESC')
            ->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::find($id);
        // join order_details with products table
        $orderDetails = OrderDetail::join('products', 'products.id', '=', 'order_details.product_id')
            ->where('order_details.order_id', $id)
            ->get();
        return view('admin.orders.show', compact('order', 'orderDetails'));
    }

    public function destroy($id)
    {
        $orderDetails = OrderDetail::where('order_id', $id)->get();
        foreach ($orderDetails as $orderDetail) {
            $orderDetail->delete();
        }
        $order = Order::find($id);
        $order->delete();

        if ($order && $orderDetails) {
            return redirect('/admin/orders')->with('success', 'Order deleted successfully');
        } else {
            return redirect('/admin/orders')->with('error', 'Order not found');
        }
    }
}
