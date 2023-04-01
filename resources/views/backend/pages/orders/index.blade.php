@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-primary text-center">Order List</h4>
</div>
<div class="container">
    <div class="row form-group">
        <div class="col-md-4">
            <label for="author">Author:</label>
            <select name="author" id="author" class="form-control">
                <option value=""> - - - Select Any - - - </option>
                @foreach ($authors as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="year">Year:</label>
            <select class="form-control" id="year" name="year">
                <option value=""> - - - Select Any - - - </option>
                @for ($i = date('Y'); $i >= 2000; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-4">
            <label for="month">Month:</label>
            <select class="form-control" id="month" name="month">
                <option value=""> - - - Select Any - - - </option>
                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                    @endfor
            </select>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table" id="pagination">
        <thead>
            <tr>
                <th scope="col">Sl.</th>
                <th scope="col">Number</th>
                <th scope="col">Transaction Id</th>
                <th scope="col">Currency</th>
                <th scope="col">Order Status</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $item)
            <tr class="">
                <td>{{ $item->id }}</td>
                <td>{{ $item->order_number }}</td>
                <td>{{ $item->transaction_id }}</td>
                <td>{{ $item->currency }}</td>
                <td>{{ $item->order_status }}</td>
                <td>{{ $item->payment_status }}</td>
                <td>{{ $item->payment_method }}</td>
                <td>
                    <a href="http://" class="btn btn-success">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="http://" class="btn btn-primary">
                        <i class="fa-solid fa-print"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#author').change(function() {
        var authorId = $(this).val();
        $.ajax({
            url: "{{ route('backend.order.management.byAuthor', ':author_id') }}".replace(':author_id', authorId),
            method: 'GET',
            data: { author_id: authorId },
                success: function(response) {
                    console.log(response);
                    $('#pagination tbody').empty();
                    for (var i = 0; i < response.length; i++) {
                        var order=response[i];
                        var rowHtml=`
                        <tr>
                        <td>${order.id}</td>
                        <td>${order.author}</td>
                        <td>${order.total}</td>
                        </tr>
                    `;
                    $('#order-table tbody').append(rowHtml); }
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        });
});
</script>
@endsection