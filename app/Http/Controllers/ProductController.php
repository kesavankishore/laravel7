<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Product;
use App\Order;
use Storage;
use Mail;

class ProductController extends Controller
{
   public function index(Request $request){
    //dd(auth()->user());

       $products = Product::all();

       if ($request->is('api/*')) {
       return response()->json([
           'success' => true,
           'data' => $products
         ], 200);
     } else {

      return view('admin.product.index', compact('products'));
     }
   }

   public function show(Request $request, $id){


       $products = Product::all();

       if(!$products){
           return response()->json([
            'success' => false,
           'data' => 'Product with id' . $id . 'not found',
        ], 400);
       }
       if ($request->is('api/*')) {
       return response()->json([
           'success' => true,
           'data' => $products->toArray(),
       ], 200);
       }else{
        return view('admin.product.view', compact('products'));
     }
   }

   public function edit($id){
       $product = Product::find($id);

       if(!$product){
           return response()->json([
            'success' => false,
           'data' => 'Product with id' . $id . 'not found',
        ], 400);
       }

       // return response()->json([
       //     'success' => true,
       //     'data' => $product->toArray(),
       // ], 200);
       return view('admin.product.edit', compact('product'));
   }

   public function create(){

      return view('admin.product.create');
   }

   public function store(Request $request){
    
       $this->validate($request, [
           'code' => 'required|integer',
           'name' => 'required',
           'price' => 'required|integer',
           'stock' => 'required|integer',
       ]);
      
  
       $product = new Product();
       $product->code = $request->code;
       $product->name = $request->name;
       $product->price = $request->price;
       $product->stock = $request->stock;
      
       if($product->save()){

        if ($request->is('api/*')) {
           return response()->json([
            'success' => true,
            'data' => $product->toArray(),
       ], 200);
         }else {
          return redirect()->route('admin.product.index')->with('flash_success', 'Product created successfully');
          
         }
       }else{
            return response()->json([
                'success' => false,
                'data' => 'Product could not be found',
            ], 500);
       }
   }

   public function update(Request $request, $id){
    
    $this->validate($request, [
           'code' => 'required|integer',
           'name' => 'required',
           'price' => 'required|integer',
           'stock' => 'required|integer',
       ]);

     $product = Product::find($id);
     
     if(!$product){
        return response()->json([
                'success' => false,
                'data' => 'Product with id'. $id . 'not found',
        ], 500);
     }

    
     $product->code = $request->code;
     $product->name = $request->name;
     $product->price = $request->price;
     $product->stock = $request->stock;
     

     if($product->save()){
      if ($request->is('api/*')) {
        return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
        ]);
     }else{
        return redirect()->route('admin.product.index')->with('flash_success', 'Product updated successfully');
     } 
   } 
   }

   public function destroy(Request $request, $id){
     $product = Product::find($id);

     if (!$product){
        return response()->json([
                'success' => false,
                'message' => 'Product with id'. $id . 'not found'
        ], 400);
     }

     if($product->delete()){
      if ($request->is('api/*')) {
        return response()->json([
                'success' => true,
                'message' => "Product deleted successfully"
        ]);
        } else {

        return back()->with('flash_success', 'Product deleted successfully');
      }
     }else{
        return response()->json([
                'success' => false,
                'message' => 'Product could not be deleted'
         ], 500);
     }
   
  }



  

  public function order(){

      return view('admin.product.order');
   }

  public function code(Request $request){

      $product = Product::where('code', $request->code)->first();
      
      if($product != null)  {
        
         return response()->json([
                'success' => 'true',
                'name' => $product->name,
                'price' => $product->price,
                'stock' => $product->stock,
        ]);
      } else {
        return response()->json([
                'success' => 'false',
        ]);
      }
      
   }

   public function orderStore(Request $request){
    
        $orderId = rand(10000,100000);
        
                for ($i=0; $i < count($request->get('name')); ++$i) 
          {             
                        if($request->name[$i] != null){
                          $order = new Order();
                          $order->orderId = $orderId;
                          $order->code = $request->code[$i];
                          $order->name =  $request->name[$i];
                          $order->price =  $request->price[$i];
                          $order->stock =  $request->stock[$i];
                          $order->qnty =  $request->qnty[$i];
                          $order->total =  $request->total[$i];
                          if (isset($request->attachment[$i])){

                          $order->attachment =  $request->attachment[$i]->store('order/upload');
                          }
                          $order->save();  
                        }
          }
          //dd($order);
  
        return response()->json([
                'success' => 'true',
        ]);
   }

   public function words(){

      return view('admin.product.words');
   }

   public function calculate(Request $request){
    $greater = [];
    $less = [];
      $words = str_replace(',', ' ', $request->word);
      $word = explode(' ',$words);
     foreach ($word as $key => $value) {
       if(strlen($value) >= 5) {
        array_push($greater, $value);
       }
       if(strlen($value) <= 3) {
        array_push($less, $value);
       }
     }

      // return response()->json([
      //           'word' => $request->word,
      //           'greater' => $greater,
      //           'less' => $less,
      //   ]);

     echo '<b> The word is -> </b> '. $request->word.'<br><br>';

     echo '<b> >= 5 Count -></b> '. count($greater).'<br><br>';

     echo '<b> >= 5 words are -></b> '. implode(",",$greater).'<br><br>';

     echo '<b> <= 3 Count -></b> '. count($less).'<br><br>';

     echo '<b> <= 3 words are -></b> '. implode(",",$less).'<br><br>';



   }
}