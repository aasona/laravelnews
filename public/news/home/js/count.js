/**
 * Created by Tende on 2017/3/31.
 */
/**
 * 计数器JS文件
 */


/*$.ajaxSetup({
 headers: {
 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 }
 });*/

var artIds = {};
$(".am-icon-hand-pointer-o").each(function (i) {
    artIds[i] = $(this).attr("art_id");
});

//调试
//console.log(artIds);

/*
 var url = "/count";
 $.post(url, artIds, function (result) {
 if (result.status == 1) {
 console.log(15515);
 } else {
 console.log(46848);
 }
 }, "JSON");
 */

//未经过csrf验证
$.ajax({

    type: 'POST',

    url: '/count',

    data: artIds,

    dataType: 'json',

    headers: {

        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

    },

    success: function (result) {

        if (result.status == 1) {
            //console.log(result.data);//{id：view,id:view,...}
            var counts = result.data;
            //console.log(counts);
            $.each(counts, function (art_id, art_view) {
                $(".node-" + art_id).html(art_view);
            });
        }
    },

    error: function () {
        console.log('result');
    }

});
