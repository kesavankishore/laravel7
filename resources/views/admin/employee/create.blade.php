@extends('admin.layout.base')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">

    	<div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title">Employee Add</h4>
                <!-- <a href="{{ route('admin.employee.index') }}" class="btn btn-success">List employee</a> -->
            </div>
        </div>

			<form class="form-horizontal" enctype="multipart/form-data" id="employee_form" role="form">
				{{csrf_field()}}
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">Employee Name</label>
      <input class="form-control" type="text" value="{{ old('employee_name') }}" name="employee_name"  id="employee_name" placeholder="Employee Name">
      <span class="text-danger" id="employee_name-error"></span>
    </div>
	</div>
	<div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Employee Email</label>
      <input class="form-control" type="text" name="employee_email" value="{{old('employee_email')}}" id="employee_email" placeholder="Employee Email">
      <span class="text-danger" id="employee_email-error"></span>
    </div>
    </div>
    <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Employee Salary</label>
      <input class="form-control" type="text" name="employee_salary" value="{{old('employee_salary')}}" id="employee_salary" placeholder="Employee Salary">
      <span class="text-danger" id="employee_salary-error"></span>
    </div>
    </div>

    <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Employee Address</label>
      <textarea class="form-control" id="employee_address" rows="3" name="employee_address" placeholder="Employee Address">{{old('employee_address')}}</textarea>
      <span class="text-danger" id="employee_address-error"></span>
    </div>
    </div>
	

  
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-8">
						<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Create Employee</button>
						<a href="{{route('admin.employee.index')}}" class="btn btn-danger">Cancel</a>
            <br><span class="text-success" id="success-message"></span>
					</div>
				
</form>

<script>
        $("#employee_form").on("submit", function(e) {
          if(!confirm("Do you really want to submit form?")) {
              return false;
            }
            e.preventDefault();
            $('#employee_name-error').text('');
            $('#employee_email-error').text('');
            $('#employee_salary-error').text('');
            $('#employee_address-error').text('');
            $('#success-message').text('');
            $.ajax({
                type: "POST",
                url:  "{{route('admin.employee.store')}}",
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
                  $('#employee_name-error').text(response.responseJSON.errors.employee_name);
                  $('#employee_email-error').text(response.responseJSON.errors.employee_email);
                  $('#employee_salary-error').text(response.responseJSON.errors.employee_salary);
                  $('#employee_address-error').text(response.responseJSON.errors.employee_address);

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