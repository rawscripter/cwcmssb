@extends('layouts.dashboard')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <a href="{{ route('companies.index') }}">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Companies</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalComapny }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-home fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <a href="{{ route('companies.index') }}">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Events</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCompanyEvent }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-pdf fa-2x  text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <a href="/events">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total PDFS</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCompanyEventPdf }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-pdf fa-2x  text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


    </div>
@endsection
