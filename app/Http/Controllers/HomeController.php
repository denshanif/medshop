<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;

use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // get all categories
        $categories = Category::all();

        // initialize cartCount
        $cartCount = 0;

        // get cart count if the user is logged in
        if (Auth::check()) {
            $user = User::find(Auth::id());

            // check cart table for the user's cart items, and count them, if none, set cart count to 0
            $cartCount = Cart::where('user_id', $user->id)->count();
        }

        // initialize hasOrder
        $hasOrder = 0;

        // check if the user has an order
        if (Auth::check()) {
            $user = User::find(Auth::id());

            // check order table for the user's orders, and count them, if none, set hasOrder to 0
            $hasOrder = Order::where('user_id', $user->id)->count();
        }

        if ($request->has('category')) {
            // join the products table with the categories table
            $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
                ->where('categories.category_name', $request->category)
                ->get();
            // if the category does not exist, return all products
            if ($products->isEmpty()) {
                $products = Product::all();
                return redirect('/#product-list')->with(['products' => $products, 'categories' => $categories, 'error' => 'Category does not exist']);
            }
        } else if ($request->has('search')) {
            $products = Product::where('product_name', 'like', '%' . $request->search . '%')->get();
        } else if ($request->has('sort')) {
            $products = Product::orderBy('product_price', $request->sort)->get();
        } else {
            $products = Product::all();
        }

        return view('index')->with(['products' => $products, 'categories' => $categories, 'cartCount' => $cartCount, 'hasOrder' => $hasOrder]);
    }

    // product details
    public function show($id)
    {
        $product = Product::find($id);

        $categories = Category::all();

        // initialize cartCount to 0
        $cartCount = 0;

        // get cart count if the user is logged in
        if (Auth::check()) {
            $user = User::find(Auth::id());

            // check cart table for the user's cart items, and count them, if none, set cart count to 0
            $cartCount = Cart::where('user_id', $user->id)->count();
        }

        // initialize hasOrder
        $hasOrder = 0;

        // check if the user has an order
        if (Auth::check()) {
            $user = User::find(Auth::id());

            // check order table for the user's orders, and count them, if none, set hasOrder to 0
            $hasOrder = Order::where('user_id', $user->id)->count();
        }

        // find related products based on the category
        $relatedProducts = Product::where('category_id', $product->category_id)->get();

        return view('product-detail')->with([
            'product' => $product,
            'categories' => $categories,
            'relatedProducts' => $relatedProducts,
            'cartCount' => $cartCount,
            'hasOrder' => $hasOrder
        ]);
    }

    // cart
    public function cart()
    {
        // get the user
        $user = User::find(Auth::id());

        // get categories
        $categories = Category::all();

        // initialize cartCount to 0
        $cartCount = 0;

        // get cart count if the user is logged in
        if (Auth::check()) {
            $user = User::find(Auth::id());

            // check cart table for the user's cart items, and count them, if none, set cart count to 0
            $cartCount = Cart::where('user_id', $user->id)->count();
        }

        // initialize hasOrder
        $hasOrder = 0;

        // check if the user has an order
        if (Auth::check()) {
            $user = User::find(Auth::id());

            // check order table for the user's orders, and count them, if none, set hasOrder to 0
            $hasOrder = Order::where('user_id', $user->id)->count();
        }

        // get the cart items and join the products table
        $cartItems = Cart::join('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $user->id)
            ->get();

        // total price
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->price * $cartItem->quantity;
        }

        return view('cart')->with([
            'cartItems' => $cartItems, 'cartCount' => $cartCount, 'categories' => $categories, 'totalPrice' => $totalPrice, 'hasOrder' => $hasOrder
        ]);
    }

    // add to cart
    public function addToCart(Request $request)
    {
        // check if the user is logged in
        if (Auth::check()) {
            $user = User::find(Auth::id());

            // find the product
            $product = Product::find($request->product_id);

            // check if the product is already in the cart
            $cart = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();

            if ($cart) {
                // if the product is already in the cart, update the quantity
                $cart->quantity += $request->quantity;
                $cart->save();
            } else {
                // if the product is not in the cart, create a new cart item
                $cart = new Cart;
                $cart->user_id = $user->id;
                $cart->product_id = $product->id;
                $cart->quantity = $request->quantity;
                $cart->price = $product->product_price;
                $cart->save();
            }

            return redirect('/cart')->with('success', 'Product added to cart');
        } else {
            return redirect('/login')->with('error', 'Login first to add to cart');
        }
    }

    // checkout
    public function checkout()
    {
        // get the user
        $user = User::find(Auth::id());

        // get categories
        $categories = Category::all();

        // initialize cartCount to 0
        $cartCount = 0;

        // get cart count if the user is logged in
        if (Auth::check()) {
            $user = User::find(Auth::id());

            // check cart table for the user's cart items, and count them, if none, set cart count to 0
            $cartCount = Cart::where('user_id', $user->id)->count();
        }

        // initialize hasOrder
        $hasOrder = 0;

        // check if the user has an order
        if (Auth::check()) {
            $user = User::find(Auth::id());

            // check order table for the user's orders, and count them, if none, set hasOrder to 0
            $hasOrder = Order::where('user_id', $user->id)->count();
        }

        // get the cart items and join the products table
        $cartItems = Cart::join('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $user->id)
            ->get();

        // total price
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->price * $cartItem->quantity;
        }

        return view('checkout')->with([
            'cartItems' => $cartItems, 'cartCount' => $cartCount, 'categories' => $categories, 'totalPrice' => $totalPrice, 'hasOrder' => $hasOrder
        ]);
    }

    // place order
    public function placeOrder(Request $request)
    {
        // get the user
        $user = User::find(Auth::id());

        // create a new order
        $order = new Order;
        $order->user_id = $user->id;
        $order->address_delivery = $request->address_delivery;
        $order->city_delivery = $request->city_delivery;
        $order->phone_number_delivery = $request->phone_number_delivery;
        $order->total = $request->total;
        $order->payment_method = $request->payment_method;

        $order->save();

        // create order details
        $cartItems = Cart::where('user_id', $user->id)->get();
        foreach ($cartItems as $cartItem) {
            $orderDetail = new OrderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cartItem->product_id;
            $orderDetail->quantity = $cartItem->quantity;
            $orderDetail->price = $cartItem->price;
            $orderDetail->subtotal = $cartItem->price * $cartItem->quantity;
            $orderDetail->save();
        }

        // delete the cart items
        Cart::where('user_id', $user->id)->delete();

        if ($order) {
            return redirect('/')->with('success', 'Order placed successfully');
        } else {
            return redirect('/checkout')->with('error', 'Failed to place order');
        }
    }

    // my orders
    public function myOrders()
    {
        // get the user
        $user = User::find(Auth::id());

        // get categories
        $categories = Category::all();

        // initialize cartCount to 0
        $cartCount = 0;

        // get cart count if the user is logged in
        if (Auth::check()) {
            $user = User::find(Auth::id());

            // check cart table for the user's cart items, and count them, if none, set cart count to 0
            $cartCount = Cart::where('user_id', $user->id)->count();
        }

        // initialize hasOrder
        $hasOrder = 0;

        // check if the user has an order
        if (Auth::check()) {
            $user = User::find(Auth::id());

            // check order table for the user's orders, and count them, if none, set hasOrder to 0
            $hasOrder = Order::where('user_id', $user->id)->count();
        }

        // get the user's orders and join with the order details, and products table
        $orders = Order::join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('orders.user_id', $user->id)
            ->get();

        // group the orders by order id
        $groupedOrders = $orders->groupBy('order_id');

        return view('my-orders')->with([
            'groupedOrders' => $groupedOrders, 'cartCount' => $cartCount, 'categories' => $categories, 'hasOrder' => $hasOrder
        ]);
    }

    // cancel order
    public function cancelOrder(Request $request)
    {
        // get the order
        $order = Order::find($request->id);

        if ($order) {
            // change the status of the order to 'Cancel' enum
            $order->status = 'Cancel';
            $order->save();
            return redirect('/my-orders')->with('success', 'Order cancelled successfully');
        } else {
            return redirect('/my-orders')->with('error', 'Failed to cancel order');
        }
    }

    // invoice
    public function invoice($id)
    {
        // get the order by id, and join with the order details, products, and users table
        $order = Order::join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('orders.id', $id)
            ->first();

        $data = [
            'order' => $order
        ];

        $pdf = PDF::loadView('invoice', $data);
        return $pdf->stream('invoice.pdf', array('Attachment' => false))->withHeaders([
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="invoice.pdf"',
            'target' => '_blank'
        ]);
    }
}
