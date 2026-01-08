@extends('mainUser')
<base href="/public">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 style="color: white;">Cancel Order</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('ordercancel', $order->id) }}" method="POST">
                        @csrf
                        @method('POST')

                        <!-- Cancellation Reason -->
                        <div class="mb-3">
                            <label for="reason" class="form-label">
                                Reason for Cancellation <span class="text-danger">*</span>
                            </label>

                            <select name="cancellation_reason" id="reason" class="form-control" required>
                                <option value="">-- Select Reason --</option>
                                <option value="Ordered by mistake">Ordered by mistake</option>
                                <option value="Found cheaper elsewhere">Found cheaper elsewhere</option>
                                <option value="Delivery is too slow">Delivery is too slow</option>
                                <option value="Changed my mind">Changed my mind</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Custom Reason -->
                        {{-- <div class="mb-3">
                            <label for="custom_reason" class="form-label">
                                Additional Details (Optional)
                            </label>
                            <textarea name="custom_reason" id="custom_reason" class="form-control" rows="3"
                                placeholder="Write your reason here..."></textarea>
                        </div> --}}

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            {{-- <a href="{{ route('orders.show', $order->id) }}" class="btn btn-secondary">
                                Back
                            </a> --}}
                            <button type="submit" class="btn btn-danger">
                                Cancel Order
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
