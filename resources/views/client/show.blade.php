@extends('layouts.client')

@section('content')

<section class="py-5" style="background:#0f0f10; min-height:100vh;">
    <div class="container">

        <!-- Back -->
        <div class="mb-4">
            <a href="{{ route('client.index') }}#menu" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-2"></i> Back to Menu
            </a>
        </div>

        <!-- Food Detail -->
        <div class="card border-0 shadow-lg overflow-hidden mb-5" style="border-radius:20px;">
            <div class="row g-0">

                <!-- Image -->
                <div class="col-lg-6">
                    <img src="{{ asset('storage/food/'.$viewData['food']->FOD_IMAGE) }}"
                        class="img-fluid h-100 w-100"
                        style="object-fit:cover; min-height:550px;">
                </div>

                <!-- Info -->
                <div class="col-lg-6 bg-white">
                    <div class="p-5">

                        <span class="badge bg-danger px-3 py-2 mb-3">
                            {{ $viewData["food"]->FOD_CATEGORY }}
                        </span>

                        <h1 class="fw-bold">
                            {{ $viewData["food"]->FOD_NAME }}
                        </h1>

                        <div class="mb-3">
                            <span class="text-muted ">
                                Reviews: {{ $viewData["food"]->comments->count() }}
                            </span>
                        </div>

                        <h2 class="text-danger fw-bold mb-4">
                            {{ number_format($viewData["food"]->FOD_PRICE) }} VNĐ
                        </h2>

                        <p class="text-secondary" style="line-height:1.8;">
                            {{ $viewData["food"]->FOD_DESCRIPTION }}
                        </p>

                        <hr>

                        <form action="{{ route('cart.add',$viewData["food"]->FOD_ID) }}" method="POST">
                            @csrf

                            <div class="d-flex align-items-center mb-4">

                                <label class="fw-bold me-3">
                                    Quantity
                                </label>

                                <input
                                    type="number"
                                    name="quantity"
                                    value="1"
                                    min="1"
                                    class="form-control"
                                    style="width:120px;">

                            </div>
                            @if ($viewData["food"]->FOD_STATUS == 1)
                            <button class="btn btn-danger btn-lg px-5">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Add to Cart
                            </button>
                            
                        </form>
                            @else
                            <button class="btn btn-danger btn-lg px-5 disabled">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Out of stock
                            </button>
                            @endif

                    </div>
                </div>

            </div>
        </div>

        <!-- ================= COMMENTS ================= -->

        <div class="card shadow border-0 rounded-4">

            <div class="card-body p-4">

                <h3 class="fw-bold mb-4">
                    <i class="fas fa-comments text-danger me-2"></i>
                    Customer Reviews
                </h3>

                @auth

                <form action="{{ route('comment.store',$viewData['food']->FOD_ID) }}" method="POST">

                    @csrf

                    <textarea
                        class="form-control mb-3"
                        name="content"
                        rows="4"
                        placeholder="Write your review..."
                        required></textarea>

                    <button class="btn btn-danger">
                        <i class="fas fa-paper-plane me-2"></i>
                        Post Comment
                    </button>

                </form>

                <hr class="my-4">

                @endauth

                @forelse($viewData["food"]->comments as $comment)

                <div class="d-flex mb-4">

                    <img
                        src="{{ asset('storage/user/'.$comment->user->avatar) }}"
                        width="55"
                        height="55"
                        class="rounded-circle me-3"
                        style="object-fit:cover;">

                    <div class="flex-grow-1">

                        <div class="bg-light rounded-4 p-3">

                            <div class="d-flex justify-content-between">

                                <div>

                                    <h6 class="fw-bold mb-1">
                                        {{ $comment->user->name }}
                                    </h6>

                                    <small class="text-muted">
                                        {{ $comment->created_at }}
                                    </small>

                                </div>

                                @if(Auth::check() && Auth::id()==$comment->user_id)

                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge rounded-pill bg-danger px-2 py-1"
                                            style="font-size:.7rem;">
                                            Your Comment
                                        </span>
                                    </div>

                                @endif

                            </div>

                            <hr>

                            @if(Auth::check() && Auth::id()==$comment->user_id)

                                <form action="{{ route('comment.update',$comment->id) }}" method="POST">

                                    @csrf
                                    @method('PUT')

                                    <textarea
                                        class="form-control mb-3"
                                        name="content"
                                        rows="3">{{ $comment->content }}</textarea>

                                    <button class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit me-1"></i>
                                        Update
                                    </button>

                                </form>

                            @else

                                <p class="mb-0">
                                    {{ $comment->content }}
                                </p>

                            @endif

                        </div>

                    </div>

                </div>

                @empty

                <div class="alert alert-secondary">
                    No comments yet.
                </div>

                @endforelse

            </div>

        </div>

    </div>
</section>

@endsection
