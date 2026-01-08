@extends('nav');
@section('product_detail')

<style>
    .product-container {
        width: 90%;
        margin: 30px auto;
        display: flex;
        gap: 40px;
    }

    /* For smaller screens */
    @media (max-width: 768px) {
        .product-container {
            flex-direction: column;
        }
    }

    .product-image {
        width: 50%;
    }

    .product-image img {
        width: 100%;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .product-details {
        width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 20px;
    }

    .product-title {
        font-size: 32px;
        font-weight: bold;
    }

    .product-description {
        font-size: 18px;
        color: #555;
        line-height: 1.5;
    }

    .product-price {
        font-size: 26px;
        font-weight: bold;
        color: green;
    }

    .add-cart-btn {
        padding: 12px 25px;
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        cursor: pointer;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        transition: 0.2s;
    }

    .add-cart-btn:hover {
        background: #1e4ecf;
    }
</style>
@if(session('product_added_to_cart'))
    <div class="alert alert-success">
       {{ session('product_added_to_cart') }}
    </div>
@endif
<div class="product-container">


    <div class="product-image">
        <img src="{{ asset('storage/productimage/'.$product->image) }}" alt="{{ $product->name }}">
    </div>


    <div class="product-details">
        <h1 class="product-title">{{ $product->name }}</h1>

        <p class="product-description">
            {{ $product->description }}
        </p>

        <div class="product-price">
            {{ number_format($product->price, 2) }}   PKR
        </div>

<a href="{{ route("add_to_cart" , $product->id) }}" class="add-cart-btn">Add To Cart</a>
    </div>

</div>
@endsection
