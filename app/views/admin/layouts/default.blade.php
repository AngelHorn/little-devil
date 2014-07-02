<!DOCTYPE html>

<html lang="en">

<head id="Starter-Site">

    <meta charset="UTF-8">

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>
        @section('title')
        Administration
        @show
    </title>

    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="author" content="@yield('author')"/>
    <!-- Google will often use this as its description of your page/site. Make it good. -->
    <meta name="description" content="@yield('description')"/>

    <!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
    <meta name="google-site-verification" content="">

    <!-- Dublin Core Metadata : http://dublincore.org/ -->
    <meta name="DC.title" content="Project Name">
    <meta name="DC.subject" content="@yield('description')">
    <meta name="DC.creator" content="@yield('author')">

    <!--  Mobile Viewport Fix -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- This is the traditional favicon.
     - size: 16x16 or 32x32
     - transparency is OK
     - see wikipedia for info on browser support: http://mky.be/favicon/ -->
    <link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">

    <!-- iOS favicons. -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
    <link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/wysihtml5/prettify.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/wysihtml5/bootstrap-wysihtml5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/datatables-bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/colorbox.css')}}">

    <style>
        body {
            padding: 60px 0;
        }
    </style>

    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<!-- Container -->
<div class="container">
    <!-- Navbar -->
    <div class="navbar navbar-default navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li
                    {{ (Request::is('admin') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin') }}}"><span
                            class="glyphicon glyphicon-home"></span> 首页</a></li>
                    <li
                    {{ (Request::is('admin/order*') ? ' class="active"' : '') }}><a
                        href="{{{ URL::to('admin/order') }}}"><span
                            class="glyphicon glyphicon-edit"></span> 订单管理
                        <span class="label label-danger" id="order-number">0</span></a></li>
                    <li
                    {{ (Request::is('admin/meals*') ? ' class="active"' : '') }}><a
                        href="{{{ URL::to('admin/meals') }}}"><span
                            class="glyphicon glyphicon-edit"></span> 餐点管理</a></li>
                    <li
                    {{ (Request::is('admin/class*') ? ' class="active"' : '') }}><a
                        href="{{{ URL::to('admin/classes') }}}"><span
                            class="glyphicon glyphicon-folder-open"></span> 分类管理</a></li>
                </ul>
                </li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li><a href="{{{ URL::to('/') }}}">回到主页</a></li>
                    <li class="divider-vertical"></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="glyphicon glyphicon-user"></span> {{{ Auth::user()->username }}} <span
                                class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{{ URL::to('user/settings') }}}"><span
                                        class="glyphicon glyphicon-wrench"></span> 设置</a></li>
                            <li class="divider"></li>
                            <li><a href="{{{ URL::to('user/logout') }}}"><span
                                        class="glyphicon glyphicon-share"></span> 退出管理系统</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ./ navbar -->

    <!-- Notifications -->
    @include('notifications')
    <!-- ./ notifications -->

    <!-- Content -->
    @yield('content')
    <!-- ./ content -->

    <!-- Footer -->
    <footer class="clearfix">
        @yield('footer')
        <audio id="notify-audio">
            <source src="/assets/audio/notify.ogg" type="audio/ogg">
            <source src="/assets/audio/notify.mp3" type="audio/mpeg">
            <source src="/assets/audio/notify.wav" type="audio/wav">
        </audio>
    </footer>
    <!-- ./ Footer -->

</div>
<!-- ./ container -->

<!-- Javascripts -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/wysihtml5/wysihtml5-0.3.0.js')}}"></script>
<script src="{{asset('assets/js/wysihtml5/bootstrap-wysihtml5.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatables-bootstrap.js')}}"></script>
<script src="{{asset('assets/js/datatables.fnReloadAjax.js')}}"></script>
<script src="{{asset('assets/js/jquery.colorbox.js')}}"></script>
<script src="{{asset('assets/js/prettify.js')}}"></script>

<script type="text/javascript">
    $('.wysihtml5').wysihtml5();
    $(prettyPrint);
</script>
@yield('scripts')
<script>
    $(function () {
        globalAlreadyPlay = null;
        postNewOrder();
        setInterval("postNewOrder()", 60000);
    });
    function postNewOrder() {
        $.post('/admin/order/new-order', {}, function (data) {
            if (data > 0 && globalAlreadyPlay == null) {
                $('#order-number').text(data);
                globalAlreadyPlay = true;
                setInterval("changeTitle()", 500);
                $('#notify-audio')[0].play(); //播放声音
            }
        });
    }//end of superadmin

    function changeTitle() {
        var title = $('title').text();
        if (title.indexOf('【') < 0) {
            $('title').text('【　　　　　】' + title);
        }

        var text = $('title').text().replace('【有新的订单】', '【　　　　　】');
        var text_2 = $('title').text().replace('【　　　　　】', '【有新的订单】');
        if ($('title:contains("【有新的订单】")').length > 0) {
            $('title:contains("【有新的订单】")').text(text);
        } else {
            $('title:contains("【　　　　　】")').text(text_2);
        }
    }
</script>
</body>

</html>
