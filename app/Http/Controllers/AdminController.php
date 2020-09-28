<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Admin;
use App\User;
class AdminController extends Controller
{

	public function __construct()
    {
        $this->middleware('admin');
    }


    public function index() {

    	$admins = User::all();
      //dd($admin);
    	return view('admin.home',compact('admins'));

   }

   
   public function create() {
      echo 'create';
   }
   public function store(Request $request) {
      echo 'store';
   }
   public function show($id) {
      echo 'show';
   }
   public function edit($id) {
      echo 'edit';
   }
   public function update(Request $request, $id) {
      echo 'update';
   }
   public function destroy($id) {
      echo 'destroy';
   }
}
