@extends('layouts.app')

@section('content')
        <title>商品情報詳細画面</title>
        <table>
            <tr>
                <th>商品情報ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>メーカー</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>コメント</th>
            </tr>
            <tr>
                <td>{{$results->products_id}}</td>
                <td><img src="{{asset('image/'.$results->img_path)}}" height="300" width="300"></td>
                <td>{{$results->product_name}}</td>
                <td>{{$results->company_name}}</td>
                <td>{{$results->price}}</td>
                <td>{{$results->stock}}</td>
                <td>{{$results->comment}}</td>
                <td><a href="{{route('productedit',$results->products_id)}}"><input type="button" name="" id="" value="編集"></a></td>
            </tr>
        </table>
        <a href="{{route('product')}}"><input type="button" name="" id="" value="戻る"></a>
@endsection