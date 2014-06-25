@extends('sell.layouts.default')

{{-- head-assets --}}
@section('head-assets')
<link rel="stylesheet" href="{{asset('assets/js/jquery-spinner/dist/bootstrap-spinner.css')}}">
<link rel="stylesheet" href="{{asset('assets/js/scrolldeck/decks/parallax/style.css')}}">
@stop
{{-- end of head-assets --}}

{{-- Content --}}
@section('content')

<!--cart-->
<div id="cart-div" class="container">
    <div class="col-md-6">
        <a id="toggle-cart" class="btn btn-info btn-block"><span
                class="glyphicon glyphicon-shopping-cart"></span> 购物车</a>

        <div id="cartColumn">
            <!--        <div class="row" style="">-->
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th style="width: 100px;">
                        Qty.<br>
                        <small>(数量)</small>
                    </th>
                    <th style="text-align: center;">
                        Product<br>
                        <small>(餐点)</small>
                    </th>
                    <th>
                        Cost<br>
                        <small>(价格)</small>
                    </th>
                    <th style="width: 75px">
                        Actions<br>
                        <small>(操作)</small>
                        <i class="icon-resize-full icon-black pull-right" style="cursor: pointer">
                        </i>
                    </th>
                </tr>
                </thead>
                <!-- Iterate over view_mode.products (Observable Array) -->
                <tbody>
                <tr class="cart-tr-model" style="display: none;">
                    <td>
                        <div class="input-append spinner input-group" data-trigger="spinner">
                        <span class="input-group-btn">
                             <button class="spin-down btn btn-xs btn-warning" data-spin="down">-</button>
                        </span>
                            <input type="text" data-meal-id="" class="input-sm form-control" value="1"
                                   data-rule="quantity">
                        <span class="input-group-btn">
                             <button class="spin-up btn btn-xs btn-warning" data-spin="up">+</button>
                        </span>
                        </div>
                    </td>
                    <td>
                    </td>
                    <td style="text-align: right"></td>
                    <td style="text-align: center">
                        <a class="btn delete-from-cart"><span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>
                        <strong>Subtotal
                            <small>(小计)</small>
                        </strong></td>
                    <td style="text-align: right">
                        ¥<span id="cart-subtotal">0</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Total
                            <small>(总计)</small>
                        </strong></td>
                    <td style="text-align: right">
                        <strong>¥<span id="cart-total">0</span></strong>
                    </td>
                </tr>
                </tbody>
            </table>
			<span>
				<input data-bind="visible:isVisible('productsView')" type="button" class="btn btn-large btn-primary"
                       value="Checkout" onclick="toggleCheckOut()">
			</span>
			<span class="pull-right">
				<a type="button" class="btn btn-small btn-info empty-cart">
                    <span class="glyphicon glyphicon-trash"></span> Empty Cart
                    <small>(清空)</small>
                </a>
			</span>
            <!--        </div>-->
        </div>
    </div>

</div>
<!-- end of cart -->


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
            {{$class->name_en}}
            <small>({{$class->name}})</small>
        </a></li>
    @endforeach
</ul>
<!--end of nav bar-->

@foreach($classes as $class)
<div id="{{$class->name_en}}" class="meal-class-div">
    <div class="container">
        @foreach($class->meals()->get() as $meal)
        <div class="row">
            <div class="col-md-6">
                <div class="row meal-div" data-meal-id="{{$meal->id}}">
                    <div class="col-md-6">
                        <a class="thumbnail">
                            <img src="/assets/img/meal-img/coffee.jpg" alt="图片加载失败" data-src="holder.js/300x200">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-warning">
                            <!-- Default panel contents -->
                            <div class="panel-heading text-center">
                                <h4 style="margin: 5px 0px;">{{$meal->name_en}}<br>
                                    <small>{{$meal->name}}</small>
                                </h4>
                            </div>

                            <!-- List group -->
                            <ul class="list-group">
                                <li class="list-group-item">Price
                                    <small>(单价)</small>
                                    : ¥{{$meal->price}}
                                </li>
                                <li class="list-group-item">Calorie
                                    <small>(热量)</small>
                                    : 90 Calorie
                                </li>
                            </ul>
                            <div class="panel-footer text-center">
                                <a class="btn btn-primary add-to-cart" data-meal-id="{{$meal->id}}"
                                   role="button">Add to Cart</a>
                                <!--                                <a class="btn btn-warning" data-toggle="popover"-->
                                <!--                                   data-content="{{$meal->description}}"-->
                                <!--                                   data-original-title="{{$meal->name_en}} - information">-->
                                <!--                                    Info-->
                                <!--                                </a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach

<!-- information div  -->
<div id="information-div" class="container" style="position: fixed;top: 0px;left:50%;margin-top: 100px;">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body">我们的介绍</div>
        </div>
    </div>
</div>
<!-- end of information div -->

@stop
{{-- end of content --}}

@section('scripts')
<!--<script src="/assets/js/scrolldeck/js/jquery-1.8.2.min.js"></script>-->
<script src="/assets/js/scrolldeck/js/jquery.scrollTo-1.4.3.1.min.js"></script>
<script type="text/javascript" src="/assets/js/scrolldeck/decks/parallax/scripts/jquery.parallax-1.1.js"></script>
<script src="/assets/js/jquery-spinner/dist/jquery.spinner.min.js"></script>
<!--<script src="/assets/js/scrolldeck/js/jquery.easing.1.3.js"></script>-->
<!--<script src="/assets/js/scrolldeck/js/jquery.scrollorama.js"></script>-->
<!--<script src="/assets/js/scrolldeck/js/jquery.scrolldeck.js"></script>-->
<script type="text/javascript">
    $(function () {
        //test
        //css by jquery
        $('#cartColumn table:first-child').css('max-height', (window.innerHeight * 0.6 + 10));

        //meals description show button
        $('.meal-class-div a[data-original-title]').popover({html: true, container: 'body'});
        $('.meal-div').hover(function () {
            var data_meal_id = $(this).attr('data-meal-id');
            show_information_div_delay = setTimeout(function () {
                showInformationDiv(data_meal_id);
            }, 600);
        }, function () {
            clearTimeout(show_information_div_delay);
        });
        var showInformationDiv = function (data_meal_id) {
//            alert(data_meal_id);
            var $information_div = $("#information-div").filter(':not(:animated)');
            if ($information_div.length > 0 && $('#cartColumn:hidden').length > 0) {
                if ($information_div.attr('data-show-meal-id') == data_meal_id) {
                    return false;
                }
                $information_div.attr('data-show-meal-id', data_meal_id);
                $.get('/sell/description', {"id": data_meal_id}, function (data) {
                    $information_div.fadeOut(400, function () {
                        $(this).find('.panel-body').html(data);
                        $(this).fadeIn(400);
                    });
//                    $("#information-div").filter(':not(:animated)');
                });
            }
        };

        //cart show && hide
        $('#toggle-cart').click(function () {
            if ($('#cartColumn:hidden').length > 0) {
                $('#cartColumn:hidden').slideDown();
                $("#information-div").slideUp();
            } else if ($('#cartColumn:visible').length > 0) {
                $('#cartColumn:visible').slideUp();
                $("#information-div").slideDown();
            }
        });

        //add meal to cart
        $('.add-to-cart').click(function () {
            if ($('#cartColumn:hidden').length > 0) {
                $('#cartColumn:hidden').slideDown();
                $("#information-div").slideUp();
            }
            addToCart($(this).attr('data-meal-id'), 1, 'add');
            var togglt_cart_blink = setInterval(function () {
                $('#toggle-cart').fadeToggle(100);
            }, 100);
            setTimeout(function(){
                $('#toggle-cart').fadeIn(100);
                clearInterval(togglt_cart_blink);
            },500);
        });
        //empty cart
        $('.empty-cart').click(function () {
            deleteFromCart('all');
        });

        //prototype of add to cart function
        var addToCart = function (data_meal_id, number, option) {
            var json = {
                "id": data_meal_id,
                "number": number,
                "option": option//add || total
            };
            updateCart(json, '/cart/add-to-cart');
        };//end of function addToCart

        //prototype of delete from cart function
        var deleteFromCart = function (data_meal_id) {
            var json = {
                "id": data_meal_id
            };
            updateCart(json, '/cart/delete-from-cart');
        };//end of function deleteFromCart

        var updateCart = function (json, url) {
            $.post(url, json, function (data) {
                var cart_table_scroll_pos = $('#cartColumn table:first-child').scrollTop();
                $('.cart-tr-model:hidden').siblings().remove();
                $.each(data.meals, function (index, meal) {
                    var $cart_Tr_Model = $('.cart-tr-model:hidden').clone().removeClass('cart-tr-model');
                    $cart_Tr_Model.find('td:eq(1)').html(meal.name_en + '<br><small>' + meal.name + '</small>');
                    $cart_Tr_Model.find('td:eq(2)').text(meal.price);
                    $cart_Tr_Model.find('input').val(meal.number).attr('data-meal-id', index);
                    $cart_Tr_Model.find('.delete-from-cart').attr('data-meal-id', index).click(function () {
                        deleteFromCart($(this).attr('data-meal-id'));
                    });
                    $cart_Tr_Model.spinner('changing', function (e, newVal, oldVal) {
                        addToCart($(this).attr('data-meal-id'), newVal, 'total');
                    });
                    $cart_Tr_Model.show();
                    $('.cart-tr-model:hidden').parent().append($cart_Tr_Model);
                });
                $('#cart-total').text(data.total);
                $('#cart-subtotal').text(data.subtotal);
                //overhidden css change for cart
                if ($('#cartColumn table:first-child').height() > (window.innerHeight * 0.6)) {
                    $('#cartColumn table:first-child').css({'display': 'inline-block', 'overflowY': 'auto'});

                } else {
                    $('#cartColumn table:first-child').css({'display': 'table', 'overflowY': 'auto'});
                }
                //cart table scroll
                if (cart_table_scroll_pos > 0) {
                    $('#cartColumn table:first-child').scrollTo(cart_table_scroll_pos);
                }
            }, 'json');
        };

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
        classes_background_array.push(class_background_name);
        /*
         @endforeach
         */

//        $('#second').parallax("50%", 0, 0.1, true);
//        $('.bg').parallax("50%", 2500, 0.1, true);
//        $('#third').parallax("50%", 2750, 0.1, true);

        //nav scroll an
        $("#nav a").click(function () {
            $.scrollTo($(this).attr('data-href'), 1000);
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