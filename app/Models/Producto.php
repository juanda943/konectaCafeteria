<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Producto
 *
 * @property $id
 * @property $nombre
 * @property $referencia
 * @property $precio
 * @property $peso
 * @property $categoria
 * @property $stock
 * @property $fechaCreacion
 * @property $created_at
 * @property $updated_at
 *
 * @property Venta[] $ventas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'referencia' => 'required',
		'precio' => 'required',
		'peso' => 'required',
		'categoria' => 'required',
		'stock' => 'required',
		'fechaCreacion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','referencia','precio','peso','categoria','stock','fechaCreacion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventas()
    {
        return $this->hasMany('App\Models\Venta', 'producto_id', 'id');
    }
    
    public function inStock($producto_id, $cantidad)
    {
        $inStock = DB::table('productos')->where('id', $producto_id)->andWhere('stock', '>', $cantidad)->get();
        if ($inStock[0]) return true;
        return false; 
        
    }

}
