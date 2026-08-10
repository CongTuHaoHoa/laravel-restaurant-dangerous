@extends('layouts.client')

@section('title', 'My Account')

@section('content')

<div class="container py-5">

    <div class="row">

        <!-- Sidebar -->
        <div class="col-lg-3 mb-4">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body text-center">

                    <img src="{{ asset('storage/user/'.Auth::user()->avatar) }}" alt="Avatar"
                        class="rounded-circle mb-3"
                        width="120">


                    <h4>{{ Auth::user()->name }}</h4>

                    <p class="text-muted">
                        {{ Auth::user()->email }}
                    </p>

                    <hr>

                    <div class="list-group list-group-flush">

                        <a href="{{ route('myaccount.index') }}"
                           class="list-group-item list-group-item-action active">
                            <i class="fas fa-user me-2"></i>
                            My Profile
                        </a>

                        <a href="{{ route('myaccount.orders') }}"
                           class="list-group-item list-group-item-action">
                            <i class="fas fa-box me-2"></i>
                            My Orders
                        </a>

                    </div>

                </div>

            </div>

        </div>

        <!-- Profile -->
        <div class="col-lg-9">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body">

                    <h3 class="fw-bold text-danger mb-4">
                        My Profile
                    </h3>

                    <form action="{{ route('myaccount.update') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')


                        <div class="mb-3">
                            <label class="form-label">Change Avatar</label>
                        </div>
                        <input type="file"
                        name="avatar"
                        class="form-control mb-3"
                        accept="image/*">

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text"
                                   class="form-control"
                                   name="name"
                                   value="{{ Auth::user()->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   class="form-control"
                                   name="email"
                                   value="{{ Auth::user()->email }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Balance</label>

                            <div class="form-control bg-light">
                                {{ number_format(Auth::user()->balance) }} VND
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">New Password</label>
                            <input type="password"
                                   class="form-control"
                                   name="password"
                                   placeholder="Leave blank if you don't want to change">
                        </div>

                        <button class="btn btn-danger">
                            <i class="fas fa-save me-2"></i>
                            Save Changes
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
