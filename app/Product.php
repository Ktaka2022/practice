<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "products";

    protected $fillable = [
        'id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
        'created_at',
        'updated_at'
    ];


    //全件取得処理

    public function getAll(){
        $query = DB::table($this->table)->get();
        return $query;
    }


    //部分一致取得処理
    
    public function getSearchQuery($product_name) {
        $query = DB::table($this->table)
        ->where('product_name', 'like', "%$product_name");

        return $query;
    }


    //企業名select検索処理
    
    public function getSelectSearchQuery($select){
        $query = DB::table($this->table)
        ->where('company_id',$select)
        ->orderBy('id',asc);

        return $query;
    }


    //商品削除処理

    public function deleteProduct($id){
        DB::table($this->table)
        ->where('id',$id)
        ->delete();

        return ;
    }

    //新規商品登録処理

    public function insertNewProduct($param) {
        DB::table($this->table)->insert([
            'id'            => $param['id'],
            'company_id'    => $param['company_id'],
            'product_name'  => $param['product_name'],
            'price'         => $param['price'],
            'stock'         => $param['stock'],
            'comment'       => $param['comment'],
            'img_path'      => $param['img_path'],
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }

    //商品詳細表示処理
    public function getProductDetail($id) {
        $query = DB::table($this->table)
        ->where('id',$id);

        return $query;
    }

    //商品編集処理
    public function editProduct($param) {
        DB::table($this->table)
        ->where('id',$param['id'])
        ->update([
            'id'            => $param['id'],
            'company_id'    => $param['company_id'],
            'product_name'  => $param['product_name'],
            'price'         => $param['price'],
            'stock'         => $param['stock'],
            'comment'       => $param['comment'],
            'img_path'      => $param['img_path'],
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }
}
