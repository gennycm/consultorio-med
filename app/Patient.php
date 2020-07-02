<?php

use Carbon\Carbon;

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_lastname', 'second_lastname', 'birthdate', 'street', 'number', 'crossing_1', 'crossing_2', 'street_name', 'postal_code',
        'city', 'state', 'country', 'cellphone', 'email', 'RFC', 'p_phys', 'p_moral', 'trade_name', 'is_surrogate', 'surrogate_id'
    ];

    public function surrogate()
    {
        return $this->belongsTo('App\Institution', 'surrogate_id');
    }
}
