@extends('admin.mainDesign')

@section('users')
@if(session('user_Deleted'))
    <div class="alert alert-success">
       {{ session('user_Deleted') }}
    </div>
@endif

<div class="container mt-4">
    <h2 class="mb-4">All Users</h2>

    {{-- Responsive table wrapper --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>

                    <th>Sr NO</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('admin.deleteuser', $user->id) }}"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this user?')">
                               Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
