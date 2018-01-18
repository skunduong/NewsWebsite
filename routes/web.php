<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
//--------------
//neu la trang home thi di chuyen den trang user
Route::get('home',function(){
	//lệnh redirect sẽ di chuyển đến một url chỉ định
	return redirect(url('admin/user'));
});
//--------------
//backend
//tag admin sẽ là tag chung cho các chức năng thuộc phần admin, khi muốn vào các route này thì bắt buộc phải xác thực đăng nhập
Route::group(array("prefix"=>"admin",'middleware'=>'auth'),function(){
	Route::get('',function(){
		//lệnh redirect sẽ di chuyển đến một url chỉ định
		return redirect(url('admin/user'));
	});
	//--------------
	//logout
	Route::get('logout',function(){
		//logout
		Auth::logout();
		//di chuyen den trang user
		return redirect(url('login'));
	});	
	//--------------
	//list user
	Route::get('user','backend\userController@list_user');
	//edit user
	Route::get('user/edit/{id}','backend\userController@edit');
	//do edit user
	Route::post('user/edit/{id}','backend\userController@do_edit');
	//add user
	Route::get('user/add','backend\userController@add');
	//do add user
	Route::post('user/add','backend\userController@do_add');
	//delete user
	Route::get('user/delete/{id}','backend\userController@delete');
	//--------------
	//list category
	Route::get('category','backend\categoryController@list_category');	
	//do add/edit
	Route::post('category','backend\categoryController@add_edit_category');
	//delete category
	Route::get('category/delete/{id}','backend\categoryController@delete');
	//--------------
	//--------------
	//list news
	Route::get('news','backend\c_newsController@list_news');
	//edit news
	Route::get('news/edit/{id}','backend\c_newsController@edit');
	//do edit news
	Route::post('news/edit/{id}','backend\c_newsController@do_edit');
	//add news
	Route::get('news/add','backend\c_newsController@add');
	//do add news
	Route::post('news/add','backend\c_newsController@do_add');
	//delete news
	Route::get('news/delete/{id}','backend\c_newsController@delete');
	//--------------
});
//--------------
// Route::get('pwd',function(){
// 	echo Hash::make('123');
// });
//--------------
//frontend
Route::get('/', function () {
    return view('frontend.home');
});
//danh muc tin tuc
Route::get("news/category/{id}/{name}",function($id,$name){
	$data["id"] = $id;
	return view("frontend.category",$data);
});
Route::get("news/detail/{id}/{name}",function($id,$name){
	$data["id"] = $id;
	return view("frontend.detail",$data);
});