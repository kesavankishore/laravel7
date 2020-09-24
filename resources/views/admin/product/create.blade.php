@extends('admin.layout.base')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">

    	<div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title">Product</h4><a href="{{ route('admin.product.index') }}" class="btn btn-success">List product</a>
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

            <!-- <form class="form-horizontal" action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
				<div class="form-group row">
					<label for="name" class="col-xs-12 col-form-label">Product Name :   </label>
					<div class="col-xs-8">
						<input class="form-control" type="text" value="{{ old('name') }}" name="name" required id="name" placeholder="Name">
					</div>
				</div>

				<div class="form-group row">
					<label for="price" class="col-xs-12 col-form-label">Price :   </label><br>
					<div class="col-xs-8">
						<input class="form-control" type="price" required name="price" value="{{old('price')}}" id="price" placeholder="price">
					</div>
				</div>

				<div class="form-group row">
					<label for="pic" class="col-xs-12 col-form-label">Picture :   </label><br>
					<div class="col-xs-8">
						<input class="form-control" type="file" name="pic" id="pic">
					</div>
				</div>

				<div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-8">
						<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Create Product</button>
						<a href="{{route('admin.product.index')}}" class="btn btn-danger">Cancel</a>
					</div>
				</div>
				
			</form> -->

			<form class="form-horizontal" action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data" role="form">
				{{csrf_field()}}
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">Product Name</label>
      <input class="form-control" type="text" value="{{ old('name') }}" name="name"  id="name" placeholder="Name">
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
	</div>
	<div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Price</label>
      <input class="form-control" type="number" name="price" value="{{old('price')}}" id="price" placeholder="price">
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
						<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Create Product</button>
						<a href="{{route('admin.product.index')}}" class="btn btn-danger">Cancel</a>
					</div>
				
</form>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
//alert("hi");
</script>
		</div>
    </div>
</div>




@endsection