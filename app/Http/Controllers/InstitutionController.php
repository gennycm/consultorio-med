<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Institution;

class InstitutionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $institutions = Institution::orderBy('name', 'asc')
            ->with('parent')
            ->paginate(10);
        // dd($institutions);
        $parent_institutions = $this->getParentInstitutions();
        return view('institutions.index', compact('institutions', 'parent_institutions'))
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
        return view('institutions.create', compact('institutions'));
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
            'code' => 'required',
            'num_contract' => 'required',
            'rfc' => 'required',
            'cfdi' => 'required',
            'trade_name' => 'required'
            //'related_institution' => 'required'
        ]);

        $input = $request->all();
        $institution = Institution::create($input);
        return redirect()->route('institutions.index')
            ->with('success', 'Institución creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $institution = Institution::find($id);
        if ($institution->related_institution != null) {
            $related_institution = Institution::find($institution->related_institution);
            return view('institutions.show', compact('institution', 'related_institution'));
        } else {
            return view('institutions.show', compact('institution'));
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
        $institution = Institution::find($id);
        $institutions = Institution::pluck('name', 'id')->all();

        if ($institution->related_institution != null) {
            $related_institution = $institution->related_institution;
            //Institution::find($institution->related_institution);
            return view('institutions.edit', compact('institution', 'institutions', 'related_institution'));
        } else {
            return view('institutions.edit', compact('institution', 'institutions'));
        }
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
            'code' => 'required',
            'num_contract' => 'required',
            'rfc' => 'required',
            'cfdi' => 'required',
            'trade_name' => 'required'
            //'related_institution' => 'required'
        ]);

        $input = $request->all();
        $institution = Institution::find($id);
        $institution->update($input);

        return redirect()->route('institutions.index')
            ->with('success', 'Institución actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Institution::find($id)->delete();
        Institution::where('related_institution', '=', $id)->update(['related_institution' => 1]); // 1 = ninguna
        return redirect()->route('institutions.index')
            ->with('success', 'Institución eliminada exitosamente');
    }


    /**************************** Additional methods *************************************/

    public function search(Request $request)
    {
        $search = $request->get('search');
        if ($search === null) {
            $institutions = Institution::orderBy('name', 'asc')
            ->with('parent')
            ->paginate(10);

            return view('partials.institutions_table', compact('institutions'))
                ->with('i', ($request->input('page', 1) - 1) * 10)->render();
        } else {
            $institutions = DB::table('institutions AS children')
                ->Join('institutions AS parent', 'children.related_institution', '=', 'parent.id')
                ->select(
                    'children.id',
                    'children.name',
                    'children.num_contract',
                    'children.rfc',
                    'children.cfdi',
                    'children.trade_name',
                    'children.related_institution',
                    'parent.id AS parent_id',
                    'parent.name AS parent_name'
                )
                ->where('children.name', 'like', '%' . $search . '%')
                ->orWhere('parent.name', 'like', '%' . $search . '%')
                ->orderBy('name', 'asc')
                ->paginate(10);

            return view('partials.institutions_search_table', compact('institutions'))
                ->with('i', ($request->input('page', 1) - 1) * 10)->render();
        }
    }

    public function clean(Request $request)
    {
        $institutions = Institution::orderBy('name', 'asc')
            ->with('parent')
            ->paginate(10);


        return view('partials.institutions_table', compact('institutions'))
            ->with('i', ($request->input('page', 1) - 1) * 10)->render();
    }


    public function getParentInstitutions()
    {
        $institutions = Institution::where('related_institution', '=', 1) //ninguna
            //->with('children')
            ->get();
        return  $institutions;
    }
}