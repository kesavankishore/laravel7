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

        <div class="row" style="margin-left: 0px;">
        
          <div class="col-md-2 mt-4">
          <label class="title-color">Code : </label>
        </div>
        <div class="col-md-2 mt-4">
          <label class="title-color">Name : </label>
        </div>
        <div class="col-md-1 mt-4">
          <label class="title-color">Price : </label>
        </div>
        <div class="col-md-1 mt-4">
          <label class="title-color">Stock : </label>
        </div>
        <div class="col-md-1 mt-4">
          <label class="title-color">Qnty : </label>
        </div>
        <div class="col-md-1 mt-4">
          <label class="title-color">Total : </label>
        </div>
        
      </div>
        <div class="row" id="dynamic_field">
        
          <div class="col-md-2 mt-4">
           <input type="text" onchange="fetch(this);" class="form-control" name="code[]" id="code_0">
        </div>
        <div class="col-md-2 mt-4">
          <input type="text" class="form-control" name="name[]" id="name_0" readonly>
        </div>
        <div class="col-md-1 mt-4">
          <input type="text" class="form-control" name="price[]" id="price_0" readonly>
        </div>
        <div class="col-md-1 mt-4">
          <input type="text" class="form-control" name="stock[]" id="stock_0" readonly>
          <input type="hidden" class="form-control" name="" id="stock_num_0" >
        </div>
        <div class="col-md-1 mt-4">
          <input type="number" onchange="qnty(this);" min="1" class="form-control" name="qnty[]" id="qnty_0" value="1">
        </div>
        <div class="col-md-2 mt-4">
          <input type="text" class="form-control" name="total[]" id="total_0" readonly>
        </div>
        <div class="col-md-2 mt-4">
          <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
        </div>
      </div>


  
	<label for="zipcode" class="col-xs-12 col-form-label"></label>
	<div class="col-xs-8">
		<input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" /> 
		<a href="{{route('admin.product.index')}}" class="btn btn-danger">Cancel</a>

    <p id="show" style="color: green;display: none;">Order Placed successfuly..!</p>
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

<script type="text/javascript">
    $(document).ready(function(){      
      var postURL = "{{route('admin.orderStore')}}";
      var i=0;  


      $('#add').click(function(){ 
       
           i++;  
           $('#dynamic_field').append('<div class="row" id="row'+i+'" style="margin-left: 0px;"><div class="col-md-2 mt-4"> <input type="text" onchange="fetch(this);" class="form-control" name="code[]" id="code_'+i+'"> </div> <div class="col-md-2 mt-4">     <input type="text" class="form-control" name="name[]" id="name_'+i+'" readonly> </div>  <div class="col-md-1 mt-4">  <input type="text" class="form-control" name="price[]" id="price_'+i+'" readonly> </div>     <div class="col-md-1 mt-4"> <input type="text" class="form-control" name="stock[]" id="stock_'+i+'" readonly><input type="hidden" class="form-control" name="" id="stock_num_'+i+'"> </div><div class="col-md-1 mt-4"> <input type="number" class="form-control" onchange="qnty(this);" min="1"  name="qnty[]" id="qnty_'+i+'" value="1">  </div> <div class="col-md-2 mt-4">    <input type="text" class="form-control" name="total[]" id="total_'+i+'" readonly> </div><div class="col-md-2 mt-4"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>     </div></div>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $('#submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#add_name').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.success == 'true'){
                        $("#show").show();
                        $("#add_name")[0].reset() 
                    }else{
                        alert('Sothing Went wrong..!');
                    }
                }  
           });  
      });

       


      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }

      // $('#code').change(function(){ 
      //   alert($(this).attr('id'));
      // });
    });  
     
    function fetch(vals){
      var id = $(vals).attr('id');
      var res = id.split("_");
      var code = $("#"+id).val();
      
      $.ajax({  
                url:"{{route('admin.code')}}",  
                method:"get",  
                //data:$('#add_name').serialize(),
                 data: {
                      code: code,
                    },
                type:'json',
                success:function(data)  
                { 
                    
                    if(data.success == 'true'){
                      
                       $("#name_"+res[1]).val(data.name);
                       $("#price_"+res[1]).val(data.price);
                       $("#stock_"+res[1]).val(data.stock-1);
                       $("#stock_num_"+res[1]).val(data.stock);
                        var price = $("#price_"+res[1]).val();
                        var qnty = $("#qnty_"+res[1]).val();
                        var total = parseInt(price) * parseInt(qnty);
                        $("#total_"+res[1]).val(total);
                    }else{
                        alert("Error..");
                    }
                }  
           });
    }

    function qnty(vals){
      var id = $(vals).attr('id');
      var res = id.split("_");
      if($("#price_"+res[1]).val() != ""){
        var price = $("#price_"+res[1]).val();
        var qnty = $("#qnty_"+res[1]).val();
        var stock = $("#stock_num_"+res[1]).val();
        var total = parseInt(price) * parseInt(qnty);
        var stock_total = parseInt(stock) - parseInt(qnty);
        $("#total_"+res[1]).val(total);
        $("#stock_"+res[1]).val(stock_total);
      }
      
    }
</script>
		</div>
    </div>
</div>




@endsection