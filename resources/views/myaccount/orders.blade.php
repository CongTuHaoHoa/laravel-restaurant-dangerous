@extends('layouts.client')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')

@forelse ($viewData["orders"] as $order)
<section id="order-{{ $order->id }}">
    <div class="card mb-4 shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Order #{{ $order->id }}</strong>

            
            @if($order->status == 1)
            <span class="badge bg-warning">
                Pending
            </span>
            @elseif ($order->status == 2)
            <span class="badge bg-primary">
                Delivering
            </span>
            @elseif ($order->status == 3)
            <span class="badge bg-success">
                Done
            </span>
            @endif
        </div>

        <div class="card-body p-3 border-bottom">

            <p class="mb-1 text-muted small">
                Date: {{ $order->created_at->format('d/m/Y H:i') }}
            </p>

            <p class="mb-1">
                <strong>Total:</strong>
                {{ number_format($order->total) }} VND
            </p>
            
            <div class="mb-3">

                    @foreach ($order->foodOrders as $foodOrder)

                        <div class="d-flex align-items-center mb-2">

                            <div class="flex-grow-1">
                                <strong>Name:</strong>
                                {{ $foodOrder->food?->FOD_NAME }}
                            </div>

                            <div class="ms-4">
                                <strong>x
                                {{ $foodOrder->quantity }}
                                </strong>
                            </div>

                        </div>

                    @endforeach

                </div>
            <div>
                <strong>Delivery Address:</strong>
                {{ $order->address }}
            </div>
        </div>
    </div>

    @if($order->status == 2)
        <form action="{{ route('myaccount.order.delivered', $order->id) }}"
            method="POST"
            class="d-inline">
            @csrf
            @method('PUT')

            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-check me-1"></i>
                Mark as Delivered
            </button>
        </form>
    @endif

    @empty

    <div class="alert alert-danger" role="alert">
        Seems to be that you have not purchased anything in our store =(
    </div>
</section>

@endforelse

@endsection