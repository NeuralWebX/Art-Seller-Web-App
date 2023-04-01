@extends('backend.master')
@section('content')
<div class="mx-auto">
    <h4 class="text-primary text-center">Order List</h4>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <select name="author" id="author" class="form-control">
                @foreach ($authors as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
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
                    $('#order-table tbody').empty();
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