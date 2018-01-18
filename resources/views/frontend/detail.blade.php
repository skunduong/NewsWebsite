@extends('frontend.layout')
@section('controller')
<!-- ========================================= -->
<?php 
	$news = DB::table("tbl_news")->where("pk_news_id","=",$id)->first();//lay 1 bam ghi
 ?>
                    <article>
                    	<div class="title-box">
                            <h1>{{ $news->c_name }}</h1>
                        </div>
                        <div class="post-thumb">
                        	<img src="{{ asset('upload/news/'.$news->c_img) }}" alt="">
                        </div>
                        <div class="post-content" style="margin-top: 10px;">
                            {!! $news->c_description !!}
                            {!! $news->c_content !!}
                            <div class="marked-title first">
                                <h3>Tin tức khác</h3>
                            </div>
                            <div class="row-fluid">
<?php 
	$other = DB::select("select * from tbl_news where pk_news_id < $id order by pk_news_id desc limit 0,4");
 ?>   
 <?php 
 	//load function remove unicode
    //su dung class theo cau truc: ten_namespace\tenclass
    use App\myclass\unicode as php24;
  ?>                         
 @foreach($other as $rows)
<!-- other news -->
<div class="span4">
    <article class="small single">
        <div class="post-thumb">
            <a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.php24::remove_unicode($rows->c_name)) }}"><img src="{{ asset('upload/news/'.$rows->c_img) }}" style="max-width: 100px;" alt=""></a>
        </div>
        <div class="cat-post-desc">
            <h3><a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.php24::remove_unicode($rows->c_name)) }}">{{ $rows->c_name }}</a></h3>
        </div>
    </article>    
</div>
<!-- end other news -->
@endforeach
                                
                                
                            </div>
                            
                            
                        </div>
                    </article>
                 <!-- ========================================= -->
@endsection