<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitConversion extends Model
{
    protected $table = 'units_convertion';

    protected $fillable = ['id', 'from_code', 'to_code', 'value', 'checksum'];

    public $timestamps = false;

}

