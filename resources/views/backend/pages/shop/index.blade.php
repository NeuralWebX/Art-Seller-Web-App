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
                <div class="card-body">
                    <h4 class="card-title">{{ substr($item->product_name,0,20) }}{{ strlen($item->product_name) > 20 ?
                        '...' : '' }}
                    </h4>
                    <p class="card-text">{{ number_format($item->product_price,2) }} BDT.</p>
                    <p class="text-primary">Artist: {{ $item->user->name }}</p>
                    <p class="text-primary">Status: {{ $item->product_status == 1?'Sold':'Available' }}</p>
                </div>
                @if ($item->product_status != 1)
                <div class="row">
                    <div class="col-md-5">
                        <a href="{{ route('backend.cart.add',$item->id) }}" class="btn btn-primary">Add to
                            cart
                            <span class="ml-3">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </span>
                        </a>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection