<!DOCTYPE html>
<html>


<!-- Giao dien duoc chia se mien phi tai www.ptheme.net [Free HTML Download]. SKYPE[ptheme.net] - EMAIL[ptheme.net@gmail.com].-->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport"  content="initial-scale=1, width=device-width">

<title>Home</title>

<link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ 'frontend/css/bootstrap.css' }}" rel="stylesheet" type="text/css" />

<!--[if  IE]>
<link rel="stylesheet" type="text/css" href="css/ie.css" />
<![endif]-->

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<![endif]-->

</head>
<?php 
    //load function remove unicode
    //su dung class theo cau truc: ten_namespace\tenclass
    use App\myclass\unicode as php24;
    //$utf8 = new unicode();
    //echo $utf8->remove_unicode('Hoàng Sa, Trường Sa là của Việt Nam');
    //echo php24::remove_unicode('Hoàng Sa, Trường Sa là của Việt Nam');
 ?>
<body class="home">
    
    <!-- start div #wrapper -->
    <div id="wrapper">
        
        <!-- start header -->
        <header>
            <div class="border-left"></div>
            <div class="logo">
                <a href="index-2.html"><img src="{{ asset('frontend/img/logo.png') }}" alt=""></a>
                <span class="border-bottom"></span>
            </div>
            <!--
            <div class="search">
                <form action="#" method="post">
                    <input class="field" type="text" name="" value="Search rumors..." onFocus="if (this.value==this.defaultValue) this.value = ''" 
                    onblur="if (this.value=='') this.value = this.defaultValue" >
                    <input class="submit" type="submit" name="" value="" >
                </form>
            </div>
            -->
            <nav class="menu">
                <ul>
                    <li><span class="border-bottom"></span><a href="{{ url('') }}">Trang chủ</a></li>
                    <li><span class="border-bottom"></span><a href="#">Giới thiệu</a></li>
                    <li><span class="border-bottom"></span><a href="#">Liên hệ</a></li>
                </ul>                                              
            </nav>   
            <select class="mobile-menu" onchange="document.location.href=this.options[this.selectedIndex].value;"> 
                <option value="">Go To...</option> 
                <option value="{{ url('') }}">Trang chủ</option>
                <option value="#">Giới thiệu</option>
                <option value="#">Liên hệ</option>
            </select>
            <div class="clear"></div>
        </header>
        <!-- end header -->

        <!-- start slider -->
        <div class="cn_wrapper">
            <div id="cn_preview" class="cn_preview">
            <?php 
                //$first_hot_news = DB::table("tbl_news")->where("c_hotnews","=","1")->orderBy("pk_news_id","desc")->limit(4)->get();
                $first_hot_news = DB::select("select * from tbl_news where c_hotnews=1 order by pk_news_id desc limit 0,4 ");
                $n = 0;
             ?>
             @foreach($first_hot_news as $arr_first_hot_news)
             <?php $n++; ?>
               <!-- first hot news -->
                <div class="cn_content" style="{{ $n==1?'top:0px;':''  }} background: url('{{ asset('upload/news/'.$arr_first_hot_news->c_img)  }}') no-repeat center #ffffff; background-size:715px 355px;">
                    <div class="caption">
                        <h3><a href="{{ url('news/detail/'.$arr_first_hot_news->pk_news_id.'/'.php24::remove_unicode($arr_first_hot_news->c_name)) }}">{{ $arr_first_hot_news->c_name }}</a></h3>
                        <p>{!! $arr_first_hot_news->c_description !!}</p>
                        <div class="date">
                            <h3>Hot<br><span>News</span></h3>
                        </div>
                    </div>
                </div>
                <!-- end first hot news -->
                @endforeach
                
                
            </div>
            <div id="cn_list" class="cn_list">
                <div class="cn_page" style="display:block;">
            @foreach($first_hot_news as $rows)
                    <!-- list hot news -->
                    <div class="cn_item">
                        <div class="left-box">
                            <img src="{{ asset('upload/news/'.$rows->c_img) }}" alt="">
                        </div>
                        <div class="right-box">
                            <h4>{{ $rows->c_name }}</h4>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <!-- end list hot news -->
            @endforeach  
                </div>
                
                
            </div>
        </div>
        <!-- end slider -->
        
		<!-- start div #main -->
	    <div id="main">
            <div class="main-content">
                <div class="left-container">
                <!-- ========================================= -->
                    @yield('controller')
                 <!-- ========================================= -->   
                </div>
                <div class="right-container">
                    <div class="sidebar">
                       <div class="widget">
                            <div class="marked-title">
                                <h3>Danh mục tin tức</h3>
                            </div>
                            <ul class="tags">
                            <?php 
                                $category = DB::select("select * from tbl_category_news order by pk_category_news_id desc");
                             ?>
                             @foreach($category as $rows)
                                <li><a class="photo" href="{{ url('news/category/'.$rows->pk_category_news_id.'/'.php24::remove_unicode($rows->c_name)) }}">{{ $rows->c_name }}</a></li>
                            @endforeach
                            </ul>
                            <div class="clear"></div>
                        </div>
                        <div class="widget">
                            <div class="marked-title">
                                <h3>Kết nối</h3>
                            </div>
                            <ul class="social">
                                <li>
                                    <a href="#">
                                        <span class="icon fb"></span>
                                        25875<br><span>facebook fans</span>   
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon tw"></span>
                                        25875<br><span>twitter fans</span>   
                                    </a>
                                </li>
                                <li class="third">
                                    <a href="#">
                                        <span class="icon rss"></span>
                                        25875<br><span>subscribers</span>   
                                    </a>
                                </li>
                            </ul>
                            <div class="clear"></div>
                        </div>
                        <div class="widget">
                            <div class="marked-title">
                                <h3>Quảng cáo</h3>
                            </div>
                            <iframe width="350" height="300" src="https://www.youtube.com/embed/y0Y1ZmAKIfU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            <img class="ads" src="{{ asset('frontend/img/ads.jpg') }}" alt="">
                            <div class="clear"></div>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="clear"></div>
            </div>	
        </div>
	    <!-- end div #main -->
    
    </div>
	<!-- end div #wrapper -->    
    
    <!-- start footer -->
    <footer>
        
        <div class="footer-bottom">
            <div class="copyright">
                <p>Copyright 2017 @ <span>Laravel</span>. // A mega awesome NEWS MAGAZINE theme.</p>
            </div>
            <div class="clear"></div>
        </div>  
    </footer>
    <!-- end footer -->

<script type="text/javascript" src="{{ asset('frontend/js/jquery-1.8.3.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('frontend/js/html5shiv.js') }}" ></script>
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('frontend/js/fancydropdown.js') }}" ></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.easing-1.3.js') }}" ></script>
<script type="text/javascript" src="{{ asset('frontend/js/functions.js') }}" ></script>
<script type="text/javascript">
    /* <![CDATA[ */
    /*global $:false */
    $(function() {
        "use strict";
        //caching
        //next and prev buttons
        var $cn_next = $('#cn_next');
        var $cn_prev    = $('#cn_prev');
        //wrapper of the left items
        var $cn_list    = $('#cn_list');
        var $pages      = $cn_list.find('.cn_page');
        //how many pages
        var cnt_pages   = $pages.length;
        //the default page is the first one
        var page        = 1;
        //list of news (left items)
        var $items      = $cn_list.find('.cn_item');
        //the current item being viewed (right side)
        var $cn_preview = $('#cn_preview');
        //index of the item being viewed. 
        //the default is the first one
        var current     = 1;
        /*
        for each item we store its index relative to all the document.
        we bind a click event that slides up or down the current item
        and slides up or down the clicked one. 
        Moving up or down will depend if the clicked item is after or
        before the current one
        */
        $items.each(function(i){
            var $item = $(this);
            $item.data('idx',i+1);
            
            $item.bind('click',function(){
                var $this       = $(this);
                $cn_list.find('.selected').removeClass('selected');
                $this.addClass('selected');
                var idx         = $(this).data('idx');
                var $current    = $cn_preview.find('.cn_content:nth-child('+current+')');
                var $next       = $cn_preview.find('.cn_content:nth-child('+idx+')');
                
                if(idx > current){
                    $current.stop().animate({'top':'-357px'},600,'easeOutBack',function(){
                        $(this).css({'top':'357px'});
                    });
                    $next.css({'top':'357px'}).stop().animate({'top':'0px'},600,'easeOutBack');
                }
                else if(idx < current){
                    $current.stop().animate({'top':'357px'},600,'easeOutBack',function(){
                        $(this).css({'top':'357px'});
                    });
                    $next.css({'top':'-357px'}).stop().animate({'top':'0px'},600,'easeOutBack');
                }
                current = idx;
            });
        });
        /*
        shows next page if exists:
        the next page fades in
        also checks if the button should get disabled
        */
        $cn_next.bind('click',function(e){
            var $this = $(this);
            $cn_prev.removeClass('disabled');
            ++page;
            if(page === cnt_pages)
                { $this.addClass('disabled'); }
            if(page > cnt_pages){ 
                page = cnt_pages;
                return;
            }   
            $pages.hide();
            $cn_list.find('.cn_page:nth-child('+page+')').fadeIn();
            e.preventDefault();
        });
        /*
        shows previous page if exists:
        the previous page fades in
        also checks if the button should get disabled
        */
        $cn_prev.bind('click',function(e){
            var $this = $(this);
            $cn_next.removeClass('disabled');
            --page;
            if(page === 1)
                { $this.addClass('disabled'); }
            if(page < 1){ 
                page = 1;
                return;
            }
            $pages.hide();
            $cn_list.find('.cn_page:nth-child('+page+')').fadeIn();
            e.preventDefault();
        });
    });
    /* ]]> */
</script> 

</body>


<!-- Giao dien duoc chia se mien phi tai www.ptheme.net [Free HTML Download]. SKYPE[ptheme.net] - EMAIL[ptheme.net@gmail.com].-->
</html>