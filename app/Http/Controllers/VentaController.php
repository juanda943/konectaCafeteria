<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;


/**
 * Class VentaController
 * @package App\Http\Controllers
 */
class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::paginate();

        return view('venta.index', compact('ventas'))
            ->with('i', (request()->input('page', 1) - 1) * $ventas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venta = new Venta();

        return view('venta.create', compact('venta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Venta::$rules);
        
        $productoIdRecibido=$request->input('producto_id');
        $cantidadRecibida=$request->input('cantidad');
        $producto = Producto::find($productoIdRecibido);
        $inStock = DB::table('productos')->where([['id', $productoIdRecibido],['stock', '>',  $cantidadRecibida]])->first();

        if (!$inStock) {
            return redirect()->route('ventas.index')->with('success', 'Sin inventario');
        }
        

        $venta = Venta::create($request->all());
        $producto->stock=$producto->stock - $cantidadRecibida;
        $producto->save();

        //$inStock = $this.inStock($productoIdRecibido, $cantidadRecibida);
        


        return redirect()->route('ventas.index')
            ->with('success', 'Venta creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Venta::find($id);

        return view('venta.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = Venta::find($id);

        return view('venta.edit', compact('venta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Venta $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        request()->validate(Venta::$rules);

        $venta->update($request->all());

        return redirect()->route('ventas.index')
            ->with('success', 'Venta updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $venta = Venta::find($id)->delete();

        return redirect()->route('ventas.index')
            ->with('success', 'Venta deleted successfully');
    }
    /**public function inStock($producto_id, $cantidad)
    {
        $inStock = DB::table('productos')->where('id', $producto_id)->andWhere('stock', '>', $cantidad)->get();
        if ($inStock[0]) return true;
        return false; 
        
    }
    */

}
