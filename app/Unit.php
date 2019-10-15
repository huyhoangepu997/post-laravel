<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';

    protected $fillable = ['id', 'name', 'type', 'symbol', 'default'];

    public $timestamps = false;

    public function unitType()
    {
        return $this->belongsTo('App\UnitType','type','id');
    }
}
