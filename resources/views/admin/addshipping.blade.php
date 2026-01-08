@extends('admin.mainDesign')

@section('add_shipping')
<div class="container py-4">

    <div class="card shadow-sm p-4 mx-auto" style="max-width: 600px;">

        <h2 class="mb-4 text-center" style="color:white">Add Shipping Fee</h2>

        {{-- Success Message --}}
        @if(session('shippingfee_saved'))
            <div class="alert alert-success">
                {{ session('shippingfee_saved') }}
            </div>
        @endif

        <form action="{{ route('admin.postaddshipping') }}" method="POST">
            @csrf

            {{-- City --}}
            <div class="mb-3">
                <label for="city" class="form-label fw-bold" style="color:white">City</label>
                <input
                    type="text"
                    name="city"
                    id="city"
                    class="form-control"
                    placeholder="Enter city name"
                    required
                >
            </div>

            {{-- Shipping Fee --}}
            <div class="mb-3">
                <label for="shipping_fee" class="form-label fw-bold" style="color:white">Shipping Fee (PKR)</label>
                <input
                    type="number"
                    name="Shippingfee"
                    id="shipping_fee"
                    class="form-control"
                    step="0.01"
                    placeholder="Enter shipping fee"
                    required
                >
            </div>

            {{-- Submit Button --}}
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4">
                    Submit
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
