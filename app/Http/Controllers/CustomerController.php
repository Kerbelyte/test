<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        if (isset($request->company_id) && $request->company_id != 0) {
            $customers = \App\Models\Customer::where('company_id', $request->company_id)->orderBy('name')->get();
        } else {
            $customers = \App\Models\Customer::orderBy('surname')->get();
        }
        $companies = \App\Models\Company::orderBy('name')->get();
        return view('customers.index', ['customers' => $customers, 'companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = \App\Models\Company::orderBy('name')->get();
        return view('customers.create', ['companies' => $companies]); 
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
            'name' => 'required|max:32',
            'surname' => 'required|unique:customers,surname|max:32',
            'phone' => 'required|regex:/(\+)[0-9]{11}$/',
            'email' => 'required|unique:customers,email|max:64',
            'comment' => 'required|max:255'
        ]);

        $customer = new Customer();
        $customer->fill($request->all());
        if($customer->company_id == 0) {
            $customer->company_id = null;
        }
        return ($customer->save()) ? redirect('/customers')->with('status_success', 'Klientas pridėtas!') :
            redirect('/customers.create')->with('status_error', 'Klientas nebuvo pridėtas!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $companies = \App\Models\Company::orderBy('name')->get();
        return view('customers.edit', ['customer' => $customer, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name' => 'required|max:32',
            'surname' => 'required|unique:customers,surname,' . $customer->id . ',id|max:32',
            'phone' => 'required|regex:/(\+)[0-9]{11}$/|max:24',
            'email' => 'required|unique:customers,email,' . $customer->id . ',id|max:64|',
            'comment' => 'required|max:255'
        ]);
       
        
        $customer->fill($request->all());
        if($customer->company_id == 0) {
            $customer->company_id = null;
        }
        return ($customer->save()) ?
            redirect('/customers')->with('status_success', 'Klientas sėkmingai redaguotas!') :
            redirect('/customers')->with('status_error', 'Klientas nebuvo redaguotas!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
