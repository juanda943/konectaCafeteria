<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Venta
 *
 * @property $id
 * @property $producto_id
 * @property $cantidad
 * @property $created_at
 * @property $updated_at
 *
 * @property Producto $producto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Venta extends Model
{
    
    static $rules = [
		'producto_id' => 'required',
		'cantidad' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['producto_id','cantidad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'producto_id');
    }
    

}
