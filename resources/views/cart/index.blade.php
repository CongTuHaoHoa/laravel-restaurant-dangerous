@extends('layouts.client')

@section('title', $viewData["title"])

@section('content')

<div class="container py-5">

    <h2 class="fw-bold text-danger mb-4">
        <i class="fas fa-shopping-cart me-2"></i>
        {{ $viewData["subtitle"] }}
    </h2>

    <div class="row">

        <!-- Cart Items -->
        <div class="col-lg-8">

            @forelse($viewData["foods"] as $food)

                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="row g-0">

                        <!-- Image -->
                        <div class="col-md-3">
                            <img src="{{ asset('/storage/food/'.$food->FOD_IMAGE) }}" alt ="{{ $food->FOD_NAME }}"
                                 class="img-fluid rounded-start"
                                 style="height:180px; width:100%; object-fit:cover;">
                        </div>

                        <!-- Food Information -->
                        <div class="col-md-6">

                            <div class="card-body">

                                <h4 class="fw-bold">
                                    {{ $food->FOD_NAME}}
                                </h4>

                                <p class="text-muted">
                                    {{ $food->FOD_DESCRIPTION}}
                                </p>

                                <h5 class="text-danger fw-bold">
                                    ${{ number_format($food->FOD_PRICE,0) }}
                                </h5>

                                <span class="badge bg-success">
                                    {{ $food->status }}
                                </span>

                            </div>

                        </div>

                        <!-- Quantity -->
                        <div class="col-md-3">

                            <div class="card-body text-center">

                                <h6>
                                    Quantity
                                </h6>

                                <input type="number"
                                       class="form-control text-center"
                                       value="{{ session('foods')[$food->FOD_ID] }}"
                                       readonly>

                                <hr>

                                <h5 class="fw-bold">
                                    ${{ number_format($food->FOD_PRICE*session('foods')[$food->FOD_ID],0) }}
                                </h5>

                            </div>

                        </div>

                    </div>
                </div>

            @empty

                <div class="alert alert-warning">
                    <i class="fas fa-shopping-cart me-2"></i>
                    Your cart is empty.
                </div>

            @endforelse

            <div class="d-flex justify-content-between">

                <a href="{{ route('client.index') }}#menu"
                   class="btn btn-outline-danger">
                    <i class="fas fa-arrow-left me-1"></i>
                    Continue Shopping
                </a>

                <a href="{{ route('cart.delete') }}"
                   class="btn btn-outline-secondary">
                    <i class="fas fa-trash me-1"></i>
                    Clear Cart
                </a>

            </div>

        </div>

        <!-- Summary -->
        <div class="col-lg-4">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body">

                    <h4 class="fw-bold mb-4">
                        Cart Summary
                    </h4>



                    @if(
                            Auth::check() &&
                            Auth::user()->balance >= (
                                $viewData["total"] < 100000
                                    ? $viewData["total"] + 5000
                                    : $viewData["total"]
                            )
                        )

                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <strong>
                                {{ number_format($viewData["total"], 0, ',', '.') }} VND
                            </strong>
                        </div>

                        @if($viewData["total"] < 100000)
                            <div class="d-flex justify-content-between mb-3">
                                <span>Shipping</span>
                                <span class="text-success fw-bold">
                                    5,000 VND
                                </span>
                            </div>
                        @else
                            <div class="d-flex justify-content-between mb-3">
                                <span>Shipping</span>
                                <span class="text-success">
                                    FREE
                                </span>
                            </div>
                        @endif

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <h5>Total</h5>

                            <h5 class="text-danger fw-bold">
                                {{ number_format(
                                    $viewData["total"] < 100000
                                        ? $viewData["total"] + 5000
                                        : $viewData["total"],
                                    0,
                                    ',',
                                    '.'
                                ) }} VND
                            </h5>
                        </div>

                        <form action="{{ route('cart.purchase') }}" method="POST">

                            @csrf

                            <div class="mb-4">
                                <label for="address" class="form-label fw-bold">
                                    <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                                    Delivery Address
                                </label>

                                <textarea
                                    id="address"
                                    name="address"
                                    class="form-control text-start @error('address') is-invalid @enderror"
                                    rows="3">{{ old('address', Auth::user()->address) }}</textarea>

                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-warning w-100 py-2">
                                <i class="fas fa-credit-card me-2"></i>
                                Checkout
                            </button>

                        </form>

                    @else

                        <button class="btn btn-warning w-100 py-2" disabled>
                            <i class="fas fa-credit-card me-2"></i>
                            Not enough money
                        </button>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
