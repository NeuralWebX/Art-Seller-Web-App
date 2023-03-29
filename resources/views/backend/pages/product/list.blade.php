@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-primary text-center">Product List</h4>
</div>
<a href="{{ route('backend.product.create') }}" class="btn btn-success mb-5">
    <i class="fa-solid fa-plus"></i><strong><span class="ml-3">create</span></strong>
</a>
<div class="table-responsive">
    <table class="table" id="pagination">
        <thead>
            <tr>
                <th scope="col">#Sl</th>
                <th scope="col"> Number</th>
                <th scope="col"> Name</th>
                <th scope="col"> Image</th>
                <th scope="col"> Price</th>
                <th scope="col"> Category</th>
                <th scope="col"> Author</th>
                <th scope="col"> Uploaded</th>
                <th scope="col"> Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
            <tr class="">
                <td>{{ $item->id }}</td>
                <td>{{ $item->product_number }}</td>
                <td>{{ $item->product_name }}</td>
                <td><img width="60px" src="{{ $item->product_image }}" alt="{{ $item->product_name }}"></td>
                <td>{{ number_format($item->product_price, 2) }} <span class="text-danger font-italic">BDT.</span></td>
                <td>{{ $item->category->category_name }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->updated_at->format('Y-m-d') }}</td>
                <td>{{ $item->product_status == 1?'Sold':'Unsold' }}</td>
                <td>
                    <a href="{{ route('backend.product.show',$item->id) }}" class="btn btn-primary">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('backend.product.edit',$item->id) }}" class="btn btn-primary"><i
                            class="fa fa-pencil-square" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('backend.product.destroy',$item->id) }}" class="btn btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection