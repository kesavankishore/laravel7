@extends('admin.layout.base')
@section('title', 'Admin List')
@section('content')

  <a href="/add" class="btn btn-sm btn-primary">Add User</a>
  <a href="/upload" class="btn btn-sm btn-primary">Uploads</a><br/><br/>
  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Create at</th>
        <!-- <th>File</th> -->
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($admins as $index => $admin)
            <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->created_at }}</td>
                <!-- <td><img src = "../my_uploads/<%= user.file %>" width=80/></td> -->
                <td>
                    <!-- <a href="edit/<%= user.id %>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="delete/<%= user.id %>" class="btn btn-sm btn-danger">Delete</a> -->
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  

@endsection
