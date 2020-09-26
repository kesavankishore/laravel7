@extends('admin.layout.base')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">

    	<div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title">Multiple File Upload</h4>
                <!-- <a href="{{ route('admin.employee.index') }}" class="btn btn-success">List employee</a> -->
            </div>
        </div>

    	<div class="box box-block bg-white">
    		  
    
			<form class="form-horizontal" enctype="multipart/form-data" id="employee_form" role="form">
				{{csrf_field()}}
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">Employee Name</label>
      <select class="browser-default custom-select" name="emp_id"  id="emp_id">
        <option value="">Select Employee..</option>
        @foreach($emps as $index => $emp)
        <option value="{{$emp->id}}">{{$emp->employee_name}}</option>
        @endforeach
     </select>
      <span class="text-danger" id="emp_id-error"></span>
    </div>
	</div>
	<div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Upload Document</label>
      <input class="form-control" type="file" name="emp_doc[]" id="emp_doc" multiple>
      <span class="text-danger" id="emp_doc-error"></span>
    </div>
    </div>
    
	

  
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-8">
						<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Upload Document</button>
						<a href="{{route('admin.document')}}" class="btn btn-danger">Cancel</a>
            <br><span class="text-success" id="success-message"></span>
					</div>
				
</form>

<script>
        $("#employee_form").on("submit", function(e) {
          if(!confirm("Do you really want to upload multiple files?")) {
              return false;
            }
            e.preventDefault();
            $('#emp_id-error').text('');
            $('#emp_doc-error').text('');
            $('#success-message').text('');
            $.ajax({
                type: "POST",
                url:  "{{route('admin.upload')}}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                success: function(response) {console.log(response);
                  console.log(response);
                  if (response) {
                      //alert('success');
                    $('#success-message').text(response.success);
                    $("#employee_form")[0].reset();
                  }
                },
                error: function(response) {
                  //alert(response);
                  $('#emp_id-error').text(response.responseJSON.errors.emp_id);
                  $('#emp_doc-error').text(response.responseJSON.errors.emp_doc);
                }
            });
        });
    </script>

		</div>
    </div>
</div>




@endsection

@section('script')
    
@endsection