<?php

namespace App\Http\Controllers;

use App\Models\Empleo;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
/**
 * Class EmpleadoController
 * @package App\Http\Controllers
 */
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request){
        // $empleado = new Empleado();
        // $empleado->Correo = $request->Correo;
        // $empleado->save();
        // return response()->json(['success'=>'Data is successfully added']);

        $input = $request->only(['Correo']);

        $request_data = [
            'Correo' => 'required|email|unique:empleados,Correo',
        ];

        $validator = Validator::make($input, $request_data);

        // json is null
        if ($validator->fails()) {
            $errors = json_decode(json_encode($validator->errors()), 1);
            return response()->json([
                'success' => false,
                'message' => array_reduce($errors, 'array_merge', array()),
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'The email is available'
            ]);
        }


        
        // return response()->json(['success'=>'Hello World']);

        //Como manipular un objeto JSON
        
    }



    public function index()
    {
        $empleados = Empleado::paginate();

        return view('empleado.index', compact('empleados'))
            ->with('i', (request()->input('page', 1) - 1) * $empleados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleado = new Empleado();
        $empleo = Empleo::pluck('empleo','id');
        return view('empleado.create', compact('empleado','empleo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // request()->validate(Empleado::$rules);

        // $empleado = Empleado::create($request->all());
        // $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');

        $this->validate($request, array(
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email|unique:empleados,Correo',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',

        ));

        $empleado = request()->except('_token');


        if($request->hasFile('Foto')){
            $empleado['Foto']=$request->file('Foto')->store('uploads','public');

        }

        Empleado::insert($empleado);



        return redirect()->route('empleados.index')
            ->with('success', 'Empleado created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);

        return view('empleado.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::find($id);
        $empleo = Empleo::pluck('empleo','id');

        return view('empleado.edit', compact('empleado','empleo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // request()->validate(Empleado::$rules);

        // $empleado->update($request->all());


        $this->validate($request, array(
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>"required|email|unique:empleados,Correo,$id"
        ));


        $mensaje=[
            'required'=>'El :attribute es requerido',

        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=['Foto.required'=>'La foto es requerida'];

        }


        $datosEmpleado = request()->except(['_token','_method']);

        if($request->hasFile('Foto')){
            $empleado=Empleado::findOrFail($id);

            Storage::delete('public/'.$empleado->Foto);

            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }


        Empleado::where('id','=',$id)->update($datosEmpleado);
        $empleado=Empleado::findOrFail($id);
        
        return redirect()->route('empleados.index')
            ->with('success', 'Empleado updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        
        $empleado=Empleado::findOrFail($id);

        if(Storage::delete('public/'.$empleado->Foto)){

            Empleado::destroy($id);

        }

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado deleted successfully');
    }
}