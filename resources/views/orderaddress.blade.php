@extends('nav');

@section('address')
<div class="container mt-5">
    <h2 class="mb-4">Order Address</h2>

    @if(session('address_saved'))
        <div class="alert alert-success">
            {{ session('address_saved') }}
        </div>
    @endif

    <form action="{{ route('orderaddress', $order) }}" method="POST">
        @csrf

        {{-- Full Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input
                type="text"
                name="shipping_address[name]"
                id="name"
                class="form-control"
                {{-- placeholder="John Doe" --}}
                required
            >
        </div>

        {{-- Phone Number --}}
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input
                type="text"
                name="shipping_address[phone]"
                id="phone"
                class="form-control"
                {{-- placeholder="03001234567" --}}
                required
            >
        </div>

        {{-- City --}}
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <select
                name="shipping_address[city]"
                id="city"
                class="form-select"
                required
            >
                <option value="">Select City</option>
                @foreach($cities as $city)
                    <option value="{{ $city }}">{{ $city }}</option>
                @endforeach
            </select>
        </div>

        {{-- Street Address --}}
        <div class="mb-3">
            <label for="street" class="form-label">Street Address</label>
            <input
                type="text"
                name="shipping_address[street]"
                id="street"
                class="form-control"
                placeholder="123 Street Name"
                required
            >
        </div>

        {{-- Zip Code --}}
        <div class="mb-3">
            <label for="zip" class="form-label">Zip Code</label>
            <input
                type="text"
                name="shipping_address[zip]"
                id="zip"
                class="form-control"
                placeholder="54000"
            >
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-success">Save Address</button>
    </form>
</div>
@endsection
