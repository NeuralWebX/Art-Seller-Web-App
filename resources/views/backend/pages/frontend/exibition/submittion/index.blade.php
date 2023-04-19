@extends('backend.pages.frontend.exibition.submittion.master')
@section('content')
<h3 class="text-primary text-center">Exibitions</h3>
<div class="container">
    <div class="row">
        @foreach ($Exibitions as $item)
        <div class="col-md-4">
            <div class="card">
                <img style="width: 200px" src="{{ url('/uploads/exibition_images',$item->image) }}" alt="Title">
                <div class="card-body">
                    <h4 class="card-title">{{ $item->name }}</h4>
                    <p class="card-text">{{ $item->description }}</p>
                    <a href="{{ route('backend.exibitionEvent.show',$item->id) }}" class="btn btn-primary">More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection