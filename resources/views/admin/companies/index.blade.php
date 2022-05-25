@extends('layouts.dashboard')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Companies</h6>
            <div class="card-toolbar">
                <div class="btn btn-sm btn-primary" data-toggle="modal" data-target="#companyCreateModal">
                    Add Company
                </div>
            </div>
        </div>
        <div class="card-body">

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


            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Registration No</th>
                            <th>Total Events</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Registration No</th>
                            <th>Total Events</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->slug }}</td>
                                <td>{{ $company->reg_no }}</td>
                                <td>{{ $company->events->count() }}</td>
                                <td class="d-flex align-items-center justify-content-start">
                                    <a href="{{ route('companies.edit', $company->id) }}"
                                        class="btn btn-sm btn-primary mr-2">Details</a>
                                    <form method="POST" action="{{ route('companies.destroy', $company->id) }}"
                                        class="d-flex align-items-center justify-content-center">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="submit" class="btn btn-sm btn-danger delete-user" value="Delete">
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
                    <h5 class="modal-title" id="exampleModalLabel">Add New Company</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="companyForm" method="post" action="{{ route('companies.store') }}" class="user">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" required type="text" class="form-control form-control-user"
                                        id="company_name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input name="slug" required type="text" class="form-control form-control-user" id="slug"
                                        placeholder="Company Slug">
                                </div>
                                <div class="form-group">
                                    <label for="">Registration Number</label>
                                    <input name="reg_no" required type="text" class="form-control form-control-user"
                                        id="registration_number" placeholder="Registration Number ">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary create-new-company" type="button">Create</button>
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
            })
            $('.delete-user').click(function(e) {
                e.preventDefault() // Don't post the form, unless confirmed
                // Post the form
                if (confirm('Are you sure you wannt to delete this?')) {
                    $(e.target).closest('form').submit() // Post the surrounding form
                }
            });
        });
    </script>
@endsection
