@extends('admin.adminmaster')

@section('content')

<div class="product-section mt-150 mb-150">

    <div class="container">

        <div class="row">

            <div class="col-lg-8 offset-lg-2 text-center">

                <div class="section-title">

                    <h3>

                        <span class="orange-text">Order</span>
                        Details

                    </h3>

                </div>

            </div>

        </div>


        <div class="row">

            <div class="col-lg-10 offset-lg-1">

                <!-- ========================= -->
                <!-- Order Information -->
                <!-- ========================= -->

                <div class="card shadow-lg border-0 rounded-3 mb-5">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">

                            Order Information

                        </h5>

                    </div>

                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <strong>Order ID</strong>

                                <p>{{ $order->id }}</p>

                            </div>

                            <div class="col-md-6 mb-3">

                                <strong>Customer</strong>

                                <p>{{ $order->name }}</p>

                            </div>

                            <div class="col-md-6 mb-3">

                                <strong>Phone</strong>

                                <p>{{ $order->phone }}</p>

                            </div>

                            <div class="col-md-6 mb-3">

                                <strong>Additional Phone</strong>

                                <p>{{ $order->additional_phone ?: '-' }}</p>

                            </div>

                            <div class="col-md-12 mb-3">

                                <strong>Address</strong>

                                <p>{{ $order->address }}</p>

                            </div>

                            <div class="col-md-12">

                                <strong>Note</strong>

                                <p>{{ $order->note ?: '-' }}</p>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- ========================= -->
                <!-- Payment -->
                <!-- ========================= -->

                <div class="card shadow-lg border-0 rounded-3 mb-5">

                    <div class="card-header bg-primary text-white">

                        <h5 class="mb-0">

                            Payment Information

                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-3">

                                <strong>Subtotal</strong>

                                <p>{{ number_format($order->subtotal) }} EGP</p>

                            </div>

                            <div class="col-md-3">

                                <strong>Shipping</strong>

                                <p>{{ number_format($order->shipping_cost) }} EGP</p>

                            </div>

                            <div class="col-md-3">

                                <strong>Total</strong>

                                <p>{{ number_format($order->total) }} EGP</p>

                            </div>

                            <div class="col-md-3">

                                <strong>Payment</strong>

                                <p>{{ $order->payment_method }}</p>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- ========================= -->
                <!-- Products -->
                <!-- ========================= -->

                <div class="card shadow-lg border-0 rounded-3 mb-5">

                    <div class="card-header bg-success text-white">

                        <h5 class="mb-0">

                            Ordered Products

                        </h5>

                    </div>

                    <div class="card-body">

                        <table class="table table-bordered table-hover align-middle">

                            <thead>

                                <tr>

                                    <th>Image</th>

                                    <th>Name</th>

                                    <th>Price</th>

                                    <th>Qty</th>

                                    <th>Total</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($order->orderItems as $item)

                                <tr>

                                    <td>

                                        <img
                                            src="{{ asset('uploads/images/'.$item->product->imagepath) }}"
                                            width="90"
                                            class="rounded">

                                    </td>

                                    <td>

                                        {{ $item->product->name }}

                                    </td>

                                    <td>

                                        {{ number_format($item->price) }} EGP

                                    </td>

                                    <td>

                                        {{ $item->quantity }}

                                    </td>

                                    <td>

                                        {{ number_format($item->total) }} EGP

                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>


                <!-- ========================= -->
                <!-- Actions -->
                <!-- ========================= -->

                <div class="card shadow-lg border-0 rounded-3">

                    <div class="card-header bg-warning">

                        <h5 class="mb-0">

                            Order Actions

                        </h5>

                    </div>

                    <div class="card-body">

                        <form
                            action="{{ route('adminchangeorderstatus',$order->id) }}"
                            method="POST">

                            @csrf

                            <div class="mb-4">

                                <label class="fw-bold">

                                    Delivery Status

                                </label>

                                <select
                                    name="delivery_status"
                                    class="form-select">

                                    <option value="processing"
                                        {{ $order->delivery_status=='processing'?'selected':'' }}>
                                        Processing
                                    </option>

                                    <option value="shipping"
                                        {{ $order->delivery_status=='shipping'?'selected':'' }}>
                                        Shipping
                                    </option>

                                    <option value="delivered"
                                        {{ $order->delivery_status=='delivered'?'selected':'' }}>
                                        Delivered
                                    </option>

                                    <option value="cancelled"
                                        {{ $order->delivery_status=='cancelled'?'selected':'' }}>
                                        Cancelled
                                    </option>

                                </select>

                            </div>

                            <button
                                class="btn btn-primary">

                                Update Status

                            </button>

                            <a
                                href="{{ route('admindeleteorder',$order->id) }}"
                                class="btn btn-danger">

                                Delete Order

                            </a>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
