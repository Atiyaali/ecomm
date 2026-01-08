@extends('admin.mainDesign')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">Cancelled Orders</h4>
        </div>

        <div class="card-body">
            @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>

                            <th>#</th>
                            {{-- <th>Order ID</th> --}}
                            <th>Order Number</th>
                            <th>Customer</th>
                            <th>Cancelled Reason</th>
                            <th>Cancelled At</th>
                            <th>Payment Status</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $key => $order)
                        <tr style="background-color: #ffe6e6;">
                            <td>{{ $key + 1 }}</td>
                            {{-- <td>{{ $order->id }}</td> --}}
                            <td>{{ $order->Order->order_number }}</td>
                            <td>{{ $order->User->name ?? 'N/A' }}</td>
                            <td>
                                {{ $order->cancellation_reason ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $order->created_at->format('d M, Y') ?? 'N/A' }}
                            </td>
                            <td>
                                {{ ucfirst($order->Order->payment_status) }}
                            </td>
                            {{-- <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                   class="btn btn-sm btn-primary">
                                   View
                                </a>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p class="text-center text-muted">No cancelled orders found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
