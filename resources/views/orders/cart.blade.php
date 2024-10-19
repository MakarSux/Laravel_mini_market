@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cart</h1>
    @if(session('cart'))
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @foreach(session('cart') as $id => $details)
            @php $total += $details['price'] * $details['quantity'] @endphp
            <tr>
                <td>{{ $details['name'] }}</td>
                <td>${{ $details['price'] }}</td>
                <td>{{ $details['quantity'] }}</td>
                <td>${{ $details['price'] * $details['quantity'] }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right">Total</td>
                <td>${{ $total }}</td>
            </tr>
        </tfoot>
    </table>
    <form action="{{ route('orders.checkout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Оформить заказ</button>
    </form>
    @else
    <p>Your cart is empty.</p>
    @endif
</div>
@endsection