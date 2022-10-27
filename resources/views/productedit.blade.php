@extends('layouts.app')

@section('content')
        <title>商品情報編集画面</title>
        <form action="{{ route('editproduct') }}" method="POST">
        @csrf
        <table>
            <tr>
                <th>商品情報ID</th>
                <th>商品名</th>
                <th>メーカー</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>コメント</th>
                <th>商品画像</th>
                <th>更新ボタン</th>
            </tr>
            <tr>
                <td><input type="text" name="id" value="{{$results->id}}"></td>
                <td><input type="text" name="productname" id="" value="{{$results->product_name}}"></td>
                <td>
                    <select name="company" id="">
                        <option value="1">メーカー1</option>
                        <option value="2">メーカー2</option>
                        <option value="3">メーカー3</option>
                    </select>
                </td>
                <td><input type="text" name="price" id="" value="{{$results->price}}"></td>
                <td><input type="text" name="stock" id="" value="{{$results->stock}}"></td>
                <td><input type="text" name="comment" id="" value="{{$results->comment}}"></td>
                <td><input type="text" name="image" id="" value="{{$results->img_path}}"></td>
                <td><input type="submit" value="更新"></td>
            </tr>
        </table>
        </form>
        <a href="{{route('productdetails',$results->id)}}"><input type="button" name="" id="" value="戻る"></a>
@endsection