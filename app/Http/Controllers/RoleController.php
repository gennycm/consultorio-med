<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;


class RoleController extends Controller
{
    private  $messages = [];

    private $attributes = [
        'name' => 'Nombre',
        'permission' => 'Permisos'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

        $this->middleware('permission:Ver roles|Crear roles|Editar roles|Eliminar roles', ['only' => ['index', 'store']]);
        $this->middleware('permission:Ver roles', ['only' => ['create', 'store']]);
        $this->middleware('permission:Editar roles', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Eliminar roles', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('name', 'ASC')->paginate(5);
        return view('roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create', compact('permission'));
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ], $this->messages, $this->attributes);


        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
            ->with('success', 'Rol creado exitosamente');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();


        return view('roles.show', compact('role', 'rolePermissions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();


        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
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
            'name' => 'required',
            'permission' => 'required',
        ], $this->messages, $this->attributes);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();


        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
            ->with('success', 'Rol actualizado exitosamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->role_id;
        DB::table("roles")->where('id', $id)->delete();
        return back()
            ->with('success', 'Rol eliminado exitosamente');
    }

    /**************************** Additional methods *************************************/

    public function search(Request $request)
    {
        $search = $request->get('search');

        if ($search === null) {
            $roles = Role::orderBy('name', 'asc')
                ->paginate(10);
        } else {
            $roles = Role::where('name', 'like', '%' . $search . '%')
                ->orderBy('name', 'asc')
                ->paginate(10);
        }

        return view('partials.roles_table', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 10)->render();
    }

    public function clean(Request $request)

    {
        $roles = Role::orderBy('name', 'asc')
            ->paginate(10);

        return view('partials.roles_table', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 10)->render();
    }
}
