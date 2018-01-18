@extends('frontend.layout')
@section('controller')
<?php 
    //load function remove unicode
    //su dung class theo cau truc: ten_namespace\tenclass
    use App\myclass\unicode as php24;
    //list danh muc tin tuc
    $category = DB::table('tbl_category_news')->orderBy('pk_category_news_id','desc')->get();
 ?>
 @foreach($category as $rows_category)
 <?php 
    //kiem tra, neu danh muc co tin tuc thi moi cho hien thi, con khong thi khong hien thi
    //ham Count tra ve so luong ban ghi da truy van
    $check = DB::table('tbl_news')->where('fk_category_news_id','=',$rows_category->pk_category_news_id)->Count();
  ?>
  @if($check > 0)
<!-- list category tin tuc -->
                    <div class="row-fluid">
                        <div class="marked-title">
                            <h3><a href="{{ url('news/category/'.$rows_category->pk_category_news_id.'/'.php24::remove_unicode($rows_category->c_name)) }}" style="color:white">{{ $rows_category->c_name }}</a></h3>
                        </div>
                    </div>                    
                    <div class="row-fluid">
                        <div class="span2">
                        <?php 
                            //lay tin dau tien
                            $first_news = DB::select("select * from tbl_news where fk_category_news_id=".$rows_category->pk_category_news_id." order by pk_news_id desc limit 0,1");
                            $id_first_news = 0;
                         ?>
                         @foreach($first_news as $rows_first_news)
                         <?php 
                            $id_first_news = $rows_first_news->pk_news_id;
                          ?>
                           <!-- first news -->
<article>
    <div class="post-thumb">
        <a href="{{ url('news/detail/'.$rows_first_news->pk_news_id.'/'.php24::remove_unicode($rows_first_news->c_name)) }}"><img src="{{ asset('upload/news/'.$rows_first_news->c_img) }}" alt=""></a>
    </div>
    <div class="cat-post-desc">
        <h3><a href="{{ url('news/detail/'.$rows_first_news->pk_news_id.'/'.php24::remove_unicode($rows_first_news->c_name)) }}">{{ $rows_first_news->c_name }}</a></h3>
        <p>{!! $rows_first_news->c_description !!}</p>
    </div>
</article>
                            <!-- end first news -->
                            @endforeach
                        </div>
                        <div class="span2">
                        <?php 
                            $news  = DB::select("select * from tbl_news where pk_news_id < $id_first_news order by pk_news_id desc limit 0,3");
                         ?>
                         @foreach($news as $rows)
                           <!-- list news -->
                            <article class="twoboxes">
<div class="right-desc">
    <h3><a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.php24::remove_unicode($rows->c_name)) }}"><img src="{{ asset('upload/news/'.$rows->c_img) }}" alt=""></a><a href="{{ url('news/detail/'.$rows->pk_news_id.'/'.php24::remove_unicode($rows->c_name)) }}">{{ $rows->c_name }}</a></h3>  
    <div class="clear"></div>    
</div>
                                <div class="clear"></div>
                            </article>
                            <!-- end list news -->
                        @endforeach
                        </div>
                    </div>
                    <div class="clear"></div>
                    <!-- end list category tin tuc -->
    @endif
  @endforeach                  
                    
                    
                    

@endsection