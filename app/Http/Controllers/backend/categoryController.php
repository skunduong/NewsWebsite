<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//khai bao doi tuong DB de thao tac csdl
use DB;

class categoryController extends Controller
{
    public function list_category(){
    	$data["arr"] = DB::table("tbl_category_news")->orderBy("pk_category_news_id","desc")->paginate(4);
    	return view("backend.list_category_news",$data);
    }
    public function add_edit_category(Request $request){
    	$act = $request->get("act");
    	switch($act){
    		case "edit":
    			$id = $request->get("id");
    			$c_name = $request->get("c_name");
    			DB::table("tbl_category_news")->where("pk_category_news_id","=",$id)->update(array("c_name"=>$c_name));
    			return redirect(url('admin/category'));
    		break;
    		case "add":
    			$c_name = $request->get("c_name");
    			DB::table("tbl_category_news")->insert(array("c_name"=>$c_name));
    			return redirect(url('admin/category'));
    		break;
    	}    	
    }
	public function delete($id){
		DB::table('tbl_category_news')->where("pk_category_news_id","=",$id)->delete();
		DB::delete("delete from tbl_category_news where pk_category_news_id=$id");
		return redirect(url('admin/category'));
	}
}
