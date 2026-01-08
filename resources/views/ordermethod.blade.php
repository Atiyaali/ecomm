@extends('nav');

@section('ordermethod')
<div class="container mx-auto p-4">

    <h2 class="text-2xl font-bold mb-4">Select Payment Method</h2>

    <form action="{{ route('ordercomplete', $order->id) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium mb-2">Choose Payment Method:</label>

            <div class="flex items-center space-x-3">
                <input type="radio" id="cod" name="payment_method" value="cod" required>
                <label for="cod">Cash on Delivery (COD)</label>
            </div>

            <div class="flex items-center space-x-3">
                <input type="radio" id="card" name="payment_method" value="card" required>
                <label for="card">Credit / Debit Card</label>
            </div>
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" style="background-color: rgb(17, 17, 225); border-radius: 5px; border: none; padding: 10px 20px; color: white; cursor: pointer;">
            Continue
        </button>
    </form>
</div>
@endsection
