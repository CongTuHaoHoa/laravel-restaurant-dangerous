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
                            <img src="{{ asset('/storage/'.$food->getImage()) }}"
                                 class="img-fluid rounded-start"
                                 style="height:180px; width:100%; object-fit:cover;">
                        </div>

                        <!-- Food Information -->
                        <div class="col-md-6">

                            <div class="card-body">

                                <h4 class="fw-bold">
                                    {{ $food->name() }}
                                </h4>

                                <p class="text-muted">
                                    {{ $food->description() }}
                                </p>

                                <h5 class="text-danger fw-bold">
                                    ${{ number_format($food->price(),2) }}
                                </h5>

                                <span class="badge bg-success">
                                    {{ $food->status() }}
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
                                       value="{{ session('foods')[$food->getId()] }}"
                                       readonly>

                                <hr>

                                <h5 class="fw-bold">
                                    ${{ number_format($food->getPrice()*session('foods')[$food->getId()],2) }}
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

                <a href="{{ route('client.index') }}"
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

                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal</span>
                        <strong>
                            ${{ number_format($viewData["total"],2) }}
                        </strong>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Shipping</span>
                        <span class="text-success">
                            FREE
                        </span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-4">

                        <h5>Total</h5>

                        <h5 class="text-danger fw-bold">
                            ${{ number_format($viewData["total"],2) }}
                        </h5>

                    </div>

                    <button class="btn btn-warning w-100 py-2">
                        <i class="fas fa-credit-card me-2"></i>
                        Checkout
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection