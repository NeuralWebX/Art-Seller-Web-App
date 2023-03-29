@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-primary text-center">Category List</h4>
</div>
<div class="container">
    <form action="{{ route('backend.category.update',$category->id) }}" method="post" enctype="multipart/form-data"
        class="form-group">
        @method('put')
        @csrf
        @include('backend.pages.category.fields')
    </form>
</div>
@endsection