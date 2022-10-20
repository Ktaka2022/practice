@extends('layouts.app')

@section('content')
        <title>商品情報編集画面</title>
        <form action="{{ route('editproduct') }}" method="POST">
        {{ csrf_field() }}
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
                <td><input type="text" name="id" value="{{$results[0]->id}}"></td>
                <td><input type="text" name="productname" id="" value="{{$results[0]->product_name}}"></td>
                <td>
                    <select name="company" id="">
                        <option value="1">メーカー1</option>
                        <option value="2">メーカー2</option>
                        <option value="3">メーカー3</option>
                    </select>
                </td>
                <td><input type="text" name="price" id="" value="{{$results[0]->price}}"></td>
                <td><input type="text" name="stock" id="" value="{{$results[0]->stock}}"></td>
                <td><input type="text" name="comment" id="" value="{{$results[0]->comment}}"></td>
                <td><input type="text" name="image" id="" value="{{$results[0]->img_path}}"></td>
                <td><input type="submit" value="更新"></td>
            </tr>
        </table>
        </form>
        <a href="{{route('productdetails',$results[0]->id)}}"><input type="button" name="" id="" value="戻る"></a>
@endsection