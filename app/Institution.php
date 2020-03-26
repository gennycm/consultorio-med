<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code','num_contract', 'rfc','cfdi','trade_name', 'related_institution'
    ];

    public function institutions()
    {
        return $this->hasMany(Institution::class);
    }

     public function parent()
    {
        return $this->belongsTo('App\Institution','related_institution');
    }

    public function children()
    {
        return $this->hasMany('App\Institution','related_institution');
    }


}
