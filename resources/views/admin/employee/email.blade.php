@extends('admin.layout.base')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">

    	<div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title">Send Email</h4>
                <!-- <a href="{{ route('admin.employee.index') }}" class="btn btn-success">List employee</a> -->
            </div>
        </div>

    	<div class="box box-block bg-white">
    		  
    
			<form class="form-horizontal" enctype="multipart/form-data" id="employee_form" role="form">
				{{csrf_field()}}
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">Employee Name</label>
      <select class="browser-default custom-select" name="emp_id"  id="emp_id" required>
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
      <label for="validationCustom02">Title</label>
      <input class="form-control" type="text" required name="title" value="{{old('title')}}" id="title" placeholder="Title">
      <span class="text-danger" id="title-error"></span>
    </div>
    </div>

    <div class="form-row">
    <div class="col-md-4 mb-3">Message</label>
      <textarea class="form-control" id="msg" rows="3" name="msg" placeholder="Message" required>{{old('msg')}}</textarea>
      <span class="text-danger" id="msg-error"></span>
    </div>
    </div>
    
  
        <label for="zipcode" class="col-xs-12 col-form-label"></label>
        <div class="col-xs-8">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Send Mail</button>
            <a href="{{route('admin.document')}}" class="btn btn-danger">Cancel</a>
        <br><br>
        <div class="spinner-border" role="status" style="display:none;">
        <span class="sr-only">Loading...</span>
        </div>
        <span class="text-success" id="success-message"></span>
        </div>
				
</form>

<script>
        $("#employee_form").on("submit", function(e) {
          if(!confirm("Do you want to send email?")) {
              return false;
            }
            e.preventDefault();
            $('#success-message').text('');
            $(".spinner-border").show();
            $.ajax({
                type: "POST",
                url:  "{{route('admin.send-mail')}}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                success: function(response) {console.log(response);
                  console.log(response);
                  if (response) {
                      //alert('success');
                      $(".spinner-border").hide();
                    $('#success-message').text(response.success);
                    $("#employee_form")[0].reset();
                  }
                },
                
            });
        });
    </script>

		</div>
    </div>
</div>




@endsection

