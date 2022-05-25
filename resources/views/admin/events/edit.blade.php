@extends('layouts.dashboard')
@section('content')
    {{-- show success or error message --}}
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Event Details</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <td style="width: 200px">Company Name</td>
                            <td style="width: 10px">:</td>
                            <td>{{ $companyEvent->company->name }}</td>
                        </tr>

                        <tr>
                            <td style="width: 200px">Registration No</td>
                            <td style="width: 10px">:</td>
                            <td>{{ $companyEvent->company->reg_no }}</td>
                        </tr>
                        <tr>
                            <td style="width: 200px">Download Page</td>
                            <td style="width: 10px">:</td>
                            <td>{{ $companyEvent->fullUrl() }}</td>
                        </tr>

                        <tr>
                            <td style="width: 200px">Added At</td>
                            <td style="width: 10px">:</td>
                            <td>{{ $companyEvent->company->created_at->format('d F, Y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Company Events</h6>
            <div class="card-toolbar">
                <div class="btn btn-sm btn-primary" data-toggle="modal" data-target="#companyCreateModal">
                    Upload PDF
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>PDF Name</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>PDF Name</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($companyEvent->pdfs as $pdf)
                            <tr>
                                <td>{{ $pdf->file }}</td>
                                <td>{{ $pdf->year }}</td>
                                <td class="d-flex align-items-center justify-content-start">
                                    <form method="POST" action="{{ route('eventPdf.destroy', $pdf->id) }}"
                                        class="d-flex align-items-center justify-content-center">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="submit" class="btn btn-sm btn-danger delete-event" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="companyCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload PDF</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="companyForm" method="post" action="{{ route('event.upload.pdf', $companyEvent->id) }}"
                        class="user" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <label>Select Year</label>
                                    <select required name="year" id="year" class="form-control">
                                        <option value="">Select Event</option>
                                        @php
                                            $years = range(date('Y') + 5, 2020);
                                        @endphp
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="pdf-input-area">
                                    <div class="form-group">
                                        <label>Select PDF</label>
                                        <input required accept=".pdf" type="file" name="pdfs[]" id="pdf"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group m-0 text-center">
                                    <button type="button" class="btn btn-info btn-sm" id="add-pdf">Add PDF</button>
                                </div>
                                <hr>
                                <div class="form-group d-flex justify-content-between">
                                    <button class="btn btn-secondary" id="recentForm" type="button"
                                        data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary create-new-company" type="submit">Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {

            let totalPdfInputs = 1;

            // on click of add-pdf button add another pdf input
            $('#add-pdf').on('click', function() {
                // max 10 pdfs can be uploaded
                if (totalPdfInputs < 10) {
                    totalPdfInputs++;
                    $('.pdf-input-area').append(`
                    <div class="form-group">
                        <label>Select PDF</label>
                        <input type="file" required accept=".pdf" name="pdfs[]" id="pdf" class="form-control">
                    </div>
                `);
                } else {
                    alert('You can upload maximum 10 PDFs');
                }
            });
            // reset recentForm
            $('#recentForm').on('click', function() {
                $('#companyForm')[0].reset();
                totalPdfInputs = 1;
                $('.pdf-input-area').html(`
                <div class="form-group">
                    <label>Select PDF</label>
                    <input type="file"  accept=".pdf" name="pdfs[]" id="pdf" class="form-control">
                </div>
            `);
            });
        });
    </script>
@endsection
