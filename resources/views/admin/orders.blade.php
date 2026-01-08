@extends('admin.mainDesign')

@section('orders')
@if(session('order_Deleted'))
    <div class="alert alert-success">
       {{ session('order_Deleted') }}
    </div>
@endif
<style>
    .bg-cancelled {
      background-color: #B22222 !important;
color: #FFFFFF !important;
    }

    .bg-cancelled td {
          background-color: #B22222 !important;
color: #FFFFFF !important;
    }
</style>
<div class="container mt-4">
    <h2 class="mb-4">All Orders</h2>

    {{-- Responsive table wrapper --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>User</th>
                    <th>Order Number</th>
                    <th>Order Status</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Subtotal</th>
                    <th>Shipping Fee</th>
                    <th>Total</th>
                    <th>Shipping Address</th>
                    <th>Items</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)

             <tr class="{{ strtolower($order->order_status) === 'cancelled' ? 'bg-cancelled' : '' }}">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d M, Y')  }}</td>
                        <td>{{ $order->User->name ?? 'N/A' }}</td>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->order_status }}</td>
                        <td>{{ ucfirst($order->payment_method) ?? 'N/A' }}</td>
                        <td>{{ ucfirst($order->payment_status) ?? 'N/A' }}</td>
                        <td>{{ $order->subtotal }}</td>
                        <td>{{ $order->shipping_fee ?? 0 }}</td>
                        <td>{{ $order->total ?? $order->subtotal + ($order->shipping_fee ?? 0) }}</td>
                        <td>
                            @if($order->shipping_address)
                                {{ $order->shipping_address['street'] ?? '' }},
                                {{ $order->shipping_address['city'] ?? '' }},
                                {{ $order->shipping_address['zip'] ?? '' }}
                            @endif
                        </td>
                        <td>
                            <ul>
                                @foreach($order->OrderItem as $item)
                                    <li>{{ $item->Product->name ?? 'Product Deleted' }} x {{ $item->quantity }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <a href="{{ route('admin.deleteorder', $order->id) }}"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this order?')">
                               Delete
                            </a>
                            <a href="{{ route('admin.editorder', $order->id) }}"
                               class="btn btn-primary btn-sm">
                               Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
