<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    //
    use Notifiable;

    protected $guarded = [
        'id', 
        'company_id',
        'street_address',
        'respresentative_name'
    ];


    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
