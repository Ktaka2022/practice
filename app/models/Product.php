<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    //テーブル指定
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


    //全件取得機能
    public function getAll() {
            $product = \DB::table($this->table)
            ->select(
                'products.id as products_id',
                'company_id',
                'product_name',
                'price',
                'stock',
                'comment',
                'img_path',
                'company_name'
            )
            ->leftjoin(
                'companies',
                'companies.id','=','products.company_id'
            )
            ->get();
        return $product;
    }
    

    //検索機能
    public function getSearchQuery(Request $req) {
        // dd($req->productName);
        $product = \DB::table($this->table)->select(
            'products.id as products_id',
            'company_id',
            'product_name',
            'price',
            'stock',
            'comment',
            'img_path',
            'company_name'
        );

        // if($req->productName){
        //     // dd($req->productName);
        //     $product->where('product_name',$req->productName);
        // }else if($req->stockMin && $req->stockMax){
        //     // dd($req->stockMin);
        //     $product->where('stock','>=',$req->stockMin)
        //     ->where('stock','=<',$req->stockMax);
        // }else if($req->priceMax && $req->priceMin){
        //     // dd($req->priceMax);
        //     $product->where('price','=<',$req->priceMin)
        //     ->where('price','>=',$req->priceMax);
        // }else {
        //     // dd($req->company_select);
        //     $product->where('companies.id',$req->company_select);
        // }

        if($req->productName){
            // dd($req->productName);
            $product = $product->where('product_name',$req->productName);
        }
        if($req->stockMin && $req->stockMax){
            // dd($req->stockMin);
            $product->where('stock','<=',$req->stockMax)
            ->where('stock','>=',$req->stockMin);
        }
        if($req->priceMax && $req->priceMin){
            // dd($req->priceMax,$req->priceMin);
            $product->where('price','<=',$req->priceMax)
            ->where('price','>=',$req->priceMin);
        }
        if($req->company_select && $req->company_select != 0){
            // dd($req->company_select);
            $product->where('companies.id',$req->company_select);
        }
        // dd($product->toSql());
        $product = $product->leftjoin('companies','companies.id','=','products.company_id')->get();
        // dd($product[0]->stock);
        return $product;
    }


    //削除機能
    public function queryDelete(Request $req){
        // dd($req);
        // dd($req->delid);
        DB::beginTransaction();
        try{
            $data = \DB::table($this->table)
            ->where('id',$req->delid)
            ->delete();
            // dd($req->delid);
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
        }

        $product = \DB::table($this->table)
        ->select(
        'products.id as products_id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
        'company_name'
        )
        ->leftjoin(
            'companies',
            'companies.id','=','products.company_id'
        )
        ->get();
        // dd($product);

        return $product;
    }


    //商品登録機能
    public function insertNewProduct(Request $req) {
        DB::beginTransaction();
        try {
            $data = \DB::table($this->table)->insert([
                'company_id'    =>  $req->company,
                'product_name'  =>  $req->productname,
                'price'         =>  $req->price,
                'stock'         =>  $req->stock,
                'comment'       =>  $req->comment,
                'img_path'      =>  $req->image,
                'created_at'    =>  Carbon::now()
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $sessionflashmessage = $e;//エラー文
            return back();
        }
        return;
    }

    //商品詳細表示機能
    public function getProductDetail($id) {
        // $query = DB::table($this->table)
        // ->where('id',$id)
        // // ->leftjoin('')
        // ->first();

        // dd($id);

        $query = \DB::table($this->table)
        ->select(
        'products.id as products_id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
        'company_name'
        )
        ->where('products.id',$id)
        ->leftjoin(
            'companies',
            'companies.id','=','products.company_id'
        )
        ->first();
        // dd($query->product_id);
        return $query;
    }
    
    //商品編集表示
    public function viewEditProduct($id){
        $results = \DB::table('products')
        ->where('id',$id)
        ->first();

        return $results;
    }

    //商品編集機能
    public function editProduct($req) {
        DB::beginTransaction();
        try {
            $data = \DB::table($this->table)
            ->where('id',$req->id)
            ->update([
            'company_id'    =>  $req->company,
            'product_name'  =>  $req->productname,
            'price'         =>  $req->price,
            'stock'         =>  $req->stock,
            'comment'       =>  $req->comment,
            'img_path'      =>  $req->image,
            'updated_at'    =>  Carbon::now()
        ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        $results = \DB::table($this->table)
        ->where('id',$req->id)
        ->first();
        return $results;
    }

    //商品ソート機能
    public function sortProduct($req,$sorttype,$sortname){
        $product = \DB::table($this->table)->select(
            'products.id as products_id',
            'company_id',
            'product_name',
            'price',
            'stock',
            'comment',
            'img_path',
            'company_name'
        );
        if($req->productName){
            $product->where('product_name',$req->productName);
        }
        if($req->stockMin && $req->stockMax){
            $product->where('stock','<=',$req->stockMax)
            ->where('stock','>=',$req->stockMin);
        }
        if($req->priceMax && $req->priceMin){
            $product->where('price','<=',$req->priceMax)
            ->where('price','>=',$req->priceMin);
        }
        if($req->company_select && $req->company_select != 0){
            $product->where('companies.id',$req->company_select);
        }

        $product = $product->leftjoin('companies','companies.id','=','products.company_id');

        if($sortname){
            if($sortname === 'id'){
                $sortname = 'products_id';
            }
            if($sorttype === 'Asc'){
                $product->orderBy($sortname,'asc');
            }else if($sorttype === 'Desc'){
                $product->orderBy($sortname,'desc');
            }else {
                $product = $product->get();
                return $product;
            }
        }

        $product = $product->get();
        return $product;
    }
}