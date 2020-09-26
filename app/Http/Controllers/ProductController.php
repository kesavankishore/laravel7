<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Product;
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
       ], 400);
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
       // ], 400);
       return view('admin.product.edit', compact('product'));
   }

   public function create(){

      return view('admin.product.create');
   }

   public function store(Request $request){
    
       $this->validate($request, [
           'name' => 'required',
           'price' => 'required|integer',
           'pic' => 'required|mimes:jpeg,jpg,png'
       ]);
      
  if($request->hasFile('pic')){
    $fileName = $request->pic->getClientOriginalName();
    $fileName = $request->pic->store('product');
  }
       $product = new Product();
       $product->user_id = auth()->user()->id;
       $product->name = $request->name;
       $product->price = $request->price;
       $product->pic = $fileName;
      
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
           'name' => 'required',
           'price' => 'required|integer',
           'pic' => 'mimes:jpeg,jpg,png'
       ]);

     $product = Product::find($id);
     
     if(!$product){
        return response()->json([
                'success' => false,
                'data' => 'Product with id'. $id . 'not found',
        ], 500);
     }

    if($request->hasFile('pic')){
    Storage::delete($product->pic);
    $fileName = $request->pic->getClientOriginalName();
    $fileName = $request->pic->store('product');
    $product->pic = $fileName;
    }
     
     $product->name = $request->name;
     $product->price = $request->price;
     

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

  public function pdf(){

    $products = Product::all();
    $pdf = PDF::loadView('admin.product.pdf', compact('products'));
    //return $pdf->download('invoice.pdf');
    return $pdf->stream('invoice.pdf');
  }


  public function email(){

    $to_name = 'KesavanKishore';
    $to_email = 'kesavan.ktrust@gmail.com';
    $title = 'Test Mail';
    $body = 'Test Body';
    $data = [
      'title' => $title,
      'body' => $body
    ];
    
    Mail::send('email.mail', $data, function($message) use ($to_name, $to_email) {
    $message->to($to_email, $to_name)
            ->subject('Artisans Web Testing Mail');
    $message->from('maiwandkesavan@gmail.com','Test');
    });

    //\Mail::to($to_email)->send(new \App\Mail\Exaplemail($data));
    echo "Email Send check ur in box...";
  }
}