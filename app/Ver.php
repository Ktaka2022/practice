<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ver extends Model
{
    protected $table = 'sales';
    protected $dates = ['created_at','updated_at'];
    protected $fillable = ['id','product_id','version','min_version'];
}
