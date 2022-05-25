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
    public function index()
    {
        $companies = Company::orderBy('name')->get();
        return view('admin.companies.index', compact('companies'));
        // return view('admin.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'reg_no' => 'required',
                'slug' => 'required',
            ]);
            Company::create($data);
            return redirect()->route('companies.index')->withSuccess('Company created successfully');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->withError('Request failed.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'reg_no' => 'required',
                'slug' => 'required',
            ]);
            $company->update($data);
            return redirect()->route('companies.edit', $company->id)->withSuccess('Company updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('companies.edit', $company->id)->withError('Request failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        try {
            $company->delete();
            return redirect()->route('companies.index')->withSuccess('Company deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->withError('Request failed.');
        }
    }

    public function events(Company $company)
    {
        $events = $company->events;
        return response()->json($events);
    }
}
