@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-primary text-center">Category Create</h4>
</div>
<div class="container">
    <form action="{{ route('backend.category.store') }}" method="post" enctype="multipart/form-data" class="form-group">
        @csrf
        @include('backend.pages.category.fields')
    </form>
</div>
@endsection
