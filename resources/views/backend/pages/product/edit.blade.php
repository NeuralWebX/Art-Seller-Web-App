@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-primary text-center">Product Edit</h4>
</div>
<div class="container">
    <form action="{{ route('backend.product.update',$product->id) }}" method="post" enctype="multipart/form-data"
        class="form-group">
        @csrf
        @method('put')
        @include('backend.pages.product.fields')
    </form>
</div>
@endsection
