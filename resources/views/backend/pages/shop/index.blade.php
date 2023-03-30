@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-primary text-center">Product List</h4>
</div>
<div class="container">
    <div class="row">
        @foreach ($products as $item)
        <div class="col-md-4" onclick="location.href='{{ route('backend.product.show',$item->id) }}'">
            <div class="card text-white">
                <img class="card-img-top" src="{{ $item->product_image }}" alt="Title">
                <div class="card-body mb-3">
                    <h4 class="card-title">{{ $item->product_name }}</h4>
                    <p class="card-text">{{ number_format($item->product_price,2) }} BDT.</p>
                    <p class="text-primary">Artist: {{ $item->user->name }}</p>
                </div>
                <a href="{{ route('backend.onlinePay.exampleEasyCheckout',$item->id) }}" class="btn btn-primary">Purchase Now</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
