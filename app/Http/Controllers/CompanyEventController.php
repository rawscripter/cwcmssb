<?php

namespace App\Http\Controllers;

use App\Models\CompanyEvent;
use App\Models\Company;
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
        $companies = Company::all();
        $query = CompanyEvent::query();
        $query->whereHas('pdfs', function ($query) {
            $query->where('file', '!=', null);
        });

        $eventsWithPdf = $query->orderBy('name')->get();

        return view('admin.events.index', compact('companies', 'eventsWithPdf'));
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
            // $data = $request->validate([
            //     'company_id' => 'required',
            //     'name' => 'required',
            //     'slug' => 'required',
            //     'description' => 'required',
            // ]);

            $data  = $request->all();
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
        return view('admin.events.edit', compact('companyEvent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyEvent  $companyEvent
     * @return \Illuminate\Http\Response
     */
    public function edit($companyEvent)
    {
        $companyEvent = CompanyEvent::find($companyEvent);
        return view('admin.events.event-edit', compact('companyEvent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyEvent  $companyEvent
     * @return \Illuminate\Http\Response
     */
    public function update($companyEvent, Request $request)
    {
        try {
            $companyEvent = CompanyEvent::find($companyEvent);
            $data = $request->all();
            $companyEvent->update($data);

            return redirect()->route('companies.edit', $companyEvent->company_id)->withSuccess('Company event updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('companies.edit', $companyEvent->company_id)->withError('Request failed.');
        }
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
