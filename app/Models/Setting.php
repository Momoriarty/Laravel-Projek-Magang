<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'favicon',
        'nama',
        'meta',
        'status',
    ];

    /**
     * Create a new model instance that is existing.
     *
     * @param  array  $attributes
     * @return static
     */
    public static function __set_state($attributes)
    {
        $model = new static;
        $model->setRawAttributes($attributes);
        return $model;
    }
}
