@extends('admin.layout.base')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">

    	<div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title">Order</h4>
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

           

			<form name="add_name" id="add_name"> 
				{{csrf_field()}}

        
        <div class="row" id="dynamic_field">
        
          <div class="col-md-12 mt-4">
            <label class="title-color">Enter words here : </label>

           <input type="text" class="form-control" name="word" id="word">
        </div>
        
        
        
      </div>


  
	<label for="zipcode" class="col-xs-12 col-form-label"></label>
	<div class="col-xs-8">
		<input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
		
	</div>
				
</form><br>
  <p id="print"></p>
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

<script type="text/javascript">
    $(document).ready(function(){      
      
      $('#submit').click(function(){ 
           var word = $("#word").val();           
           $.ajax({  
                url:"{{route('admin.calculate')}}",  
                method:"get",  
                data: {
                      word: word,
                    },
                type:'json',
                success:function(data)  
                {
                    $("#print").html(data);
                }  
           });  
      });


      
    });  
     
    
  
</script>
		</div>
    </div>
</div>




@endsection