@extends('frontend.layout')
@section('controller')
<!-- ========================================= -->	
                    <div class="marked-title">
                        <h3>
<?php 
	$category = DB::table('tbl_category_news')->where("pk_category_news_id","=",$id)->first();//lay 1 ban ghi
	echo $category->c_name;
 ?>
                        </h3>
                    </div>
                    <div class="row">
<?php 
	$news = DB::table("tbl_news")->where("fk_category_news_id","=",$id)->paginate(3);
	//load function remove unicode
    //su dung class theo cau truc: ten_namespace\tenclass
    use App\myclass\unicode as php24;
 ?>
 @foreach($news as $rows)
                        <!-- list news -->
<article>
	<div class="cat-post-desc">
		<h3><a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.php24::remove_unicode($rows->c_name)) }}">{{ $rows->c_name }}</a></h3>
		<p><a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.php24::remove_unicode($rows->c_name)) }}"><img class="img_category" style="max-width: 150px;" src="{{ asset('upload/news/'.$rows->c_img) }}" alt=""></a>{!! $rows->c_description !!}</p>
	</div>
	<div class="clear"></div>
	<div class="line_category"></div>
</article>                       
                        <!-- end list news -->
 @endforeach                            
                                                
                    </div>
                    <div class="clear"></div>
                    <div class="post-navi">
                        {{ $news->links() }}
                    </div>
                <!-- ========================================= -->
@endsection