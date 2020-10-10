@extends('admin.layout.base')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">

        
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
			<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<p><b>Product</b></p>
			<div class="card-deck">	
			<div class="row">
			@foreach($products as $index => $product)
			
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="card">
			<center><img class="" src="{{ url('storage/'.$product->pic)}}" width="150" alt="Product"></center>
			<div class="card-body">
			<h5 class="card-title">{{ $product->name }} - ${{$product->price}}</h5>
			
			<input type="number" min="1" name="qty" id="qty_{{$product->id}}" style="width: 50px;" value="1">
			<button class="btn btn-success" id="cart" data-id="{{ $product->id }}">Add cart</button>
			</div>
			</div>
			</div>
			@endforeach
			</div>
			</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<p><b>Cart</b></p>
			<div id="cart_list"></div>

			</div>
			</div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    cart_show();
    });
$(document).on('click','#cart', function(){
      //alert($(this).attr("data-id"))
      	
        var id = $(this).attr("data-id");
        var qty = $("#qty_"+id).val();
        var dataString = "id="+id+"&qty="+qty;
        
        $.ajax
		    ({
		      cache: false,
		      type: "GET",
		      url: "{{ url('admin/cart-add')}}",
		      data: dataString,
		      success: function(data)
		      {
		        if(data == "ok"){
		        	cart_show();
		        } else {
		        	alert('Something went wrong..!');
		        }
		      }
		    });
    });

function cart_show(){

	$.ajax
		    ({
		      cache: false,
		      type: "GET",
		      url: "{{ url('admin/cart-details')}}",
		      success: function(data)
		      {
		        $("#cart_list").html(data);
		      }
		    });
}
</script>
@endsection


