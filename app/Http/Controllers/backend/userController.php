<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//muốn sử dụng đối tượng nào trong controller thì phải khai báo đối tượng đó bằng từ khoá use
//khai báo đối tượng DB để thao tác csdl
use DB;
//khai báo đối tượng mã hoá password
use Hash;
class userController extends Controller
{
    public function list_user(){
    	$data["arr"] = DB::table('users')->orderBy('id','desc')->paginate(4);
    	return view('backend.list_user',$data);
    }
    public function edit($id){
    	$data["arr"] = DB::table('users')->where('id','=',$id)->first();
    	return view('backend.add_edit_user',$data);
    }
    public function do_edit(Request $request,$id){
    	$name = $request->name;
    	$password = $request->password;
    	DB::table("users")->where("id","=",$id)->update(array("name"=>$name));
    	if($password != ""){
    		$password = Hash::make($password);
    		DB::table("users")->where("id","=",$id)->update(array("password"=>$password));
    	}
    	return redirect(url('admin/user'));
    }
    public function add(){
    	return view('backend.add_edit_user');
    }
    public function do_add(Request $request){
    	$name = $request->name;
    	$email = $request->email;
    	$password = $request->password;
    	$password = Hash::make($password);
    	DB::table('users')->insert(array("name"=>$name,"email"=>$email,"password"=>$password));
    	return redirect(url('admin/user'));
    }
    public function delete($id){
    	DB::table('users')->where('id','=',$id)->delete();
    	return redirect(url('admin/user'));
    }
}
