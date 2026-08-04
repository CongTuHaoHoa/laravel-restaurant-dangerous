@extends('layouts.client')

@section('content')

<section class="py-5" style="background:#0f0f10; min-height:100vh;">
    <div class="container">

        <div class="mb-4">
            <a href="{{ route('client.index') }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-2"></i>Back to Menu
            </a>
        </div>

        <div class="card border-0 shadow-lg overflow-hidden" style="border-radius:20px;">
            <div class="row g-0">

                <!-- Image -->
                <div class="col-lg-6">
                    <img src="{{ asset($food->FOD_IMAGE) }}"
                         class="img-fluid h-100 w-100"
                         style="object-fit:cover; min-height:550px;">
                </div>

                <!-- Info -->
                <div class="col-lg-6 bg-white">
                    <div class="p-5">

                        <span class="badge bg-danger px-3 py-2 mb-3">
                            {{ $food->FOD_CATEGORY }}
                        </span>

                        <h1 class="fw-bold mb-3">
                            {{ $food->FOD_NAME }}
                        </h1>

                        <div class="mb-4">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>

                            <span class="text-muted ms-2">
                                (4.8 • 128 Reviews)
                            </span>
                        </div>

                        <h2 class="text-danger fw-bold mb-4">
                            {{ number_format($food->FOD_PRICE) }}
                        </h2>

                        <p class="text-secondary mb-4" style="line-height:1.8;">
                            {{ $food->FOD_DESCRIPTION }}
                        </p>

                        <hr>

                        <!-- Quantity -->
                        <form action="{{ route('cart.add',$food->FOD_ID) }}" method="POST">
                            @csrf

                            <div class="d-flex align-items-center mb-4">

                                <label class="fw-bold me-3">
                                    Quantity
                                </label>

                                <input type="number"
                                       name="quantity"
                                       value="1"
                                       min="1"
                                       class="form-control"
                                       style="width:120px;">

                            </div>

                            <button class="btn btn-danger btn-lg px-5">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Add to Cart
                            </button>

                        </form>

                        <hr class="my-5">

                        <div class="row text-center">

                            <div class="col">
                                <i class="fas fa-shipping-fast fa-2x text-danger mb-2"></i>
                                <p class="mb-0">Fast Delivery</p>
                            </div>

                            <div class="col">
                                <i class="fas fa-utensils fa-2x text-danger mb-2"></i>
                                <p class="mb-0">Fresh Ingredients</p>
                            </div>

                            <div class="col">
                                <i class="fas fa-award fa-2x text-danger mb-2"></i>
                                <p class="mb-0">Premium Quality</p>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection