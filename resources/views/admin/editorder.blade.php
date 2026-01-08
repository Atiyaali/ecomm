@extends('admin.mainDesign')
<base href="/public">
@section('edit_order')
@if(session('order_updated'))
    <div class="alert alert-success">
       {{ session('order_updated') }}
    </div>
@endif
<div class="container">
    <h2>Edit Order Status</h2>

    <div class="card mt-3">
        <div class="card-body" style="background-color: #f8f9fa;">

            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
            <p><strong>Current Payment Status:</strong> {{ $order->payment_status }}</p>
            <p><strong>Current Order Status:</strong> {{ $order->order_status }}</p>

            <hr>

            <form action="{{ route('admin.posteditorder', $order->id) }}" method="POST">
                @csrf
                @method('POST')

                {{-- Order Status --}}
                <div class="mb-3">
                    <label class="form-label">Order Status</label>
                    <select name="order_status" class="form-control" required>
                        @foreach ([
                            'confirmed',
                            'processing',
                            'shipped',
                            'delivered',
                            'cancelled',
                            'returned'
                        ] as $status)
                            <option value="{{ $status }}"
                                {{ $order->order_status === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Payment Status --}}
                <div class="mb-3">
                    <label class="form-label">Payment Status</label>

                    @if ($order->payment_method === 'card')
                      
                        <input type="text"
                               class="form-control"
                               value="{{ $order->payment_status }}"
                               disabled>
                        <small class="text-muted">
                            Card payment status is controlled by Stripe.
                        </small>
                    @else
                        {{-- COD payment --}}
                        <select name="payment_status" class="form-control">
                            @foreach (['pending', 'paid', 'failed','Refunded'] as $pstatus)
                                <option value="{{ $pstatus }}"
                                    {{ $order->payment_status === $pstatus ? 'selected' : '' }}>
                                    {{ ucfirst($pstatus) }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Status
                </button>

                {{-- <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                    Cancel
                </a> --}}
            </form>

        </div>
    </div>
</div>
@endsection
