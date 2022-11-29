<?php

namespace App\Http\Controllers;

use App\Models\CompanyEvent;
use App\Models\EventsPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EventsPdfController extends Controller
{
    public function uploadPdf(Request $request)
    {
        try {
            $comapnyID = $request->company_id;
            $companyEventID = $request->company_event_id;
            $year = $request->year;

            $event  = CompanyEvent::findOrFail($companyEventID);

            // check total pdfs
            if ($event->pdfs->count() >= 10) {
                return redirect()->route('events.index')->withError('You can only upload 10 pdfs per event.');
            }

            //  upload multiple pdfs to public/pdf folder
            $pdfs = $request->file('pdfs');
            foreach ($pdfs as $pdf) {
                $fileName = time() . '-' .  $pdf->getClientOriginalName();
                // upload pdf to public path
                $pdf->move(public_path('pdf'), $fileName);
                //  save pdfs to database
                $pdfData = [
                    'company_id' => $comapnyID,
                    'year' => $year,
                    'company_event_id' => $companyEventID,
                    'file' => $fileName,
                ];
                EventsPdf::create($pdfData);
            }
            return redirect()->route('events.index')->withSuccess('Company event created successfully');
        } catch (\Exception $e) {
            return redirect()->route('events.index')->withError('Request failed.');
        }
    }
    public function eventUploadPdf($event, Request $request)
    {
        try {
            $event  = CompanyEvent::findOrFail($event);
            $year = $request->year;

            // check total pdfs
            if ($event->pdfs->count() >= 10) {
                return redirect()->route('events.index')->withError('You can only upload 10 pdfs per event.');
            }

            //  upload multiple pdfs to public/pdf folder
            $pdfs = $request->file('pdfs');
            foreach ($pdfs as $pdf) {
                $fileName = time() . '-' .  $pdf->getClientOriginalName();
                $pdf->move(public_path('pdf'), $fileName);
                //  save pdfs to database
                $pdfData = [
                    'company_id' =>  $event->company->id,
                    'year' => $year,
                    'company_event_id' => $event->id,
                    'file' => $fileName,
                ];
                EventsPdf::create($pdfData);
            }
            return redirect()->back()->withSuccess('Company event created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Request failed.');
        }
    }

    public function destroy($pdf)
    {


        try {
            $pdf = EventsPdf::find($pdf);

            $file_path = public_path('pdf') . '/' . $pdf->file;
            if (File::exists($file_path)) {
                File::delete($file_path); //for deleting only file try this
                $pdf->delete(); //for deleting record and file try both
            }
            return redirect()->back()->withSuccess('Pdf deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Request failed.');
        }
    }
}
