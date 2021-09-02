<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Company::orderBy('name', 'DESC')->get();

        if (isset($request->company_id) && $request->company_id != 0) {
            $data = Company::where('id', $request->company_id)->get();
        }

        $companies = Company::orderBy('name')->get();
        return view('companies.index', ['companies' => $companies, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:companies,name|max:32',
            'address' => 'required|max:100',
        ]);

        $company = new Company();
        $company->fill($request->all());
        return ($company->save()) ?
            redirect('/companies')->with('status_success', 'Kompanija pridėta!') :
            redirect('/companies.create')->with('status_error', 'Komapnija nebuvo pridėta!');
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $this->validate($request, [
            'name' => 'required|unique:companies,name,' .$company->id. ',|max:32',
            'address' => 'required|max:100',
        ]);

        $company->fill($request->all());
        return ($company->save() !== 1) ?
            redirect('/companies')->with('status_success', 'Komapnija sėkmingai redaguota!') :
            redirect('/companies')->with('status_error', 'Komapnija nebuvo redaguota!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if (count($company->customers)) {
            return back()->with('status_error', 'Negalima ištrinti kompanijos, nes joje yra priskirtų klientų!');
        }
        $company->delete();
        return redirect()->route('companies.index');
    }
}
