<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ReitsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Reit;
use App\Models\ReitCompany;
use Illuminate\Http\Request;
use App\Models\LatLng;
use Exception;

class ReitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reits = Reit::when($request->has("s"), function ($q) use ($request) {
            return $q->where("property", "like", "%" . $request->get("s") . "%")
            ->orWhere("address", "like", "%" . $request->get("s") . "%")
            ->orWhere("city", "like", "%" . $request->get("s") . "%");
        })->latest()->with('reit_companies')->paginate(10);

        return view('admin.reits.index', compact('reits'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reitCompany = ReitCompany::orderBy('company_name')->get();
        return view('admin.reits.create', compact('reitCompany'));
    }
    public function createsingle()
    {
        $reitCompany = ReitCompany::orderBy('company_name')->get();
        return view('admin.reits.createsingle', compact('reitCompany'));
    }
    public function storesingle(Request $request)
    {
        $request->validate([
            'reit_company_id' => 'required',
            'property' => 'required',
            'address' => 'required',
        ], [
            'reit_company_id.required' => 'Please choose Company.',
            'property.required' => 'Please enter Propery Name',
            'address.required' => 'Please enter Address.',
        ]);
        $count = Reit::where('reit_company_id', '=', $request->get('reit_company_id'))->where('address', '=', $request->get('address'))->count();
        if ($count > 0) {
            return redirect()->back()
                ->with('error', 'Address is already exist.');
        }
        $prepAddr = str_replace(' ', '+', $request->get('address') . " " . $request->get('address_2') . "" . $request->get('city') . "" . $request->get('state'));
        $latlng = LatLng::file_get_contents($prepAddr);
        if ($latlng) {
            $lat = $latlng['lat'];
            $lng = $latlng['lng'];
            $request->merge(['lat' => $lat]);
            $request->merge(['lng' => $lng]);
        }
        Reit::create($request->all());

        return redirect()->route('reits.index')
            ->with('success', 'REIT created successfully.');
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
            'reit_company_id' => 'required',
            'reits_import_file' => 'required',
        ]);
        try {
            $poi_company_id = $request->get('reit_company_id');
        
            Excel::import(new ReitsImport($poi_company_id), $request->file('reits_import_file'));
            return redirect()->route('reits.index')
                ->with('success', 'REITs sheet imported successfully.');
        } catch (Exception $ex) {

            return redirect()->route('reits.create')->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reit  $reit
     * @return \Illuminate\Http\Response
     */
    public function show(Reit $reit)
    {
        return view('admin.reits.show', compact('reit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reit  $reit
     * @return \Illuminate\Http\Response
     */
    public function edit(Reit $reit)
    {
        $reitCompany = ReitCompany::orderBy('company_name')->get();
        return view('admin.reits.edit', compact('reitCompany', 'reit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reit  $reit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reit $reit)
    {
        $request->validate([
            'reit_company_id' => 'required',
            'address' => 'required',
        ]);
        $reit->updated_at  = date('Y-m-d G:i:s');
        $prepAddr = str_replace(' ', '+', $request->get('address') . " " . $request->get('address_2') . "" . $request->get('city') . "" . $request->get('state'));
        $latlng = LatLng::file_get_contents($prepAddr);

        if ($latlng) {
            $lat = $latlng['lat'];
            $lng = $latlng['lng'];
            $request->merge(['lat' => $lat]);
            $request->merge(['lng' => $lng]);
        }

        $reit->update($request->all());

        return redirect()->route('reits.index')
            ->with('success', 'REIT updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reit  $reit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reit $reit)
    {
        $reit->delete();

        return redirect()->route('reits.index')
            ->with('success', 'REIT deleted successfully');
    }
}
