@extends('nav');
@section('cart')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 5px 10px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #ff1a1a;
        }
    </style>

    <h1 style="padding: 20px">Your Cart</h1>
@if ($cart)
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>


        <tbody>

@php
$grandtotal = 0;
@endphp

@foreach ($cart->CartItem as $item )
            @php
            $total = $item->Product->price * $item->quantity;
            $grandtotal = $grandtotal+ $total;
            @endphp
            <tr>
                <td>{{$item->Product->id}}</td>
                <td>{{$item->Product->name}}</td>
                <td>{{$item->Product->price}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{ $total }}</td>
                <td><a href="{{ route('deleteCartItem', $item->id) }}">Remove</a></td>
            </tr>
    @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Grand Total:</strong></td>
                <td colspan="2"><strong>{{ $grandtotal}}</strong></td>
            </tr>
        </tfoot>
            </table>
               <br>
               {{-- <a  class="btn" style="background-color: #4CAF50;" href="{{ route('checkout',$cart->id) }}">CheckOut</a> --}}
    {{-- <button class="btn" style="background-color: #4CAF50;">Proceed to Checkout</button> --}}
 <a  class="btn" style="background-color: #4CAF50;" href="{{ route('order',$cart->id) }}">CheckOut</a>
 @else

     <h2><div style='text-align:center'>No Item Added in cart yet</div></h2>


@endif





@endsection
