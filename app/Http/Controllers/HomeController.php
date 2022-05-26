<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\EventsPdf;
use App\Models\CompanyEvent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalComapny = Company::count();
        $totalCompanyEvent = CompanyEvent::count();
        $totalCompanyEventPdf = EventsPdf::count();
        return view('admin.dashboard.index', compact('totalComapny', 'totalCompanyEvent', 'totalCompanyEventPdf'));
    }

    public function showCompanyEvent($company, $event)
    {
        $comapny = Company::where('slug', $company)->first();

        if (!$comapny) {
            abort(404);
        }

        $event = CompanyEvent::where('slug', $event)->first();

        if (!$event) {
            abort(404);
        }

        $pdfs = EventsPdf::where('company_event_id', $event->id)->orderBy('year', 'desc')->get();
        $years  = $pdfs->pluck('year')->unique();

        return view('public.index', compact('comapny', 'event', 'pdfs', 'years'));
    }
}
