@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-center text-primary">Exibition Edit</h4>
</div>
<div class="container">
    <form action="{{ route('backend.exibition.update',$Exibition->id) }}" method="post" enctype="multipart/form-data"
        class="form-group">
        @method('put')
        @csrf
        @include('backend.pages.exibition.fields')
    </form>
</div>
@endsection
