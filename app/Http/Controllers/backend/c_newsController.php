<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//khai bao doi tuong DB de thao tac csdl
use DB;
class c_newsController extends Controller
{
    //list news
    public function list_news(){
    	//lay cac ban ghi cua tbl_news
    	$data["arr"] = DB::table("tbl_news")->orderBy("pk_news_id","desc")->paginate(7);
    	return view("backend.list_news",$data);
    }
    //edit news
    public function edit($id){
    	//lay ban ghi co id truyen vao
    	$data["arr"] = DB::table("tbl_news")->where("pk_news_id","=",$id)->first();
    	return view("backend.add_edit_news",$data);
    }
    //do edit news
    public function do_edit(Request $request,$id){
    	$c_name = $request->get('c_name');
    	$fk_category_news_id = $request->get('fk_category_news_id');
    	$c_description = $request->get('c_description');
    	$c_content = $request->get('c_content');
    	$c_hotnews = $request->get('c_hotnews')!=""?1:0;
    	$c_img = "";
    	DB::table("tbl_news")->where("pk_news_id","=",$id)->update(array("c_name"=>$c_name,"fk_category_news_id"=>$fk_category_news_id,"c_description"=>$c_description,"c_content"=>$c_content,"c_hotnews"=>$c_hotnews));   
    	if($request->hasFile('c_img')){
    		$old_img = DB::table("tbl_news")->where("pk_news_id","=",$id)->select("c_img","pk_news_id")->first();
    		if(file_exists('upload/news/'.$old_img->c_img))
    			unlink('upload/news/'.$old_img->c_img);
			$c_img = $request->file("c_img")->getClientOriginalName();
			$c_img = time().$c_img;
			$request->file("c_img")->move("upload/news",$c_img);
			DB::table("tbl_news")->where("pk_news_id","=",$id)->update(array("c_img"=>$c_img));
    	}
        $page = $request->get('page');
    	return redirect(url('admin/news?page='.$page));
    }
    public function add(){
    	return view('backend.add_edit_news');
    }
    public function do_add(Request $request){
    	$c_name = $request->get('c_name');
    	$fk_category_news_id = $request->get('fk_category_news_id');
    	$c_description = $request->get('c_description');
    	$c_content = $request->get('c_content');
    	$c_hotnews = $request->get('c_hotnews')!=""?1:0;
    	$c_img = "";
    	if($request->hasFile('c_img')){
			$c_img = $request->file("c_img")->getClientOriginalName();
			$c_img = time().$c_img;
			$request->file("c_img")->move("upload/news",$c_img);
    	}
    	DB::table("tbl_news")->insert(array("c_name"=>$c_name,"fk_category_news_id"=>$fk_category_news_id,"c_description"=>$c_description,"c_content"=>$c_content,"c_hotnews"=>$c_hotnews,"c_img"=>$c_img));
    	return redirect(url('admin/news'));
    }
    public function delete($id){
		$old_img = DB::table("tbl_news")->where("pk_news_id","=",$id)->select("c_img","pk_news_id")->first();
		if(file_exists('upload/news/'.$old_img->c_img))
			@unlink('upload/news/'.$old_img->c_img);
		
		DB::table("tbl_news")->where("pk_news_id","=",$id)->delete();
    	return redirect(url('admin/news'));
    }
}
