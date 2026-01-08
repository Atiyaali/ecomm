@extends('admin.mainDesign')
@section('add_category')
@if(session('category_added'))
    <div class="alert alert-success">
       {{ session('category_added') }}
    </div>
@endif
<div class="container-fluid">
    <h2>Add Category</h2>
<form action="{{ route('admin.postaddcategory') }}" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Category Name</label>
    <input type="text" class="form-control" id="name" name="name">
     <label for="image" class="form-label">Category Image</label>
    <input type="file" class="form-control" id="image" name="image">

  </div>
  <div class="mb-3">

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection
