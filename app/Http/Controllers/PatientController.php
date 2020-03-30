<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Institution;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class PatientController extends Controller
{
    function __construct()
    {
        //pacientes
        $this->middleware('permission:Ver pacientes|Crear pacientes|Editar pacientes|Eliminar pacientes', ['only' => ['index', 'store']]);
        $this->middleware('permission:Ver pacientes', ['only' => ['create', 'store']]);
        $this->middleware('permission:Editar pacientes', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Eliminar pacientes', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patients = Patient::orderBy('id', 'DESC')
            ->paginate(10);
        return view('patients.index', compact('patients'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutions = Institution::pluck('name', 'id')->all();

        return view('patients.create', compact('institutions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'first_lastname' => 'required',
            'second_lastname' => 'required',
            'street' => 'required',
            'number' => 'required',
            'crossing_1' => 'required',
            'street_name' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'cellphone' => 'required',
            'email' => 'required|email|unique:patients,email',
            'cellphone' => 'required',
            'state' => 'required'
            //'related_institution' => 'required'
        ]);

        $input = $request->all();
        $patient = Patient::create($input);
        return redirect()->route('patients.index')
            ->with('success', 'Paciente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        if ($patient->is_surrogate) {
            $surrogate = Institution::find($patient->surrogate_id);
            return view('patients.show', compact('patient', 'surrogate'));
        } else {
            return view('patients.show', compact('patient'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Patient::find($id)->delete();
        return redirect()->route('patients.index')
            ->with('success', 'Paciente eliminado exitosamente');
    }
}
