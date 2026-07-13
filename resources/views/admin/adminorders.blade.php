@extends('admin.adminmaster')

@section('content')

<div class="container mt-5 mb-5">

<table id="myTable" class="display">

<thead>

<tr>

<th>ID</th>

<th>Name</th>

<th>Phone</th>

<th>Total</th>

<th>Delivery Status</th>

<th>Date</th>

<th>Actions</th>

</tr>

</thead>

<tbody>

@foreach($orders as $order)

<tr>

<td>{{ $order->id }}</td>

<td>{{ $order->name }}</td>

<td>{{ $order->phone }}</td>

<td>{{ number_format($order->total) }} EGP</td>

<td>

@if($order->delivery_status=="processing")

<span class="badge bg-warning">

Processing

</span>

@elseif($order->delivery_status=="shipping")

<span class="badge bg-primary">

Shipping

</span>

@elseif($order->delivery_status=="delivered")

<span class="badge bg-success">

Delivered

</span>

@else

<span class="badge bg-danger">

cancelled

</span>

@endif

</td>

<td>

{{ $order->created_at->format('Y-m-d') }}

</td>

<td>

<a href="{{ route('adminorderdetails',$order->id) }}"
class="btn btn-dark">

Details

</a>

<a href="{{ route('admindeleteorder',$order->id) }}"
class="btn btn-danger">

Delete

</a>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection


@push('scripts')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#myTable').DataTable({
        order: [[0, 'desc']]
    });
});
</script>
@endpush
