<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class PositionData extends Model
{
    //
    protected $table = 'position_content';
    protected $primaryKey = 'pcon_id';
    public $timestamps = false;
    protected $guarded = [];
}
