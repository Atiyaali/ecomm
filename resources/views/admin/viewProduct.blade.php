@extends('admin.mainDesign')
@section('view_product')
@if(session('product_deleted'))
    <div class="alert alert-success">
       {{ session('product_deleted') }}
    </div>
@endif
<div class="container-fluid">
    {{-- {{ route('admin.viewProduct') }} --}}
<form action="{{ route('admin.viewSearchProduct') }}" method="POST" class="mb-3">
    @csrf
    <div class="input-group">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search product..."
               value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>
<button class="btn btn-secondary mb-3" onclick="window.location='{{ route('admin.viewProduct') }}'">Reset</button>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Description</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>

  <tbody>

@foreach ( $products as $item )

    <tr>
        <td scope="row">{{$item->id}}</td>

    <td><img src="{{asset('storage/productimage/'.$item->image)}}"  width="50"></td>
    {{-- <td class="no-wrap"><img src="{{ asset('storage/' . $speaker->photo) }}" width="50"></td> --}}

      <td>{{$item->name}}</td>
      <td>{{$item->category->name}}</td>
      <td>{{$item->description}}</td>
      <td>{{$item->quantity}}</td>
      <td>{{$item->price}}</td>
          <td>
{{-- <button type="button" class="btn btn-light">Edit</button> --}}
<a class="btn btn-light" type="button"  href="{{ route('admin.editproduct', $item->id )  }}">Update</a>
<a class="btn btn-danger" type="button"  href="{{ route('admin.deleteproduct', $item->id ) }} " onclick="return confirm('Are You Sure to Delete that record?')">Delete</a>

</td>
    </tr>
@endforeach
  </tbody>
</table>
</div>
@endsection
