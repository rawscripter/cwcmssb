<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\EventsPdf;
use App\Models\CompanyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('showCompanyEvent');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalComapny = Company::count();
        $totalCompanyEvent = CompanyEvent::whereHas('company')->count();
        $totalCompanyEventPdf = EventsPdf::whereHas('company')->count();
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
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        $data['name'] = $request->name;
        $data['email'] = $request->email;

        if ($request->password) {
            if ($request->password != $request->password_confirmation) {
                return redirect()->back()->with('error', 'Password and Confirm Password does not match');
            } else {
                $data['password'] = Hash::make($request->password);
            }
        }
        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
