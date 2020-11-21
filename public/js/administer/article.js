$(function(){

    //listpage-絞り込み活性,非活性
    $("#narrow_down select.course").change(function() {
        var course = $(this).val();
        $(".regist_place select.classification").val("");
        if(course != ""){
            $("#narrow_down select.classification").prop("disabled", false);
            var classification = $("#narrow_down select.classification option");
            $(classification).each(function(index, element){
                if($(this).attr("class") == "course_"+course){
                    $(this).css("display","block");
                }else{
                    $(this).css("display","none");
                }
            })

        }else{
            $("#narrow_down select.classification").prop("disabled", true);
        }
    });
    /******************
     * 
     * 新規ページ
     * 
     * ********* */
    $(function(){    
        var hiddencourse = $("input[name=coursehidden]").val();
        $(".regist select.course").val(hiddencourse);
        if(hiddencourse != undefined && hiddencourse != ""){
            $(".regist select.classification").prop("disabled", false);
            var classification = $(".regist_place select.classification option");
            $(classification).each(function(index, element){
                if($(this).attr("class") == "course_"+hiddencourse){
                    $(this).css("display","block");
                }else{
                    $(this).css("display","none");
                }
            })
            var hiddenclass = $("input[name=classhidden]").val();
            setTimeout(function(){
                $(".regist select.classification option.course_"+hiddencourse+"[value="+hiddenclass+"]").prop('selected', true);
            },100);
        }
    })

    //コース/分類選択活性,非活性
    $(".regist_place select.course").change(function() {
        var course = $(this).val();
        $(".regist_place select.classification").val("");

        if(course != ""){
            $(".regist_place select.classification").prop("disabled", false);
            var classification = $(".regist_place select.classification option");
            $(classification).each(function(index, element){
                if($(this).attr("class") == "course_"+course){
                    $(this).css("display","block");
                }else{
                    $(this).css("display","none");
                }
            })

        }else{
            $(".regist_place select.classification").prop("disabled", true);
        }
    });

    //ボタン処理
    $(".regist input[type=button].submit").click(function() {
        var link = location.href;
        var url = link.split('answer');
        $('.regist form').attr('action', url[0]);
        $('.regist form').attr('method', "POST");
        $('.regist form').submit();
    })

    $(".regist input[type=button].back").click(function() {
        var link = location.href;
        var url = link.split('answer');
        $('.regist form').attr('action', url[0]+"question");
        $('.regist form').attr('method', "POST");
        $('.regist form').submit();
    })

    /******************
     * 
     * 編集ページ
     * 
     * ********* */
    $(function(){    
        var hiddencourse = $("input[name=coursehidden]").val();
        $(".edit select.course").val(hiddencourse);
        if(hiddencourse != undefined && hiddencourse != ""){
            $(".edit select.classification").prop("disabled", false);
            var classification = $(".regist_place select.classification option");
            $(classification).each(function(index, element){
                if($(this).attr("class") == "course_"+hiddencourse){
                    $(this).css("display","block");
                }else{
                    $(this).css("display","none");
                }
            })
            var hiddenclass = $("input[name=classhidden]").val();
            setTimeout(function(){
                $(".edit select.classification option.course_"+hiddencourse+"[value="+hiddenclass+"]").prop('selected', true);
            },100);
        }
    })

    //ボタン処理
    $(".edit input[type=button].submit").click(function() {
        var link = location.href;
        var url = link.split('answer');
        $('.edit form').attr('action', url[0]);
        $('.edit form').attr('method', "POST");
        console.log($('.edit form').attr('action'));
        console.log($('.edit form').attr('method'));
        $('.edit form').submit();
    })

    $(".edit input[type=button].back").click(function() {
        var id = $("input[name=id]").val(); 
        var link = location.href;
        var url = link.split('answer');
        $('.edit form').attr('action', url[0]+"question/"+id);
        $('.edit form').attr('method', "POST");
        $('.edit form').submit();
    })

});