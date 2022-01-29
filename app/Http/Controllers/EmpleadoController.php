<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(1);
        return view('empleados.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $empleado = [];
        //$empleado=Empleado::findOrFail($id);
     
        return view('empleados.create', compact('empleado'));
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //BOF VALIDACIÓN
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Email'=>'required|email',
            'Foto'=> 'required|max:10000|mimes:jpeg, png, jpg'
        ];

        $mensaje =[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        ];
        $this->validate($request, $campos, $mensaje);
        //EOF VALIDACIÓN





        //$datosEmpleado = request() ->all();
        $datosEmpleado = request()->except('_token');

        //Foto: si el request tiene File?? 
        if($request -> hasFile('Foto')){
            //Recuperar registros
            //$empleado = Empleado::findOrFail($id);
            //Borrar foto anterior
            //storage::delete('public/'.$empleado->Foto);
            //añadir a datosEmpleado
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }

        //Usando el Modelo inserta en base de datos
        Empleado::insert($datosEmpleado);
        

        //Busca todos los registros
        $datos['empleados']=Empleado::paginate(5);
        //return view('empleados.index', $datos);
        //return response()->json($datosEmpleado);
        return redirect('empleado')->with('mensaje','Empleado agregado con éxito');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //BOF VALIDACIÓN
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Email'=>'required|email',
           
        ];

        $mensaje =[
            'required'=>'El :attribute es requerido'
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje =['Foto.required'=>'La foto es requerida'];
        }


        $this->validate($request, $campos, $mensaje);
        //EOF VALIDACIÓN





        //Recepción de datos
        $datosEmpleado = request()->except(['_token','_method']);
        

        //Pregunta si tiene foto, sino, la incluye en el request y la manda para store
        if($request -> hasFile('Foto')){
            //INCLUIR FUNCIONES PARA PODER BORRAR ARRIBA EN USE ILLUMINATE
            //Recuperar registros
            $empleado = Empleado::findOrFail($id);
            //Borrar foto anterior
            storage::delete('public/'.$empleado->Foto);
            //INCLUIR FUNCIONES PARA PODER BORRAR ARRIBA EN USE ILLUMINATE
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        } 
     
     

        //Modelo::sql blade
        Empleado::where('id', '=', $id)->update($datosEmpleado);

        //para vovler  y recuperar el id
        $empleado=Empleado::findOrFail($id);
        //return view('empleados.edit', compact('empleado'));
        //return redirect('empleado');
        return redirect('empleado')->with('mensaje','Empleado actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Empleado $empleado)
    public function destroy($id)
    {
        $empleado=Empleado::findOrFail($id);
        //Borrar foto anterior
        storage::delete('public/'.$empleado->Foto);
        //
        Empleado::destroy($id);
     
       

        //return redirect('empleado');
        return redirect('empleado')->with('mensaje','Empleado borrado');
    }
}
