@extends('backend.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total Payable</h4>
                    <p class="text-primary">{{ payableDue() }} BDT.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total Sold</h4>
                    <p class="text-primary">{{ totalSold() }} Items</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total Owned</h4>
                    <p class="text-primary">{{ ownedItems() }} Items</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
