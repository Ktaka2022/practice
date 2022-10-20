@extends('layouts.app')

@section('content')
        <title>商品新規登録画面</title>

        <form action="{{ route('productcreate') }}" method="POST">
        {{ csrf_field() }}
            <input type="text" name="productname">商品名
            <select name="company">
                <option value="1">サンプル1</option>
                <option value="2">サンプル2</option>
                <option value="3">サンプル3</option>
            </select>
            <input type="text" name="price">価格
            <input type="text" name="stock">在庫数
            <input type="textarea" name="comment">コメント
            <input type="text" name="image">商品画像
            <input type="submit" value="登録">
            </form>
            <a href="{{ route('product') }}"><input type="button" name="" id="" value="戻る"></a>
@endsection