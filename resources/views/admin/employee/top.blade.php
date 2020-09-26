@extends('admin.layout.base')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title">Employee - Top 5 Salary</h4><br>
            </div>
            
        </div>
        @if (count($errors) > 0)
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('flash_error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('flash_error') }}
    </div>
@endif


@if(Session::has('flash_success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('flash_success') }}
    </div>
@endif

        <div class="box box-block bg-white">
            <table class="table table-striped table-bordered dataTable" id="example">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Salary</th>
                        <th>Address</th>
                        <th>CreatedAt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $index => $employee)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $employee->employee_name }}</td>
                        <td>{{ $employee->employee_email }}</td>
                        <td>${{ $employee->employee_salary }}</td>
                        <td>{{ $employee->employee_address	 }}</td>
                        <td>{{ $employee->created_at }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                    <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Salary</th>
                        <th>Address</th>
                        <th>CreatedAt</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection
