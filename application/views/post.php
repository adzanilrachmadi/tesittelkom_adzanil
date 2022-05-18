<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Masonry Responsive Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/post/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/post/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/post/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/post/css/templatemo-style.css">
    <script src="<?php echo base_url(); ?>/assets/post/js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/post/js/vendor/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- 
        Masonry Template 
        http://www.templatemo.com/preview/templatemo_434_masonry
        -->
    <style>
        .like *,
        .comment * {
            cursor: pointer;
        }

        .like.i_like * {
            color: #e74c3c !important;
        }

        .like.i_dislike * {
            color: #919191 !important;
        }

        .modal * {
            color: black;
        }

        #post_content {
            display: grid;
            grid-template-columns: 2fr 5fr;
            gap: 20px;
            padding: 2rem;
        }

        #post_content #post_image img {
            width: 100%;
            object-fit: contain;
        }

        .post_comment {
            border-bottom: 1px solid #919191;
            margin-bottom: .5rem;
            padding-bottom: .5rem;
        }

        .post_comment.reply {
            padding-left: 2rem;
        }
    </style>
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>

    <div class="content-bg"></div>
    <div class="bg-overlay"></div>

    <!-- SITE TOP -->
    <div class="site-top">
        <div class="site-header clearfix">
            <div class="container">
                <a href="#" class="site-brand pull-left"><strong>Masonry</strong> Free Template</a>
                <div class="social-icons pull-right">
                    <ul>
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-behance"></a></li>
                        <li><a href="#" class="fa fa-dribbble"></a></li>
                        <li><a href="#" class="fa fa-google-plus"></a></li>
                    </ul>
                </div>
            </div>
        </div> <!-- .site-header -->
        <div class="site-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 text-center">
                        <h2>Get free templates from <span class="blue">template</span><span class="green">mo</span></h2>
                        <p>Masonry is free responsive template that can be used for any website. You may download, modify and use this layout for your personal or commercial websites. Please tell your friends about <span class="blue">template</span><span class="green">mo</span>.com website. Thank you.</p>
                    </div>
                </div>
                <div class="row">
                    <form action="#" method="post" class="subscribe-form">
                        <fieldset class="col-md-offset-4 col-md-3 col-sm-8">
                            <input type="email" id="subscribe-email" placeholder="Enter your email...">
                        </fieldset>
                        <fieldset class="col-md-5 col-sm-4">
                            <input type="submit" id="subscribe-submit" class="button white" value="Subscribe!">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div> <!-- .site-banner -->
    </div> <!-- .site-top -->

    <!-- MAIN POSTS -->
    <div class="hidden" id="template" style="display: none;">
        <div class="post-masonry col-md-4 col-sm-6 post_item">
            <div class="post-thumb">
                <img src="" alt="">
                <div class="title-over">
                    <h6 class="post_username"><a href="#"></a></h6>
                </div>
                <div class="post-hover text-center">
                    <div class="inside">
                        <div class="button-action" style="display: flex; justify-content: center; align-items: center;">
                            <div class="like">
                                <i class="fa fa-heart"></i>
                            </div>
                            <strong class="like-count" style="margin:0 1rem 10px 5px; ">0</strong>
                            <div class="comment" style="margin-left: 1rem">
                                <i class="fa fa-comment"></i>
                            </div>
                        </div>
                        <span class="date"></span>
                        <p class="post_username"><a href="#"></a></p>
                        <p class="post_caption"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="post_comment">
            <p><strong class="comment_username">Username</strong> <span class="comment_date" style="color: #919191;"></span></p>
            <p><span class="comment_content"></span> </p>
        </div>
    </div>
    <div class="main-posts">
        <div class="container">
            <div class="row">
                <div class="blog-masonry masonry-true" id="post_container" style="overflow: visible;">
                    <!-- post goes here -->
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="logoutLabel" aria-hidden="true" style="background: #0007; color:black">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="margin-top: -2px; position: absolute; top: 10px; right: 10px; z-index: 100">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <div class="modal-body post_item" id="post_content">
                    <div id="post_image">
                        <img src="http://localhost/tesittelkom/assets/img/uploads/20220518143843.jpeg" alt="">
                        <div style="display: grid; grid-template-columns: 1fr 2fr;">
                            <div class="like_count" style="display: flex;">
                                <div class="like" style="margin-right: 10px">
                                    <i class="fa fa-heart" onclick="toggle_like(this)"></i>
                                </div>
                                <strong class="like-count">0</strong>
                            </div>
                            <div class="post_date text-right">
                                12 Mei 2022
                            </div>
                        </div>
                    </div>
                    <div id="post_comment">
                    </div>
                </div>
                <div class="modal-footer">
                    <form id="form_comment">
                        <input type="hidden" name="id_post" id="comment_id_post">
                        <label for="comment">Add comment</label>
                        <textarea type="text" name="comment" id="comment" placeholder="Add comment" style="width: 100%; margin-bottom: .3rem"></textarea>
                        <input type="submit" value="Send">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var page = 1;
        var comment_page = 1;
        $(document).ready(() => {
            $.ajax({
                url: "<?php echo base_url("rest_api/get_post") ?>?page=" + page,
                method: "GET",
                cache: false,
                contentType: false,
                processData: false,
                type: "json",
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        var post = result.data.post;
                        for (var i = 0; i < post.length; i++) {
                            var template = $("#template .post-masonry").clone(true);
                            $(template).attr("data-id_post", post[i].id);
                            $(template).attr("id", "post_item_" + post[i].id);
                            $(template).find("img").attr("src", "<?php echo base_url("/assets/img/uploads/") ?>" + post[i].foto);
                            $(template).find(".date").text(post[i].tanggal);
                            $(template).find(".post_username").text(post[i].username);
                            $(template).find(".post_caption").text(post[i].caption);
                            if (post[i].i_like) {
                                $(template).find(".like").addClass("i_like");
                            } else {
                                $(template).find(".like").addClass("i_dislike");
                            }
                            $(template).find(".like i").click(function() {
                                toggle_like(this);
                            });
                            $(template).find(".comment i").click(function() {
                                openCommentModal(this);
                            });
                            $(template).find(".like-count").text(post[i].likes.length);
                            $(template).appendTo($("#post_container"));
                        }
                    }
                    $("#post_container").css("overflow", "visible");
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        function openCommentModal(ele) {
            $("#commentModal").modal("show");
            var id_post = $(ele).parents(".post-masonry").data("id_post");
            $("#comment_id_post").val(id_post);
            $.ajax({
                url: "<?php echo base_url("rest_api/get_post") ?>?id_post= " + id_post,
                method: "GET",
                cache: false,
                contentType: false,
                processData: false,
                type: "json",
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        var post = result.data.post;
                        var pContent = $("#post_content");
                        $(pContent).attr("data-id_post", post.id);
                        $(pContent).find("#post_image img").attr("src", "<?php echo base_url("/assets/img/uploads/") ?>" + post.foto);
                        var new_class = "like i_dislike";
                        if (post.i_like) {
                            new_class = "like i_like";
                        }
                        $(pContent).find(".like").attr("class", new_class);

                        $(pContent).find(".like-count").text(post.likes.length);
                        $(pContent).find(".post_date").text(post.tanggal);

                        // first comment is post caption

                        var mainComment = $("#template .post_comment").clone(true);
                        $(mainComment).find(".comment_username").text(post.username);
                        $(mainComment).find(".comment_content").text(post.caption);
                        $(mainComment).find(".comment_date").text(post.tanggal);
                        $("#post_comment").append(mainComment);

                        // show all comment
                        for (var i = 0; i < post.comments.length; i++) {
                            var pComment = $("#template .post_comment").clone(true);
                            $(pComment).addClass("reply");
                            $(pComment).find(".comment_username").text(post.comments[i].username);
                            $(pComment).find(".comment_content").text(post.comments[i].comment);
                            $(pComment).find(".comment_date").text(post.comments[i].tanggal);
                            $("#post_comment").append(pComment);
                        }

                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        $("#form_comment").submit(function(e) {
            console.log("comment");
            e.preventDefault();
            e.stopImmediatePropagation();
            var data = new FormData(this);
            $.ajax({
                url: "<?php echo base_url("rest_api/add_comment") ?>",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: "json",
                success: function(result) {
                    if (result.success) {
                        var pComment = $("#template .post_comment").clone(true);
                        $(pComment).addClass("reply");
                        $(pComment).find(".comment_username").text(result.data.comment.username);
                        $(pComment).find(".comment_content").text(result.data.comment.comment);
                        $(pComment).find(".comment_date").text(result.data.comment.tanggal);
                        $("#post_comment").append(pComment);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        })

        function toggle_like(ele) {
            var data = new FormData();
            var id_post = $(ele).parents(".post_item").data("id_post");
            data.append("id_post", id_post)
            $.ajax({
                url: "<?php echo base_url("rest_api/add_like") ?>",
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: "json",
                success: function(result) {
                    if (result.success) {
                        var new_class = "like i_dislike";
                        if (result.data.like) {
                            new_class = "like i_like";
                        }
                        $(ele).parents(".like").attr("class", new_class);
                        $(ele).parents(".like").next().text(result.data.like_count);
                        $("#post_item_" + id_post).find(".like").next().text(result.data.like_count);
                    } else if (result.redirect != undefined) {
                        location.replace(result.redirect);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-behance"></a></li>
                            <li><a href="#" class="fa fa-dribbble"></a></li>
                            <li><a href="#" class="fa fa-google-plus"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="copyright-text">Copyright &copy; 2084 Company Name
                        | Photos by <a rel="nofollow" href="http://unsplash.com">Unsplash</a></p>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?php echo base_url(); ?>/assets/post/js/min/plugins.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/post/js/min/main.min.js"></script>

    <!-- Preloader -->
    <script type="text/javascript">
        //<![CDATA[
        $(window).load(function() { // makes sure the whole site is loaded
            $('#loader').fadeOut(); // will first fade out the loading animation
            $('#loader-wrapper').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('body').delay(350).css({
                'overflow-y': 'visible'
            });
        })
        $(window).resize(() => {
            console.log("resize");
            $("#post_container").css("overflow", "visible");
        })
        //]]>
    </script>
    <!-- templatemo 434 masonry -->
</body>

</html>