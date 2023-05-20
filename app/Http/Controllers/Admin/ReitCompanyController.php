<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReitCompany;
use Illuminate\Http\Request;

class ReitCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reitCompanies = ReitCompany::latest()->paginate(10);

        return view('admin.reitCompanies.index', compact('reitCompanies'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reitCompanies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'status' => 'required',
        ]);

        ReitCompany::create($request->all());

        return redirect()->route('reitCompanies.index')
            ->with('success', 'ReitCompany created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReitCompany  $reitCompany
     * @return \Illuminate\Http\Response
     */
    public function show(ReitCompany $reitCompany)
    {
        return view('admin.reitCompanies.show', compact('reitCompany'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReitCompany  $reitCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(ReitCompany $reitCompany)
    {
        return view('admin.reitCompanies.edit', compact('reitCompany'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReitCompany  $reitCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReitCompany $reitCompany)
    {
        $request->validate([
            'company_name' => 'required',
            'status' => 'required',
        ]);

        $reitCompany->update($request->all());

        return redirect()->route('reitCompanies.index')
            ->with('success', 'ReitCompany updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReitCompany  $reitCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReitCompany $reitCompany)
    {
        $reitCompany->delete();

        return redirect()->route('reitCompanies.index')
            ->with('success', 'ReitCompany deleted successfully');
    }
}
