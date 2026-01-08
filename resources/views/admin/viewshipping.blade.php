{{-- resources/views/shipping_fee_index.blade.php --}}

@extends('admin.mainDesign')
@section('view_shipping')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Shipping Fees</h2>

    {{-- Success message --}}
    @if(session('shippingfee_deleted'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('shippingfee_deleted') }}
        </div>
    @endif
    {{-- Add new button --}}
    <div class="mt-4">
        <a href="{{ route('admin.addshipping') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add New Shipping Fee</a>
    </div>
    <table class="min-w-full border border-gray-300 rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-2 border-b">#</th>
                <th class="px-4 py-2 border-b">City</th>
                <th class="px-4 py-2 border-b">Shipping Fee (PKR)</th>
                <th class="px-4 py-2 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shippingfee as $fee)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border-b">{{ $fee->city }}</td>
                    <td class="px-4 py-2 border-b">{{ number_format($fee->Shippingfee, 2) }}</td>
                    <td class="px-4 py-2 border-b space-x-2 ">
                        <a href="{{ route('admin.editshipping' , $fee->id) }}"  class="btn" style="background-color: blue; color:beige">Edit</a>

 <a href="{{ route('admin.deleteshipping' , $fee->id ) }}"  class="btn bg-blue-600" onclick="return confirm('Are you sure you want to delete this shipping fee?');" style="background-color: red;  color:white">Delete</a>


                        {{-- <form action="{{ route('admin.deleteshipping' , $fee->id ) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this shipping fee?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn">Delete</button>
                        </form> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center">No shipping fees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>


</div>
@endsection
