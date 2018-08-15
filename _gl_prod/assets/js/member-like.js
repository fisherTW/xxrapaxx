

//刪除收藏
$('.info__like').click(function(){
    if(confirm("確定刪除收藏的商品？")){
        $(this).parents('li').remove();
    }   
});
$('.like-store-brand__like').click(function(){
    if(confirm("確定刪除收藏的店舖？")){
        $(this).parents('.like-store').remove();
    }
});


//收藏店家plugin
if ($(window).width() <= 620) {
    var carousel01,
        carousel02,
        carousel03;
    $(document).ready(function() {
        carousel01 = $("#scrolling-01 ul");
        carousel01.itemslide({
            left_sided: true
        });
        carousel02 = $("#scrolling-02 ul");
        carousel02.itemslide({
            left_sided: true
        });
        carousel03 = $("#scrolling-03 ul");
        carousel03.itemslide({
            left_sided: true
        });
        $(window).resize(function() {
            carousel01.reload();
            carousel02.reload();
            carousel02.reload();
        });
    });
}
$(window).resize(function() {
    if ($(window).width() <= 620) {
        var carousel01,
            carousel02,
            carousel03;
        $(document).ready(function() {
            carousel01 = $("#scrolling-01 ul");
            carousel01.itemslide({
                left_sided: true
            });
            carousel02 = $("#scrolling-02 ul");
            carousel02.itemslide({
                left_sided: true
            });
            carousel03 = $("#scrolling-03 ul");
            carousel03.itemslide({
                left_sided: true
            });

        });
    }
});

