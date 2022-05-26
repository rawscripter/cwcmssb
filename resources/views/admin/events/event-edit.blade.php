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
        </div>
        <div class="card-body">
            <form id="eventForm" method="post" action="{{ route('events.update', $companyEvent->id) }}"
                class="user">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Event Name</label>
                            <input name="name" value="{{ $companyEvent->name }}" required type="text"
                                class="form-control form-control-user" id="event_name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input name="slug" value="{{ $companyEvent->slug }}" required type="text"
                                class="form-control form-control-user" id="event_slug" placeholder="Company Slug">
                        </div>
                        <div class="form-group">
                            <label for="">Page Description</label>
                            <textarea id="myeditorinstance" name="description" class="form-control" id="" cols="30"
                                rows="10">{{ $companyEvent->description }}</textarea>
                        </div>

                        <div class="form-group">
                            {{-- submit --}}
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Update Event
                            </button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {

            $('#event_name').on('keyup', function() {
                var name = $(this).val();
                var slug = name.toLowerCase().trim().replace(/\s+/g, '-');
                $('#event_slug').val(slug);
            });

        });
    </script>
@endsection
