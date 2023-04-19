@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-primary text-center">Order List</h4>
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
                    <a href="{{ route('backend.order.management.preview',$item->id) }}" class="btn btn-success">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="{{ route('backend.order.management.invoice',$item->id) }}" class="btn btn-primary">
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