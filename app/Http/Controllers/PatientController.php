<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Institution;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class PatientController extends Controller
{
    private $branches = ["Mérida"=>"Mérida", "Campeche"=>"Campeche"];
    private  $messages = [
        'cellphone.regex' => 'El Celular debe consistir de 10 dígitos, sin espacios o guiones.',
        'postal_code.regex' => 'El Código Postal debe consistir de 5 dígitos.',
    ];

    private $attributes = [
        'name' => 'Nombre',
        'first_lastname' => 'Apellido Paterno',
        'second_lastname' => 'Apellido Materno',
        'cellphone' => 'Celular',
        'email' => 'Correo electrónico',
        'birthdate' => 'Fecha de nacimiento',
        'street' => 'Calle',
        'number' => 'Número',
        'crossing_1' => 'Cruzamiento 1',
        'branch' => 'Sucursal 1',
        'street_name' => 'Nombre de la calle',
        'postal_code' => 'Código postal',
        'city' => 'Ciudad',
        'state' => 'Estado',
        'country' => 'País',
        'RFC' => 'RFC'
    ];

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
        $patients = Patient::orderBy('name', 'asc')
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
        $branches = $this->branches;

        return view('patients.create', compact('institutions', 'branches'));
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
            'name' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s]+$/',
            'first_lastname' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s]+$/',
            'second_lastname' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s]+$/',
            'cellphone' => 'required|numeric|regex:/[0-9]{10}/',
            'email' => 'required|email|unique:patients,email',
            'street' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'birthdate' => 'required|before:today',
            'number' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'crossing_1' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'street_name' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s]+$/',
            'postal_code' => 'required|numeric|regex:/[0-9]{5}/',
            'city' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s]+$/',
            'state' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s]+$/',
            'country' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s]+$/',
            'RFC' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s]+$/',
            'p_phys' => 'nullable',
            'p_moral' => 'nullable',
            'trade_name' => 'nullable|^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s.-]+$',
            'is_surrogate' => 'nullable',
            'surrogate_id' => 'nullable|numeric'
        ], $this->messages, $this->attributes);

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
        if ($patient->is_surrogate === 0) {
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
        $branches = $this->branches;
        $patient = Patient::find($id);
        $institutions = Institution::pluck('name', 'id')->all();

        if ($patient->surrogate_id != null) {
            $surrogate_id = $patient->surrogate_id;
        } else {
            $surrogate_id = 0;
        }
        return view('patients.edit', compact('patient', 'institutions', 'surrogate_id', 'branches'));
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
        $this->validate($request, [
            'name' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'first_lastname' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'second_lastname' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'cellphone' => 'required|numeric|regex:/[0-9]{10}/',
            'email' => 'required|email|unique:patients,email,'. $id,
            'birthdate' => 'required|before:today',
            'street' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'number' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'crossing_1' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'street_name' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s]+$/',
            'postal_code' => 'required|numeric|regex:/[0-9]{5}/',
            'city' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'state' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'country' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'RFC' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s]+$/',
            'p_phys' => 'nullable',
            'p_moral' => 'nullable',
            'trade_name' => 'nullable|^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s.-]+$',
            'is_surrogate' => 'nullable',
            'surrogate_id' => 'nullable|numeric'
        ], $this->messages, $this->attributes);

        $input = $request->all();
        $patient = Patient::find($id);
        $patient->update($input);

        return redirect()->route('patients.index')
            ->with('success', 'Paciente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->patient_id;
        Patient::find($id)->delete();
        return back()
            ->with('success', 'Paciente eliminado exitosamente');
    }


    /**************************** Additional methods *************************************/

    public function search(Request $request)
    {
        $search = $request->get('search');

        if ($search === null) {
            $patients = Patient::orderBy('name', 'asc')
                ->paginate(10);
        } else {
            $patients = Patient::where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('first_lastname', 'like', '%' . $search . '%')
                ->orWhere('second_lastname', 'like', '%' . $search . '%')
                ->orWhere('branch', 'like', '%' . $search . '%')
                ->orderBy('name', 'asc')
                ->paginate(10);
        }

        return view('partials.patients_table', compact('patients'))
            ->with('i', ($request->input('page', 1) - 1) * 10)->render();
    }

    public function clean(Request $request)

    {
        $patients = Patient::orderBy('name', 'asc')
            ->paginate(10);

        return view('partials.patients_table', compact('patients'))
            ->with('i', ($request->input('page', 1) - 1) * 10)->render();
    }
}
