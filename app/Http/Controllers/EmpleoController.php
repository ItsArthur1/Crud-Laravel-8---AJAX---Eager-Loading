<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Empleo;
use Illuminate\Http\Request;
/**
 * Class EmpleoController
 * @package App\Http\Controllers
 */
class EmpleoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

 




    public function index()
    {
        $empleos = Empleo::paginate();

        return view('empleo.index', compact('empleos'))
            ->with('i', (request()->input('page', 1) - 1) * $empleos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleo = new Empleo();
        return view('empleo.create', compact('empleo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Empleo::$rules);

        $empleo = Empleo::create($request->all());

        return redirect()->route('empleos.index')
            ->with('success', 'Empleo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleo = Empleo::find($id);

        return view('empleo.show', compact('empleo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleo = Empleo::find($id);

        return view('empleo.edit', compact('empleo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Empleo $empleo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleo $empleo)
    {
        request()->validate(Empleo::$rules);

        $empleo->update($request->all());

        return redirect()->route('empleos.index')
            ->with('success', 'Empleo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $empleo = Empleo::find($id)->delete();

        return redirect()->route('empleos.index')
            ->with('success', 'Empleo deleted successfully');
    }
}
