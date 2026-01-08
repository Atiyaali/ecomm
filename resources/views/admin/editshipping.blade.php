{{-- resources/views/shipping_fee_form.blade.php --}}
@extends('admin.mainDesign')
<base href="/public">
@section('edit_shipping')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Update Shipping Fee</h2>

    {{-- Display validation errors --}}
@if(session('shippingfee_updated'))
    <div class="alert alert-success">
       {{ session('shippingfee_updated') }}
    </div>
@endif

    {{-- Form --}}
    <form action="{{ route('admin.posteditshipping' , $shippingfee->id) }}" method="POST" class="space-y-4">
        @csrf
        {{-- City --}}
        <div>
            <label for="city" class="block font-medium mb-1">City</label>
            <input type="text" name="city" id="city" class="border p-2 w-full rounded"  value="{{ $shippingfee->city }}"  required>
        </div>

        {{-- Shipping Fee --}}
        <div>
            <label for="shipping_fee" class="block font-medium mb-1">Shipping Fee</label>
            <input type="number" name="Shippingfee" id="shipping_fee" class="border p-2 w-full rounded" value="{{ $shippingfee->Shippingfee }}" required >
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit" class="btn">
                Submit
            </button>
        </div>
    </form>
</div>
@endsection
