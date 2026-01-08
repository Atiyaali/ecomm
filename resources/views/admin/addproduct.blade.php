@extends('admin.mainDesign')
@section('add_product')
@if(session('product_added'))
    <div class="alert alert-success">
       {{ session('product_added') }}
    </div>
@endif
<div class="container-fluid">
    <h2>Add Product</h2>
<form action="{{ route('admin.postaddproduct') }}" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Product Name</label>
    <input type="text" class="form-control" id="name" name="name">
    <label for="description" class="form-label">Product Description</label>
    <textarea class="form-control" id="description" name="description"></textarea>
    <label for="quantity" class="form-label">Product Quantity</label>
    <input type="number" class="form-control" id="quantity" name="quantity">
    <label for="price" class="form-label">Product Price</label>
    <input type="number" class="form-control" id="price" name="price">
    <label for="image" class="form-label">Product Image</label>
    <input type="file" class="form-control" id="image" name="image">
    <label for="category" class="form-label">Product Category</label>
    <select class="form-control" id="category" name="category">
        <option value="">Select Category</option>
        @foreach($category as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>




  </div>
  <div class="mb-3">

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection
