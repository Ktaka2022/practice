<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    //テーブル指定
    protected $table = "products";

    protected $fillable = [
        'id',
        'product_id',
        'created_at',
        'updated_at'
    ];

    public function decrimentStock($id){
        $results = \DB::table($this->table)
        ->where('id',$id)
        ->first();


        $data = \DB::table($this->table)
        ->where('id',$id)
        ->update([
            'stock'         =>  $results->stock-1,
        ]);
    }
}


