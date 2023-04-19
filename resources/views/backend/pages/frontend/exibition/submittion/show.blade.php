@extends('backend.pages.frontend.exibition.submittion.index')
@section('content')
<div class="mx-auto">
    <h4 class="text-center text-primary">Exibition View</h4>
</div>
<div class="container">
    <div class="card">
        <img class="card-img-top" style="width: 400px" src="{{ url('/uploads/exibition_images', $Exibition->image) }}"
            alt="{{ $Exibition->name }}">
        <div class="card-body">
            <h4 class="mt-2 mb-2 card-title"><span class="mr-2 text-primary">Exbition Name:</span> {{ $Exibition->name
                }}
            </h4>
            <h5 class="card-text"><span class="mr-2 text-primary">Exbition Details:</span>{{ $Exibition->description }}
            </h5>
            <h5 class="card-text"><span class="mr-2 text-primary">Exbition Location:</span>{{ $Exibition->location }}
                <h5 class="card-text"><span class="mr-2 text-primary">Exbition Timeline:</span>{{ date('Y-m-d h:i A',
                    strtotime($Exibition->start_at)) }} to
                    {{ date('Y-m-d h:i A', strtotime($Exibition->end_at)) }}
                </h5>
        </div>
    </div>
    <a href="{{ route('backend.exibitionEvent.submit',$Exibition->id) }}" class="btn btn-primary">Submit Yours</a>
</div>
<div class="container mt-5">
    <h4 class="text-center text-primary">Exibition Submittions</h4>
</div>
<div class="container">
    <div class="row">
        @foreach ($Exibition->exibitionSubmittion as $item)
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="{{ url('/uploads/exibition_images',$item->image) }}" alt="Title">
                <div class="card-body">
                    <h4 class="card-title">{{ $item->artwork_title }}</h4>
                    <p class="card-text">{{ $item->artist_name }}</p>
                    <p class="card-text">{{ $item->artwork_number }}</p>
                    <p class="card-text">{{ $item->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection