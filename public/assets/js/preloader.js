(function ($) {
    var imgList = [];
    $.extend({
        preload: function (imgArr, option) {
            var setting = $.extend({
                init: function (loaded, total) {
                },
                loaded: function (img, loaded, total) {
                },
                loaded_all: function (loaded, total) {
                }
            }, option);
            var total = imgArr.length;
            var loaded = 0;

            setting.init(0, total);
            for (var i in imgArr) {
                imgList.push($("<img />")
                    .attr("src", imgArr[i])
                    .load(function () {
                        loaded++;
                        setting.loaded(this, loaded, total);
                        if (loaded == total) {
                            setting.loaded_all(loaded, total);
                        }
                    })
                );
            }

        }
    });
})(jQuery);


$(function () {
    $.preload(classes_background_array, {
        init: function (loaded, total) {
            $(".meal-class-div").hide();
            $("#loadingtext").html("Inhalte werden geladen... bitte warten");
        },
        loaded: function (img, loaded, total) {
            var loader = 245 - ((loaded / total) * 245);
            var prozent = Math.round(loaded / total * 100);
            $("#loadingtext").html("正在加载....: " + prozent + "%");
            //$("#loadingtext").html("Lade jede Menge Inhalte: "+loaded+"/"+total);
            $("#loadingbar").css({"background-position": "0px " + loader + "px"});
        },
        loaded_all: function (loaded, total) {
            $("#loadingtext").html("加载成功, 正在打开");
            $("#preloader").delay(500).fadeOut();
            $(".meal-class-div").delay(1000).fadeIn("slow");
            // xmas loader:
            // $("#loadingtext").html("Frohe Weihnachten!");
            // $("#preloader").delay(2500).fadeOut();
            // $("#top, #home, #projects, #design, #technik, #lab, #about, #jobs").delay(3000).fadeIn("slow");
        }
    });

});