@extends('layouts.dashboard')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Events PDFS</h6>
            <div class="card-toolbar">
                <div class="btn btn-sm btn-primary" data-toggle="modal" data-target="#companyCreateModal">
                    Upload PDF
                </div>
            </div>
        </div>
        <div class="card-body">

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


            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Event Name</th>
                            <th>Url</th>
                            <th>Total PDFS</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($eventsWithPdf)
                            @foreach ($eventsWithPdf as $event)
                                <tr>
                                    <td>{{ $event->company->name }}</td>
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $event->fullUrl() }}</td>
                                    <td>{{ $event->pdfs->count() }}</td>
                                    <td class="d-flex align-items-center justify-content-start">
                                        <a href="{{ route('events.pdfs', $event->id) }}"
                                            class="btn btn-sm btn-primary mr-2">Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Company Name</th>
                            <th>Event Name</th>
                            <th>Url</th>
                            <th>Total PDFS</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
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
                    <form id="companyForm" method="post" action="{{ route('upload.pdf') }}" class="user"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Select Company</label>
                                    <select required name="company_id" id="company_id" class="form-control">
                                        <option value="">Select Company</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Select Event</label>
                                    <select required name="company_event_id" id="company_event_id" class="form-control">
                                        <option value="">Select Event</option>
                                    </select>
                                </div>
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
            // on change of company_id send ajax request to get the slug
            $('#company_id').on('change', function() {
                var company_id = $(this).val();

                $.get(`/company/${company_id}/events`, function(data, status) {
                    $('#company_event_id').html('');
                    $('#company_event_id').append('<option value="">Select Event</option>');
                    $.each(data, function(index, value) {
                        $('#company_event_id').append(
                            `<option value="${value.id}">${value.name}</option>`);
                    });
                });
            });

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
