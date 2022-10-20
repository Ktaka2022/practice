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
                <td>{{$results[0]->id}}</td>
                <td><img src="{{asset('image/'.$results[0]->img_path)}}" height="300" width="300"></td>
                <td>{{$results[0]->product_name}}</td>
                <td>me-ka-</td>
                <td>{{$results[0]->price}}</td>
                <td>{{$results[0]->stock}}</td>
                <td>{{$results[0]->comment}}</td>
                <td><a href="{{route('productedit',$results[0]->id)}}"><input type="button" name="" id="" value="編集"></a></td>
            </tr>
        </table>
        <a href="{{route('product')}}"><input type="button" name="" id="" value="戻る"></a>
@endsection