@extends('layouts.app')

@section('content')
<div class="container">

    @if(session('success'))
    <div class="alert alert-danger">
        {{ session('success') }}
    </div>
    @endif

    <h1>Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Products</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                    @foreach($order->products as $product)
                    {{ $product->name }} ({{ $product->pivot->quantity }}),
                    @endforeach
                </td>
                <td>${{ $order->total_price }}</td>
                <td>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right">Total</td>
                <td>${{ $orders->sum('total_price') }}</td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection