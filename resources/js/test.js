$(function() {
    $('#excute').on('click', function() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },//Headersを書き忘れるとエラーになる
            url: '/laravel/ajax',//ご自身のweb.phpのURLに合わせる
            type: 'POST',//リクエストタイプ
            data: {'user_id': {{ Auth::id() }}, 'text': 'Ajax成功'},//Laravelに渡すデータ
            contentType: false,//渡すデータによって必要(文字列だけなら不要)
            processData: false,//渡すデータによって必要(文字列だけなら不要)
        })
        // Ajaxリクエスト成功時の処理
        .done(function(data) {
            // Laravel内で処理された結果がdataに入って返ってくる
            $('#message').text(data);
        })
        // Ajaxリクエスト失敗時の処理
        .fail(function(data) {
            alert('Ajaxリクエスト失敗');
        });
    });
});