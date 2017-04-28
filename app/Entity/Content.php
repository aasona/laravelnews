<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $table = 'content';
    protected $primaryKey = 'content_id';
    public $timestamps = false;
    protected $guarded = [];

}
