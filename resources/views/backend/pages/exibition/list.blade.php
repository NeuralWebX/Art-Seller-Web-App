@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-center text-primary">Exibition List</h4>
</div>
<a href="{{ route('backend.exibition.create') }}" class="mb-5 btn btn-success">
    Create
</a>
<div class="table-responsive">
    <table class="table" id="pagination">
        <thead>
            <tr>
                <th scope="col">#Sl</th>
                <th scope="col">Exibition Name</th>
                <th scope="col">Exibition Image</th>
                <th scope="col">Exibition Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Exibitions as $item)
            <tr class="">
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td><img width="60px" src="{{ url('/uploads/exibition_images', $item->image) }}"
                        alt="{{ $item->name }}"></td>
                <td>{{ $item->status == 1?'Active':'Inactive' }}</td>
                <td>
                    <a href="{{ route('backend.exibition.show',$item->id) }}" class="btn btn-success">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('backend.exibition.edit',$item->id) }}" class="btn btn-primary"><i
                            class="fa fa-pencil-square" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('backend.exibition.destroy',$item->id) }}" class="btn btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection