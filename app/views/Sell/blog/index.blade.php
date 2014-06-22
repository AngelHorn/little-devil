@extends('sell.layouts.default')

{{-- head-assets --}}
@section('head-assets')
<link rel="stylesheet" href="{{asset('assets/js/scrolldeck/decks/parallax/style.css')}}"">
@stop
{{-- end of head-assets --}}

{{-- Content --}}
@section('content')
<!--nav bar-->
<ul class="nav nav-pills nav-stacked text-center" id="nav">
    @foreach($classes as $class)
    <li><a data-href="#{{$class->name_en}}" title="Next Section">{{$class->name}}</a></li>
    @endforeach
</ul>
<!--end of nav bar-->

@foreach($classes as $class)
<div id="{{$class->name_en}}" class="meal-class-div">
    <div class="container">
        <div class="row">
            @foreach($class->meals()->get() as $meal)
            <div class="col-md-6">
                <div class="thumbnail">
                    <img src="/assets/img/meal-img/coffee.jpg" data-src="holder.js/300x200" alt="...">
                    <div class="caption text-center">
                        <h3>{{$meal->name}}</h3>
                        <p>
                            <a class="btn btn-lg btn-primary" role="button">加入购物车</a>
                            <a class="btn btn-lg btn-danger" data-toggle="popover"
                               data-content="配料:<br>低筋面粉、鸡蛋、牛奶、乳酪<br>"
                               data-original-title="{{$meal->name}} - 原料信息">
                                信息
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach

@stop
{{-- end of content --}}

@section('scripts')
<!--<script src="/assets/js/scrolldeck/js/jquery-1.8.2.min.js"></script>-->
<script src="/assets/js/scrolldeck/js/jquery.scrollTo-1.4.3.1.min.js"></script>
<script type="text/javascript" src="/assets/js/scrolldeck/decks/parallax/scripts/jquery.parallax-1.1.js"></script>
<!--<script src="/assets/js/scrolldeck/js/jquery.easing.1.3.js"></script>-->
<!--<script src="/assets/js/scrolldeck/js/jquery.scrollorama.js"></script>-->
<!--<script src="/assets/js/scrolldeck/js/jquery.scrolldeck.js"></script>-->
<script type="text/javascript">
    $(function(){
        //meals description show button
        $('.thumbnail .caption a[data-original-title]').popover({html:true});
    });
    $(document).ready(function () {
        //$('#nav').localScroll(800);

        RepositionNav();

        $(window).resize(function () {
            RepositionNav();
        });

        //.parallax(xPosition, adjuster, inertia, outerHeight) options:
        //xPosition - Horizontal position of the element
        //adjuster - y position to start from
        //inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
        //outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport

        /*
         @foreach($classes as $class)
         */
        $('#{{$class->name_en}}').css('background-image', 'url(/assets/js/scrolldeck/decks/parallax/images/{{$class->background}})');
        $('#{{$class->name_en}}').parallax("50%", 1000, 0.0, true);
        /*
         @endforeach
         */

//        $('#second').parallax("50%", 0, 0.1, true);
//        $('.bg').parallax("50%", 2500, 0.1, true);
//        $('#third').parallax("50%", 2750, 0.1, true);

        //nav scroll an
        $("#nav a").click(function () {
            $.scrollTo($(this).attr('data-href'), 800);
        });
//        var deck = new $.scrolldeck({
//            slides: '.slide',
//            buttons: '#nav li a',
//            easing: 'easeInOutExpo'
//        });
        //nav active && background color change
        $(window).scroll(function () {
            var topDist = $(this).scrollTop();
            //console.log(topDist);


            /*
             @foreach($classes as $index => $class)
             */
            var should_height_class_min = should_height_class_max || 0;
            var should_height_class_max = should_height_class_min + $('.meal-class-div:eq({{$index}})').height();
            if ((topDist >= should_height_class_min) && (topDist < should_height_class_max)) {
                $("#nav li").removeClass("active");
                $("#nav li:eq(" + parseInt('{{$index}}') + ")").addClass("active");
            }
            /*
             @endforeach
             */
        });
    });
</script>
@stop