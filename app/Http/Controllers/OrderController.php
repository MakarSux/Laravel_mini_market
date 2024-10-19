<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function cart()
    {
        return view('orders.cart');
    }

    public function checkout()
    {
        $cart = session()->get('cart');
        if(!$cart){
            return redirect()->route('products.index')->with('error', 'Корзина пуста');
        }

        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create(['total_price' => $total]);

        foreach($cart as $item){
            $order->products()->attach($item['id'], [
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        session()->forget('cart');
        return redirect()->route('products.index')->with('success', 'Заказ успешно оформлен');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->products()->detach();
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Заказ удален');
    }

    public function orders()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }
}