<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
          
        $cart = Session::get('cart');
        $sub_total = Session::get('sub_total');
        $total = Session::get('sub_total');

        // $total = $sub_total + $package_charge + $delivery_charge;
       
        return view('admin.product.cart',compact('cart','sub_total','total'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart_add(Request $request)
    {
         $product = Product::find($request->id);
         $cart = Session::get('cart');
         if(!$cart){
         $cart = [
            $product->id => [
            "item" => $product,
            "name" => $product->name,
            "price" => $product->price,
            "qty" => $request->qty,
            "total" => $request->qty * $product->price,

                ]
            ];
        } else {

            $cart[$product->id] = [
            "item" => $product,
            "name" => $product->name,
            "price" => $product->price,
            "qty" => $request->qty,
            "total" => $request->qty * $product->price,
                ];

        }

        $sub_total =0;
        foreach($cart as $item){
            $sub_total += $item['total'];
        }
        Session::put('sub_total',$sub_total);
        //$cart = [];
        Session::put('cart',$cart); 
        echo "ok";
        

    }


    public function cart_remove(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function cart_update(Request $request)
    {
        $cart = Session::get('cart');
        if(isset($cart[$request->item_id])){
            $cart[$request->item_id]['qty'] = $cart[$request->item_id]['qty']-1;
            if($cart[$request->item_id]['qty'] <=0 ){
                unset($cart[$request->item_id]);
            }
            $sub_total =0;
            foreach($cart as $item){
                $sub_total += $item['price'] * $item['qty'];
            }
            Session::put('sub_total',$sub_total);
            Session::put('cart',$cart);
            if(!$cart){
               //Session::flush(); 
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
