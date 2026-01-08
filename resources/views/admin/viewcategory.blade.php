@extends('admin.mainDesign')
@section('view_category')
@if(session('category_deleted'))
    <div class="alert alert-success">
       {{ session('category_deleted') }}
    </div>
@endif
<div class="container-fluid">

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>

  <tbody>

@foreach ( $data as $item )
    <tr>
        <td scope="row">{{$item->id}}</td>
         <td><img src="{{asset('storage/categoryimage/'.$item->image)}}"  width="50"></td>
      <td>{{$item->name}}</td>
      <td>
{{-- <button type="button" class="btn btn-light">Edit</button> --}}
<a class="btn btn-light" type="button"  href="{{ route('admin.editcatagory', $item->id )  }}">Update</a>
<a class="btn btn-danger" type="button"  href="{{ route('admin.deletecategory', $item->id ) }} " onclick="return confirm('Are You Sure to Delete that record?')">Delete</a>

</td>
    </tr>
@endforeach
  </tbody>
</table>
</div>
@endsection
