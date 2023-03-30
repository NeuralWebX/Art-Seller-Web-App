@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-primary text-center">Product Preview</h4>
</div>
{{-- <div class="container mt-5 mb-5">
    <div class="card">
        <div class="row g-0">
            <div class="col-md-6 border-end">
                <div class="d-flex flex-column justify-content-center">
                    <div class="main_image"> <img src="{{ $product->product_image }}" id="main_product_image"
                            width="350"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 right-side">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{ $product->product_name }}</h3> <span class="heart"><i class='bx bx-heart'></i></span>
                    </div>
                    <div class="mt-2 pr-3 content">
                        <p>Description: {{ $product->product_details }}</p>
                    </div>
                    <h3>{{ number_format($product->product_price,2) }} <span class="text-danger text-italic">BDT.</span>
                    </h3>
                    <div class="ratings d-flex flex-row align-items-center">
                        <div class="d-flex flex-row"> <i class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i
                                class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i class='bx bx-star'></i> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="{{ $product->product_image }}" class="card-img" alt="{{ $product->product_name }}">
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-7">
            <div class="card-body">
                <h5 class="card-title">{{ $product->product_name }}</h5>
                <p class="card-text">{{ $product->product_details }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="{{ route('backend.product.edit',$product->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('backend.product.destroy',$product->id) }}" class="btn btn-danger">Delete</a>
                    </div>
                    <small class="text-primary">SKU: XXXX | Category: {{ $product->category->category_name }} |
                        Availability: {{ $product->product_status == 0?'In Stock':'Sold' }}</small>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text"><strong>Price:</strong> {{ number_format($product->product_price,2) }} BDT.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mx-auto">
    <h4 class="text-primary text-center">Related Product</h4>
</div>
<div class="container">
    <div class="row">
        @foreach ($products as $item)
        <div class="col-md-4" onclick="location.href='{{ route('backend.product.show',$item->id) }}'">
            <div class="card text-white">
                <img class="card-img-top" src="{{ $item->product_image }}" alt="Title">
                <div class="card-body">
                    <h4 class="card-title">{{ $item->product_name }}</h4>
                    <p class="card-text">{{ number_format($item->product_price,2) }} BDT.</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
