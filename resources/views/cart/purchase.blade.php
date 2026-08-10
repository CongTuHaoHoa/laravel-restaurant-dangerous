@extends('layouts.client')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')

<div class="card">
    <div class="card-header">
    Purchase Completed
    </div>
    <div class="card-body">
        <div class="alert alert-success" role="alert">
        Congratulations, purchase completed. Order number is
        <b>#{{ $viewData['order']->id }}</b>. 
        Check all your orders <a href={{ route('myaccount.orders') }}>here</a>
        </div>
    </div>
</div>
@endsection
