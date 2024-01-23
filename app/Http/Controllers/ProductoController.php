<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Support\Facades\Validator;
use lluminate\Support\Facades\DB;
use lluminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime; // Add this line to import the DateTime class
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        return view('admin.productos.crear', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        $productos = new Producto; 

        // Recibo todos los datos del formulario de la vista 'crear.blade.php'
        $productos->nombre = $request->nombre;
        $productos->descripcion = $request->descripcion;
        $productos->precio = $request->precio;
        $productos->stock = $request->stock;
        
        // Almacenos la imagen en la carpeta publica especifica, esto lo veremos más adelante 
        $productos->imagen = $request->file('imagen')->store('/'); 
    
        // Guardamos la fecha de creación del registro 
        $productos->created_at = (new DateTime)->getTimestamp(); // Update this line

        // Inserto todos los datos en mi tabla 'productos' 
        $productos->save();
    
        // Hago una redirección a la vista principal con un mensaje 
        return redirect('admin/productos')->with('message','Guardado Satisfactoriamente !'); 
    }
 

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        return view('admin.productos.detalles', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        return view('admin/productos.actualizar',['producto'=>$producto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, $id)
    {        
        // Recibo todos los datos desde el formulario Actualizar
        $productos = Producto::find($id);
        $productos->nombre = $request->nombre;
        $productos->descripcion = $request->descripcion;
        $productos->precio = $request->precio;
        $productos->stock = $request->stock;
     
        // Recibo la imagen desde el formulario Actualizar
        if ($request->hasFile('imagen')) {
            $productos->imagen = $request->file('imagen')->store('/');
        }
     
        // Guardamos la fecha de actualización del registro 
        $productos->updated_at = (new DateTime)->getTimestamp(); 
            
        // Actualizo los datos en la tabla 'productos'
        $productos->save();
     
        // Muestro un mensaje y redirecciono a la vista principal 
        Session::flash('message', 'Editado Satisfactoriamente !');
        return Redirect::to('admin/productos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $productos = Producto::find($id);
 
        // Elimino la imagen de la carpeta 'uploads', esto lo veremos más adelante
        $imagen = explode(",", $productos->imagen);
        Storage::delete($imagen);
            
        // Elimino el registro de la tabla 'productos' 
        Producto::destroy($id); 
     
        // Opcional: Si deseas guardar la fecha de eliminación de un registro, debes mantenerlo en 
        // una tabla llamada por ejemplo 'productos_eliminados' y alli guardas su fecha de eliminación 
        $productos->deleted_at = (new DateTime)->getTimestamp();
            
        // Muestro un mensaje y redirecciono a la vista principal 
        Session::flash('message', 'Eliminado Satisfactoriamente !');
        return Redirect::to('admin/productos');
    }
}
