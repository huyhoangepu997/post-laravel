<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    protected $table = 'units_type';

    protected $fillable = ['id', 'name'];

    public $timestamps = false;

}
