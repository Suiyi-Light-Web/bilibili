<?php

/**
 Template Name: B站追剧页面
 Template author: 蘑菇君
 */

get_header(); ?>
<div class="page-information-card-container"></div>

<?php get_sidebar(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<article class="post post-full card bg-white shadow-sm border-0" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header text-center">
		<a class="post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<hr>
</header>
<?php the_content(); ?>
<link href="/json/css/col.min.css" rel="stylesheet">
<style>
    /* B站追番 */
    .row {
        margin: 0 10px;
    }

    .bangumi-item {
        margin: 20px 0;
        padding-top: 0;
        padding-bottom: 0;
        border: none
    }

    .bangumi-link {
        padding: 0;
        border: none
    }

    .bangumi-banner {
        position: relative;
        overflow: hidden
    }

    .bangumi-banner img {
        display: block;
        width: 100%;
        height: 100%;
        margin: 15px auto;
        border-radius: 3px;
        background-color: var(--themecolor);
    }

    .bangumi-des {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.8);
        padding: 6px;
        opacity: 0;
        transition: .3s;
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        overflow: auto
    }

    .bangumi-des p {
        margin: 0
    }

    .bangumi-banner:hover .bangumi-des {
        opacity: 1
    }

    .bangumi-content {
        border-bottom: solid 0.5px #bbb;
    }

    .bangumi-title {
        margin: 5px 0;
        border: none !important;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: 'Ubuntu', sans-serif
    }
    .score {
        margin-left: 5px; 
        color: #ffa726;
    }

    .bangumi-item a {
        text-decoration: none;
        color: #000
    }
    .bangumi-status {
        text-align: center;
    }

    .bangumi-follow_status,.bangumi-type,.bangumi-finish{
        margin: 5px;
        border: 1px solid var(--themecolor-light);
        display: inline-block;
        font-size:12px;
        vertical-align:middle;
        margin-right:5px;
        height:20px;
        padding:0 4px;
        line-height:20px;
        border-radius:3px;
    }
    @media (max-width:1000px) {

        /*平板适配*/
        .bangumi-banner img {
            height: 265px
        }
    }

    @media (max-width:500px) {

        /*手机适配*/
        .bangumi-banner img {
            height: auto
        }
    }

    /* AJAX请求等待图 */
    img.loading_dsasd {
        width: 200px;
        margin: 50px 0 50px 50%;
        transform: translateX(-50%);
    }

    /* 分页模块 */
    #next {
        margin: 15px 0;
        width: 100%;
        color: #ffaa00;
        font-size: 20px;
        text-align: center;
        transition: all .6s
    }

    #next:hover {
        color: #e67474
    }
</style>
<?php
echo "<div class=\"page-header\"><h2>我的追剧 <small>当前已追<span id=total>loading...</span>部，继续加油！</small></h2></div><div id=\"bilibiliMovie\" class=\"row\"></div><div id=\"next\">. NEXT .</div>"
?>


<script type="text/javascript">
    $(document).ready(function() {
        var pagenum = 0;
        var limit = 12; //单页展示数
        GetMovieData(limit, 0);
        $("div#next").click(function() {
            GetMovieData(limit, ++pagenum);
            console.log("第 " + pagenum + " 页");
        });
    });

    function GetMovieData(limit, page) {
        $.ajax({
            type: "get",
            url: "/json/GetMovieData.php",
            data: {
                "limit": limit, // 每页个数
                "page": page // 页号,第一页 page = 0
            },
            dataType: "json",
            beforeSend: function() {
                $("#bilibiliMovie").append("<img class=\"loading_dsasd\" src=\"/json/images/loading.svg\">");
            },
            complete: function() {
                $(".loading_dsasd").remove();
            },
            success: function(data) {
                $("#total").text(""+ data.total +"");
                var i;
                if (data.total_page == page && page == 0) {
                    $("div#next").hide();
                } else if (data.total_page == page) { // 判断是否最后一页
                    $("div#next").text("真的没有更多了哦~");
                }
                for (i = 0; i < data.data.length; i++) {
                    $("#bilibiliMovie").append("<div class=\"bangumi-item col-md-4 col-lg-3 col-sm-6\"><a class=\"no-line bangumi-link\" href=\"https://www.bilibili.com/bangumi/play/ss" + data.data[i].id + "/ \" target=\"_blank\"><div class=\"bangumi-banner\"><img referrerpolicy=\"no-referrer\" src=\"" + data.data[i].image_url + "\"><div class=\"bangumi-des\"><p>" + data.data[i].evaluate + "</p>B站评分<span class=\"score\">" + data.data[i].rating_score + "</span><br>评分人数" + data.data[i].rating_count + "</div></div><div class=\"bangumi-content\"><div class=\"bangumi-title\">" + data.data[i].title + "<span class=\"score\"><small>" + data.data[i].rating_score + "</small></span></div></div><div class=\"bangumi-status\" style=\"width:100%\"><span class=\"bangumi-type\">" + data.data[i].type + "</span><span class=\"bangumi-finish\">" + data.data[i].finish + "</span><span class=\"bangumi-follow_status\">" + data.data[i].follow_status + "</span></div></div></a></div>");
                    //console.log(data); // 查看AJAX获取的数据
                }
            },
            error: function(data) {
               alert(data.result);
            }
        });
    }
</script>

</article>
		<?php
			if (comments_open() || get_comments_number()) {
				comments_template();
			}
			?>

<?php
get_footer();
