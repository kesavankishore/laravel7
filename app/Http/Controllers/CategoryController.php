<?php

namespace App\Http\Controllers;
use PDF;
use Storage;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        
        $categorys = Category::all();
        //dd($category);
       if ($request->is('api/*')) {
       return response()->json([
           'success' => true,
           'data' => $products
         ], 200);
     } else {

      return view('admin.category.index', compact('categorys'));
     }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'size'          => 'required',
        ]);

        if ($request->hasFile('pic')) {
            
            $fileName = $request->pic->store('Category');
        }

        // if ($request->hasFile('image')) {
        //     foreach ($request->image as $key => $value) {
        //         $upload->image_url = $value->store('employee/upload');
                
        //     }
        // }
       $category = new Category();
       $category->name = $request->name;
       $category->size = $request->size;
       $category->pic = $fileName;
       $category->save();
       return response()->json([ 'success'=> 'Form is successfully submitted!']);

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
    public function edit($id)
    {
        $category = Category::find($id);

       if(!$category){
           return response()->json([
            'success' => false,
           'data' => 'Category with id' . $id . 'not found',
        ], 400);
       }
       
       return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'           => 'required',
            'size'          => 'required',
        ]);
        
        $category = Category::find($id);

        if ($request->hasFile('pic')) {
            Storage::delete($category->pic);
            $fileName = $request->pic->store('Category');
            $category->pic = $fileName;
        }

        // if ($request->hasFile('image')) {
        //     foreach ($request->image as $key => $value) {
        //         $upload->image_url = $value->store('employee/upload');
                
        //     }
        // }
        $category->name = $request->name;
        $category->size = $request->size;
        $category->save();
       return response()->json([ 'success'=> 'Category is successfully Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);

     if (!$category){
        return response()->json([
                'success' => false,
                'message' => 'Category with id'. $id . 'not found'
        ], 400);
     }

     if($category->delete()){
      
        return back()->with('flash_success', 'Category deleted successfully');
        
     }else{
        return response()->json([
                'success' => false,
                'message' => 'Category could not be deleted'
         ], 500);
     }
    }
}
