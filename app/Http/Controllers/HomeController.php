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
}
