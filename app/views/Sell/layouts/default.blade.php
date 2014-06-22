<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8"/>
    <title>
        @section('title')
        小恶魔 - 下午茶时间
        @show
    </title>
    <meta name="keywords" content="your, awesome, keywords, here"/>
    <meta name="author" content="Jon Doe"/>
    <meta name="description"
          content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei."/>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}">
    @yield('head-assets')
    <style>
        body {
            padding: 50px 0;
        }

        @section ('styles')
        @show
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Favicons
    ================================================== -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
    <link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
    <link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
</head>

<body>
<!-- To make sticky footer need to wrap in a div -->
<div id="wrap">
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
                    {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}">首页</a></li>
                </ul>

                <ul class="nav navbar-nav pull-right">
                    @if (Auth::check())
                    @if (Auth::user()->hasRole('admin'))
                    <li><a href="{{{ URL::to('admin') }}}">管理员面板</a></li>
                    @endif
                    <li><a href="{{{ URL::to('user') }}}">欢迎您 {{{ Auth::user()->username }}}</a></li>
                    <li><a href="{{{ URL::to('user/logout') }}}">退出</a></li>
                    @else
                    <li
                    {{ (Request::is('user/login') ? ' class="active"' : '') }}><a
                        href="{{{ URL::to('user/login') }}}">登录</a></li>
                    <li
                    {{ (Request::is('user/register') ? ' class="active"' : '') }}><a
                        href="{{{ URL::to('user/create') }}}">注册</a></li>
                    @endif
                </ul>
                <!-- ./ nav-collapse -->
            </div>
        </div>
    </div>
    <!-- ./ navbar -->

    <!-- Container -->

        <!-- Notifications -->
        @include('notifications')
        <!-- ./ notifications -->

        <!-- Content -->
        @yield('content')
        <!-- ./ content -->

    <!-- ./ container -->

    <!-- the following div is needed to make a sticky footer -->
    <div id="push"></div>
</div>
<!-- ./wrap -->


<div id="footer">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-5">
                <h6>Shift
                    <small> A little gang</small>
                </h6>
                <p>我们是一群来自东北的苦孩子 <br>
                    +86 139-3661-5515 - admin@doudousong.com</p>
            </div>
        </div>
        <div class="sotto-footer text-right">
            <p class="copyright"><a
                    href="http://blog.doudousong.com/">Copyright © 2014 北京兜兜送科技有限公司</a> - © 2014 Shift Design</p>
        </div>
    </div>
</div>

<!-- Javascripts
================================================== -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

@yield('scripts')
</body>
</html>
