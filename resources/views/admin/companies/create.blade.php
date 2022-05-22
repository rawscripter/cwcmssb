@extends('layouts.dashboard')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('companies.store') }}" class="user">
                <div class="row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="First Name">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
