@extends('layouts.client')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')

@forelse ($viewData["orders"] as $order)

<div class="card mb-4 shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Order #{{ $order->id }}</strong>

        <span class="badge bg-warning">
            Pending
        </span>
    </div>

    <div class="card-body p-3 border-bottom">

        <p class="mb-1 text-muted small">
            Date: {{ $order->created_at->format('d/m/Y H:i') }}
        </p>

        <p class="mb-1">
            <strong>Total:</strong>
            {{ number_format($order->total) }} VND
        </p>
        
        @foreach ($order->foodOrders as $foodOrder)

            <p class="mb-1">
                <strong>Food's Name:</strong>
                {{ $foodOrder->food?->FOD_NAME }}
            </p>

            <p class="mb-0">
                <strong>Quantity:</strong>
                {{ $foodOrder->quantity }}
            </p>

        @endforeach
    </div>

    

</div>

@empty

<div class="alert alert-danger" role="alert">
    Seems to be that you have not purchased anything in our store =(
</div>

@endforelse

@endsection