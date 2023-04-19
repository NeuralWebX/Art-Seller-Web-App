@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-center text-primary">Exibition Create</h4>
</div>
<div class="container">
    <form action="{{ route('backend.exibition.store') }}" method="post" enctype="multipart/form-data"
        class="form-group">
        @csrf
        @include('backend.pages.exibition.fields')
    </form>
</div>
@endsection