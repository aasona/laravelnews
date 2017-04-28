<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //
    protected $table = 'position';
    protected $primaryKey = 'pos_id';
    public $timestamps = false;
    protected $guarded = [];
}
