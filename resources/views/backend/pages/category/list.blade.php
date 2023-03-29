@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-primary text-center">Category List</h4>
</div>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#Sl</th>
                <th scope="col">Category Number</th>
                <th scope="col">Category Name</th>
                <th scope="col">Category Image</th>
                <th scope="col">Category Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $item)
            <tr class="">
                <td>{{ $item->id }}</td>
                <td>{{ $item->category_number }}</td>
                <td>{{ $item->category_name }}</td>
                <td><img width="60px" src="{{ $item->category_image }}" alt="{{ $item->category_name }}"></td>
                <td>{{ $item->category_status == 1?'Active':'Inactive' }}</td>
                <td>
                    <a href="{{ route('backend.category.edit') }}" class="btn btn-primary"><i
                            class="fa fa-pencil-square" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('backend.category.edit') }}" class="btn btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection