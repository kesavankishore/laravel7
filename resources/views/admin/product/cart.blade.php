@if($cart !='' && count($cart) > 0)
<div id="cart_box" >
	<h3>Your order <i class="icon_cart_alt pull-right"></i></h3>
	<table class="table table_summary">
	<thead>
        <tr>
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>
	<tbody>
	@foreach($cart as $key=>$item)	
	<tr>
		<td>
			<a href="#0" data-item="{{ $item['item']->id }}" class="remove_item"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></a>  {{ $item['item']->name }}
		</td>
		<td>
			</a> <strong>{{ $item['qty'] }}</strong>
		</td>
		<td>
			</a> <strong>${{ $item['item']->price }}</strong>
		</td>
		<td>
			<strong class="pull-right">${{ $item['price'] * $item['qty'] }}</strong>
		</td>
	</tr>
	@endforeach
		
	</tbody>
	</table>
	<hr>
	<table class="table table_summary">
	<tbody>
	<tr>
		<td>
			 Subtotal <span class="pull-right">${{ $sub_total }}</span><strong><span style="float: right;">TOTAL <span class="pull-right">${{ $total }}</span></span></strong>
		</td>
	</tr>
	
	<tr>
		<td class="total">
			 
		</td>
	</tr>
	</tbody>
	</table>
	
</div>
@else
<div id="cart_box" >
	<h3>Your order <i class="icon_cart_alt pull-right"></i></h3>
	<table class="table table_summary">
	<tbody>
	<tr>
		<td colspan="2">
			 Cart is Empty!
		</td>
	</tr>
	</tbody>
	</table>
</div>	
@endif
<script>
	$(".remove_item").click(function (e) {
    event.preventDefault();
    event.stopPropagation();
    var item_id = $(this).attr("data-item");
    var dataString = "item_id="+item_id;
    
    $.ajax
    ({
      cache: false,
      type: "GET",
      url: "{{ route('admin.cart.update')}}",
      data: dataString,
      success: function(data)
      {
        cart_show();
      }
    });
});
</script>