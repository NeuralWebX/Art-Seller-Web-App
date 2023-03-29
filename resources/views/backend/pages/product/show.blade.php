@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-primary text-center">Product Preview</h4>
</div>
<div class="container mt-5 mb-5">
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
</div>
@endsection
