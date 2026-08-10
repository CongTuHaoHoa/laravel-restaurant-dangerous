@extends('layouts.client')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-2">My Orders</h2>
                <p class="text-muted">Manage and track your orders</p>
            </div>

            @forelse ($viewData["orders"] as $order)
            <div class="card mb-4 shadow-sm border-0 overflow-hidden hover-card" id="order-{{ $order->id }}" style="transition: all 0.3s ease;">
                <!-- Card Header -->
                <div class="card-header border-0 py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-white">
                            <i class="fas fa-receipt me-2"></i>
                            <strong>Order #{{ $order->id }}</strong>
                        </div>

                        @if($order->status == 1)
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-clock me-1"></i> Pending
                            </span>
                        @elseif ($order->status == 2)
                            <span class="badge bg-primary px-3 py-2 rounded-pill">
                                <i class="fas fa-shipping-fast me-1"></i> Out for Delivery
                            </span>
                        @elseif ($order->status == 3)
                            <span class="badge bg-success px-3 py-2 rounded-pill">
                                <i class="fas fa-check-circle me-1"></i> Completed
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    <!-- Date and Total -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <div class="icon-box me-3" style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-calendar-alt text-white"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Order Date</small>
                                    <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="icon-box me-3" style="width: 45px; height: 45px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-coins text-white"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Total</small>
                                    <strong class="text-danger fs-5">{{ number_format($order->total, 0, ',', '.') }} ₫</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="my-4">

                    <!-- Food Items -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-utensils text-primary me-2"></i>
                            Ordered Items
                        </h6>
                        <div class="food-items">
                            @foreach ($order->foodOrders as $foodOrder)
                                <div class="d-flex align-items-center justify-content-between p-3 mb-2 rounded overflow-hidden" style="background-color: #f8f9fa; max-width: 100%;">
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden" style="min-width: 0;">

                                        <div class="food-icon me-3 flex-shrink-0 overflow-hidden" style="width: 100px; height: 100px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                            <img src="{{ asset('/storage/food/'.$foodOrder->food->FOD_IMAGE) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $foodOrder->food?->FOD_NAME }}" />
                                        </div>
                                        <div class="overflow-hidden" style="min-width: 0;">
                                            <strong class="d-block text-truncate">{{ $foodOrder->food?->FOD_NAME }}</strong>
                                            <small class="text-muted text-truncate d-block">{{ number_format($foodOrder->price, 0, ',', '.') }} ₫</small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-dark rounded-pill px-3 py-2">
                                            <i class="fas fa-times me-1"></i>{{ $foodOrder->quantity }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Delivery Address -->
                    <div class="p-3 rounded" style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-map-marker-alt text-danger me-3 mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Delivery Address</strong>
                                <span class="text-dark">{{ $order->address }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Mark as Delivered Button -->
                    @if($order->status == 2)
                        <div class="mt-4 text-center">
                            <form action="{{ route('myaccount.order.delivered', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-lg px-5 py-2 rounded-pill shadow-sm" style="transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fas fa-check-double me-2"></i>
                                    Confirm Delivery
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            @empty
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-shopping-bag text-muted" style="font-size: 80px; opacity: 0.3;"></i>
                </div>
                <h4 class="fw-bold mb-2">No Orders Yet</h4>
                <p class="text-muted mb-4">You haven't purchased any products from our store yet.</p>
                <a href="{{ route('client.index') }}" class="btn btn-primary btn-lg rounded-pill px-5">
                    <i class="fas fa-shopping-cart me-2"></i>
                    Shop Now
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }

    .icon-box {
        transition: all 0.3s ease;
    }

    .hover-card:hover .icon-box {
        transform: scale(1.1) rotate(5deg);
    }

    .food-items > div {
        transition: all 0.2s ease;
    }

    .food-items > div:hover {
        background-color: #e9ecef !important;
        transform: translateX(5px);
    }

    .btn-success:hover {
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    }
</style>
@endsection
