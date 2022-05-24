<?php

namespace App\Http\Controllers;

use App\Models\CompanyEvent;
use Illuminate\Http\Request;

class CompanyEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'company_id' => 'required',
                'name' => 'required',
                'slug' => 'required',
            ]);
            CompanyEvent::create($data);
            return redirect()->route('companies.edit', $request->company_id)->withSuccess('Company event created successfully');
        } catch (\Exception $e) {
            return redirect()->route('companies.edit', $request->company_id)->withError('Request failed.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyEvent  $companyEvent
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyEvent $companyEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyEvent  $companyEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyEvent $companyEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyEvent  $companyEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyEvent $companyEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyEvent  $companyEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy($event)
    {
        try {
            $companyEvent = CompanyEvent::find($event);
            $comapnyID =   $companyEvent->company_id;
            $companyEvent->delete();
            return redirect()->route('companies.edit', $comapnyID)->withSuccess('Company event deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('companies.edit', $comapnyID)->withError('Request failed.');
        }
    }
}
