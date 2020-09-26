@extends('admin.layout.base')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title">Employee Documents</h4><a href="{{ route('admin.document-upload') }}" class="btn btn-success">Upload Documents</a><br><br><br>
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
                        <th>Original Name</th>
                        <th>CreatedAt</th> 
                        <th>Document</th>
                        <th>Action</th>                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($employeeDocuments as $index => $document)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $document->employee_name }}</td>
                        <td>{{ $document->originalName }}</td> 
                        <td>{{ $document->created_at }}</td>
                        <td><a target="_blank" href="{{ url('storage/'.$document->emp_doc)}}"><button class="btn btn-success">View Document</button></a></td>
                        <td>
                        <form action="{{ route('admin.document-delete', $document->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Original Name</th>
                        <th>CreatedAt</th>
                        <th>Document</th>
                        <th>Action</th>  
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
