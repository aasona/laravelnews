<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //管理员表
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    public $timestamps = false;
}
