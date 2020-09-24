@extends('admin.layout.base')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">

    	<div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title">Category</h4><a href="{{ route('admin.category.index') }}" class="btn btn-success">List category</a>
            </div>
        </div>

    	<div class="box box-block bg-white">
    		  
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

            

			<form class="form-horizontal" enctype="multipart/form-data" id="category_form" role="form">
				{{csrf_field()}}
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">Category Name</label>
      <input class="form-control" type="text" value="{{ old('name') }}" name="name"  id="name" placeholder="Name">
      <span class="text-danger" id="name-error"></span>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
	</div>
	<div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Size</label>
      <input class="form-control" type="text" name="size" value="{{old('size')}}" id="size" placeholder="size">
      <span class="text-danger" id="size-error"></span>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    </div>
	<div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustomUsername">Picture</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend">@</span>
        </div>
        <input class="form-control" type="file" name="pic" id="pic">
        <div class="invalid-feedback">
          Please choose a username.
        </div>
      </div>
    </div>
  </div>

  
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-8">
						<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Create Category</button>
						<a href="{{route('admin.category.index')}}" class="btn btn-danger">Cancel</a>
            <br><span class="text-success" id="success-message"></span>
					</div>
				
</form>

<script>
        $("#category_form").on("submit", function(e) {
          
            e.preventDefault();
            $('#name-error').text('');
            $('#size-error').text('');
            $('#success-message').text('');
            $.ajax({
                type: "POST",
                url:  "{{route('admin.category.store')}}",
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
                    $("#category_form")[0].reset();
                  }
                },
                error: function(response) {
                  //alert(response);
                  $('#name-error').text(response.responseJSON.errors.name);
                  $('#size-error').text(response.responseJSON.errors.size);
                }
            });
        });
    </script>
<!-- <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#category_form').on('submit', function(e){
            e.stopPropagation();
            e.preventDefault();
        $('#name-error').text('');
        $('#size-error').text('');

        name = $('#name').val();
        email = $('#size').val();
        alert('hi');
        $.ajax({
          url: "{{route('admin.category.store')}}",
          type: "POST",
          async: true,
          cache: true,
          data:{
            //   _token:{{ csrf_field() }},
              name:name,
              size:size,
          },
          success:function(response){
            console.log(response);
            if (response) {
                alert('success');
              $('#success-message').text(response.success);
              $("#contact-form")[0].reset();
            }
          },
          error: function(response) {
              $('#name-error').text(response.responseJSON.errors.name);
              $('#size-error').text(response.responseJSON.errors.size);
          }
         });
        });
      </script> -->
		</div>
    </div>
</div>




@endsection

@section('script')
    
@endsection