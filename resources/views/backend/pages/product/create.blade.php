@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-primary text-center">Product Create</h4>
</div>
<div class="container">
    <form action="{{ route('backend.product.store') }}" method="post" enctype="multipart/form-data" class="form-group">
        @csrf
        @include('backend.pages.product.fields')
    </form>
</div>
@endsection
