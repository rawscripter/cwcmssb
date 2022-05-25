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
            <h6 class="m-0 font-weight-bold text-primary">Company Events</h6>
            <div class="card-toolbar">
                <div class="btn btn-sm btn-primary" data-toggle="modal" data-target="#companyUpdatwModal">
                    Update Company
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <td style="width: 200px">Company Name</td>
                            <td style="width: 10px">:</td>
                            <td>{{ $company->name }}</td>
                        </tr>

                        <tr>
                            <td style="width: 200px">Company Slug</td>
                            <td style="width: 10px">:</td>
                            <td>{{ $company->slug }}</td>
                        </tr>

                        <tr>
                            <td style="width: 200px">Registration No</td>
                            <td style="width: 10px">:</td>
                            <td>{{ $company->reg_no }}</td>
                        </tr>

                        <tr>
                            <td style="width: 200px">Added At</td>
                            <td style="width: 10px">:</td>
                            <td>{{ $company->created_at->format('d F, Y') }}</td>
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
                <div class="btn btn-sm btn-primary" data-toggle="modal" data-target="#eventCreateModal">
                    Add New Event
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Slug</th>
                            <th>Url</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Url</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($company->events as $event)
                            <tr>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->slug }}</td>
                                <td>{{ config('app.url') }}/{{ $company->slug }}/{{ $event->slug }}</td>
                                <td class="d-flex align-items-center justify-content-start">
                                    <form method="POST" action="{{ route('events.destroy', $event->id) }}"
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



    <div class="modal fade" id="companyUpdatwModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Company Information</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="companyForm" method="post" action="{{ route('companies.update', $company->id) }}"
                        class="user">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" required type="text" class="form-control form-control-user"
                                        id="company_name" value="{{ $company->name }}" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input name="slug" value="{{ $company->slug }}" required type="text"
                                        class="form-control form-control-user" id="slug" placeholder="Company Slug">
                                </div>
                                <div class="form-group">
                                    <label for="">Registration Number</label>
                                    <input name="reg_no" required value="{{ $company->reg_no }}" type="text"
                                        class="form-control form-control-user" id="registration_number"
                                        placeholder="Registration Number ">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary create-new-company" type="button">Update</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="eventCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Event</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="eventForm" method="post" action="{{ route('events.store') }}" class="user">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" value="{{ $company->id }}" name="company_id">
                                <div class="form-group">
                                    <label>Event Name</label>
                                    <input name="name" required type="text" class="form-control form-control-user"
                                        id="event_name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input name="slug" required type="text" class="form-control form-control-user"
                                        id="event_slug" placeholder="Company Slug">
                                </div>
                                <div class="form-group">
                                    <label for="">Page Description</label>
                                    <textarea name="" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary create-new-event" type="button">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            // check name
            $('#company_name').on('keyup', function() {
                var name = $(this).val();
                var slug = name.toLowerCase().trim().replace(/\s+/g, '-');
                $('#slug').val(slug);
            }); // check name
            $('#event_name').on('keyup', function() {
                var name = $(this).val();
                var slug = name.toLowerCase().trim().replace(/\s+/g, '-');
                $('#event_slug').val(slug);
            });
            //create-new-company
            $(document).on('click', '.create-new-company', function() {
                //validate company form
                var company_name = $('#company_name').val();
                var slug = $('#slug').val();
                var registration_number = $('#registration_number').val();

                if (company_name == '') {
                    // add invlaid class
                    $('#company_name').addClass('is-invalid');
                    return false;
                } else {
                    $('#company_name').removeClass('is-invalid');
                }
                if (slug == '') {
                    // add invlaid class
                    $('#slug').addClass('is-invalid');
                    return false;
                } else {
                    $('#slug').removeClass('is-invalid');
                }
                if (registration_number == '') {
                    // add invlaid class
                    $('#registration_number').addClass('is-invalid');
                    return false;
                } else {
                    $('#registration_number').removeClass('is-invalid');
                }
                $("#companyForm").submit();
            });
            //create-new-company
            $(document).on('click', '.create-new-event', function() {
                //validate company form
                var event_name = $('#event_name').val();
                var event_slug = $('#event_slug').val();

                if (event_name == '') {
                    // add invlaid class
                    $('#event_name').addClass('is-invalid');
                    return false;
                } else {
                    $('#event_name').removeClass('is-invalid');
                }
                if (event_slug == '') {
                    // add invlaid class
                    $('#event_slug').addClass('is-invalid');
                    return false;
                } else {
                    $('#event_slug').removeClass('is-invalid');
                }

                $("#eventForm").submit();
            });

            $('.delete-event').click(function(e) {
                e.preventDefault() // Don't post the form, unless confirmed
                // Post the form
                if (confirm('Are you sure you wannt to delete this?')) {
                    $(e.target).closest('form').submit() // Post the surrounding form
                }
            });
        });
    </script>
@endsection
