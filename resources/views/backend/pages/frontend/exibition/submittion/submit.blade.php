@extends('backend.pages.frontend.exibition.submittion.index')
@section('content')
<div class="mx-auto mt-5">
    <h4 class="text-center text-primary">Exibition Submittion</h4>
</div>
<div class="container">
    <form action="{{ route('backend.exibitionEvent.submitttion',$Exibition->id) }}" method="POST"
        enctype="multipart/form-data">
        @if ($errors->any())
        <ul class="list-group list-group-flush">
            @foreach ($errors->all() as $error)
            <li class="list-group-item text-danger">{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        @csrf
        <div class="mb-3">
            <label for="artist_name" class="form-label">Artist Name</label>
            <input type="text" class="form-control @error('artist_name') is-invalid @enderror" id="artist_name"
                name="artist_name" required>
            @error('artist_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="artwork_title" class="form-label">Artwork Title</label>
            <input type="text" class="form-control @error('artwork_title') is-invalid @enderror" id="artwork_title"
                name="artwork_title" required>
            @error('artwork_title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                name="description"></textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
