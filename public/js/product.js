//検索機能非同期処理
$(document).on('click', '#searchbutton', function () {
// $('#searchbutton').on('click',function(){
    console.log("----search_func_start----");
    let productUrl = "http://localhost:8888/cytest/public/";
    let productName = $('#productName').val();
    let company_select = $('#company_select').val();
    let priceMax = $('#priceMax').val();
    let priceMin = $('#priceMin').val();
    let stockMax = $('#stockMax').val();
    let stockMin = $('#stockMin').val();
    // let productName = document.getElementsByName('productName').value;
    // let company_select = document.getElementsByName('company_select');
    console.log("get_ok");
    console.log(productName+":名前");
    console.log(company_select+":セレクト");
    console.log("texttest-----------");
    $.ajax({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        url: 'productsearch',
        type: 'POST',
        data:JSON.stringify({
            productName:productName,
            company_select:company_select,
            priceMax:priceMax,
            priceMin:priceMin,
            stockMax:stockMax,
            stockMin:stockMin
        }),
        datatype:"text",
        contentType: "application/json",
        // processData: false,
    })
    //ajax成功
    .done(function(data){
        console.log('done');
        // console.log('data[0].product_name:'+data[0].product_name);
        $("td").remove(".dbconect");
        $("tr").remove(".dbconect");
        console.log("delete");
        
        //ループテスト
        $.each(data,function(index,val){
            console.log(index);
            $("#product").append('<tr class="dbconect" id = "'+val.products_id+'"></tr>');
            $('#'+val.products_id).append(
                '<td class="dbconect">'+val.products_id+'</td>');
            $('#'+val.products_id).append(
                '<td class="dbconect"><img src="'+productUrl+'image/'+val.img_path+'" height="300" width="300"></td>');
            $('#'+val.products_id).append(
                '<td class="dbconect">'+val.product_name+'</td>');
            $('#'+val.products_id).append(
                '<td class="dbconect">'+val.price+'</td>');
            $('#'+val.products_id).append(
                '<td class="dbconect">'+val.stock+'</td>');
            $('#'+val.products_id).append(
                '<td class="dbconect">'+val.company_name+'</td>');
            $('#'+val.products_id).append(
                '<td class="dbconect"><a href="'+productUrl+'productdetails/'+val.products_id+
                ') }}"><input type="button" value="詳細表示" id="detailbutton"></a><td>');
            $('#'+val.products_id).append(
                '<td class="dbconect" id="'+val.products_id+'">'
                    +'<input class="deletebutton" type="button" value="削除"></td>');

        });
    })
    //ajax失敗
    .fail(function(data){
        console.log("fail")
        console.log("error:"+e);
        return;
    })
});


//削除機能非同期処理
$(document).on('click', '.deletebutton', function () {
// $('.deletebutton').on('click',function(){
    console.log("-----del_func_start-----");
    let productUrl = "http://localhost:8888/cytest/public/";
    let delid = $(this).parent().attr('id');
    console.log("ID:"+delid);
    console.log("----ajax_start----");
    $.ajax({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        url: 'productdelete',
        type: 'POST',
        data:JSON.stringify({
            delid:delid
        }),
        datatype:"text",
        contentType: "application/json",
    })
    //ajax成功
    .done(function(data){
        console.log('done');
        // dd('data');
        console.log(data);
        // console.log(data[0].productName);
        // $("td").remove(".dbconect");
        // $("tr").remove(".dbconect");
        console.log("delete");
        //idの行消す
        $("tr").remove("#"+delid);
        console.log("remove_ok");
    })
    //ajax失敗
    .fail(function(data){
        console.log("fail")
        console.log("error:"+e);
        return;
    })
});


//ソート機能非同期処理
// $("sortcol").focusout(function () {
$(document).ready(function(){
        $("#sortcol").change(function(){
        console.log("-----sort_func_start-----");
        let productUrl = "http://localhost:8888/cytest/public/";
        let sort = $('#sortcol').val();
        let productName = $('#productName').val();
        let company_select = $('#company_select').val();
        let priceMax = $('#priceMax').val();
        let priceMin = $('#priceMin').val();
        let stockMax = $('#stockMax').val();
        let stockMin = $('#stockMin').val();
        console.log("select:"+sort);
        console.log("----ajax_start----");
        $.ajax({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            url: 'productsort',
            type: 'POST',
            data:JSON.stringify({
                sort:sort,
                productName:productName,
                company_select:company_select,
                priceMax:priceMax,
                priceMin:priceMin,
                stockMax:stockMax,
                stockMin:stockMin
            }),
            datatype:"text",
            contentType: "application/json",
        })
        //ajax成功
        .done(function(data){
            console.log('done');

            //delete
            $("td").remove(".dbconect");
            $("tr").remove(".dbconect");
            console.log("---中身---");
            console.log(data);
            console.log("delete");
            $.each(data,function(index,val){
                console.log(index);
                $("#product").append('<tr class="dbconect" id = "'+val.products_id+'"></tr>');
                $('#'+val.products_id).append(
                    '<td class="dbconect">'+val.products_id+'</td>');
                $('#'+val.products_id).append(
                    '<td class="dbconect"><img src="'+productUrl+'image/'+val.img_path+'" height="300" width="300"></td>');
                $('#'+val.products_id).append(
                    '<td class="dbconect">'+val.product_name+'</td>');
                $('#'+val.products_id).append(
                    '<td class="dbconect">'+val.price+'</td>');
                $('#'+val.products_id).append(
                    '<td class="dbconect">'+val.stock+'</td>');
                $('#'+val.products_id).append(
                    '<td class="dbconect">'+val.company_name+'</td>');
                $('#'+val.products_id).append(
                    '<td class="dbconect"><a href="'+productUrl+'productdetails/'+val.products_id+
                    ') }}"><input type="button" value="詳細表示" id="detailbutton"></a><td>');
                $('#'+val.products_id).append(
                    '<td class="dbconect" id="'+val.products_id+'">'
                        +'<input class="deletebutton" type="button" value="削除"></td>');

            });
        
        })
        //ajax失敗
        .fail(function(data){
            console.log("fail")
            console.log("error:"+e);
            return;
        })
    })
});