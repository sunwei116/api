<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
