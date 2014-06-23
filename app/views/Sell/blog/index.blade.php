@extends('sell.layouts.default')

{{-- head-assets --}}
@section('head-assets')
<link rel="stylesheet" href="{{asset('assets/js/scrolldeck/decks/parallax/style.css')}}"">
@stop
{{-- end of head-assets --}}

{{-- Content --}}
@section('content')
<div id="preloader">
    <div id="loadingbar" style="background-position: 0px 0px;">
        <img src="http://www.ok-studios.de/fileadmin/templates/okstudios/images/preload_logo.png" width="245"
             height="245">
    </div>
    <div id="loadingtext">Alle Inhalte geladen.<br>Herzlich Willkommen!</div>
</div>
<!--nav bar-->
<ul class="nav nav-pills nav-stacked text-center" id="nav">
    @foreach($classes as $class)
    <li><a data-href="#{{$class->name_en}}" title="Next Section">
            {{$class->name_en}} <small>({{$class->name}})</small>
        </a></li>
    @endforeach
</ul>
<!--end of nav bar-->

@foreach($classes as $class)
<div id="{{$class->name_en}}" class="meal-class-div">
    <div class="container">
        <div class="row">
            @foreach($class->meals()->get() as $meal)
            <div class="col-md-6">
                <div class="row meal-div">
                    <div class="col-md-6">
                        <a class="thumbnail">
                            <img src="/assets/img/meal-img/coffee.jpg" alt="图片加载失败" data-src="holder.js/300x200">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-warning">
                            <!-- Default panel contents -->
                            <div class="panel-heading text-center">
                                <h4 style="margin: 5px 0px;">{{$meal->name_en}}<br><small>{{$meal->name}}</small></h4>
                            </div>

                            <!-- List group -->
                            <ul class="list-group">
                                <li class="list-group-item">Price <small>(单价)</small> : ¥{{$meal->price}}</li>
                                <li class="list-group-item">Calorie <small>(热量)</small> : 90 Calorie</li>
                            </ul>
                            <div class="panel-footer text-center">
                                <a class="btn btn-primary" role="button">Add to Cart</a>
                                <a class="btn btn-warning" data-toggle="popover"
                                   data-content="{{$meal->description}}"
                                   data-original-title="{{$meal->name_en}} - information">
                                    Info
                                </a>
                            </div>
                        </div>
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
    $(function () {
        //meals description show button
        $('.meal-class-div a[data-original-title]').popover({html: true, container: 'body'});
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
        classes_background_array = [];
        /*
         @foreach($classes as $class)
         */
        if ("{{$class->background}}".length > 1) {
            var class_background_name = "/assets/img/class-background/{{$class->background}}";
        } else {
            var class_background_name = "/assets/img/class-background/default.jpg";
        }
        $('#{{$class->name_en}}').css('background-image', 'url(' + class_background_name + ')');
        $('#{{$class->name_en}}').parallax("50%", 1000, 0.0, true);
        classes_background_array.push(class_background_name)
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
<script src="/assets/js/preloader.js"></script>
@stop