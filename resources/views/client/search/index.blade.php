@extends('layouts.client')
@section('content')

<div class="container">
    @if($viewData["foods"]->count() > 0)

        <div class="row g-4">

            @foreach($viewData["foods"] as $food)

                <div class="col-sm-6 col-lg-4">

                    <a href="{{ route('client.show', $food->FOD_ID) }}"
                       class="text-decoration-none">

                        <div class="mcard">

                            <div class="mimg">

                                <img
                                    src="{{ asset('storage/food/'.$food->FOD_IMAGE) }}"
                                    alt="{{ $food->FOD_NAME }}">

                            </div>

                            <div class="mbody">

                                <div class="mtit">
                                    {{ $food->FOD_NAME }}
                                </div>

                                <div class="mdesc">
                                    {{ $food->FOD_DESCRIPTION }}
                                </div>

                                <div class="mprice">
                                    {{ number_format($food->FOD_PRICE, 0, ',', '.') }} VND
                                </div>

                            </div>

                        </div>

                    </a>

                </div>

            @endforeach

        </div>

    @else

        <div class="alert alert-warning">
            No food found.
        </div>

    @endif

</div>

@endsection