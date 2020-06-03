<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;


class UserController extends Controller
{
    private  $messages = [
        'password.regex' => 'La contraseña debe consistir de mínimo diez caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial (p.e.: $!%.*?&@).',
        'confirm-password.regex' => 'La contraseña debe consistir de mínimo diez caracteres, al menos una letra mayúscula, una letra minúscula, un número y un carácter especial (p.e.: $!%.*?&@).'
    ];

    private $attributes = [
        'name' => 'Nombre',
        'email' => 'Correo electrónico',
        'password' => 'Contraseña',
        'confirm-password' => 'Confirmar contraseña'
    ];

    function __construct()
    {
        //Usuarios
        $this->middleware('permission:Ver usuarios|Crear usuarios|Editar usuarios|Eliminar usuarios', ['only' => ['index', 'store']]);
        $this->middleware('permission:Ver usuarios', ['only' => ['create', 'store']]);
        $this->middleware('permission:Editar usuarios', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Eliminar usuarios', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('name', 'DESC')->paginate(10);
        return view('users.index', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
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
            'name' => 'required|regex:/^[A-Za-z0-9üéáíóúñÑÁÉÍÓÚ\s-]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%.*?&])[A-Za-z\d@$!%.*?&]{10,}$/|same:confirm-password',
            'roles' => 'required'
        ], $this->messages, $this->attributes);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();


        return view('users.edit', compact('user', 'roles', 'userRole'));
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
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%.*?&])[A-Za-z\d@$!%.*?&]{10,}$/|same:confirm-password',
            'roles' => 'required'
        ], $this->messages, $this->attributes);


        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->user_id;
        User::find($id)->delete();
        return back()
            ->with('success', 'Usuario eliminado exitosamente');
    }


    /**************************** Additional methods *************************************/

    public function search(Request $request)
    {
        $search = $request->get('search');

        if ($search === null) {
            $users = User::orderBy('name', 'asc')
                ->paginate(10);
        } else {
            $users = User::where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orderBy('name', 'asc')
                ->paginate(10);
        }

        return view('partials.users_table', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 10)->render();
    }

    public function clean(Request $request)

    {
        $users = User::orderBy('name', 'asc')
            ->paginate(10);

        return view('partials.users_table', compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 10)->render();
    }
}
