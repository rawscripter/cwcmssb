<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;0,900;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <header>
        <div class=" bg-theme text-dark top-header d-flex align-items-center justify-content-between">
            <div>
                <h2><strong>{{ $comapny->name }}</strong></h2>
                <h5 class="m-0">{{ $comapny->reg_no }}</h5>
            </div>
            <div>
                <a href="/" class="m-0"> <i class="las la-headset"></i> Contact Us</a>
            </div>
        </div>
    </header>

    <section>
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar bg-light">
                    <p class="mb-2">Year:</p>
                    <ul class="years list-style-none m-0 p-0">
                        @foreach ($years as $year)
                            <li data-year={{ $year }}
                                class="year-item {{ $loop->index == 0 ? 'active' : '' }}">{{ $year }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <div class="main-area">
                    <div>
                        {!! $event->description !!}
                    </div>

                    <div class="download-area mt-5">
                        @foreach ($pdfs as $pdf)
                            <div
                                class=" {{ $pdf->year == $years[0] ? 'show' : 'hide' }} year-pdf-item year-{{ $pdf->year }}">
                                <div class="mb-3 d-flex justify-content-start text-white align-items-center">
                                    <a download="{{ $pdf->file }}" href="/storage/pdf/{{ $pdf->file }}"
                                        class="btn btn-danger r-0 mr-2">
                                        DOWNLOAD PDF
                                    </a>
                                    @php
                                        $fineName = explode('.', $pdf->file);
                                        if ($fineName[0]) {
                                            $file = explode('-', $fineName[0]);
                                            echo '<p class="text-danger r-0 m-0">' . $file[1] . '</p>';
                                        }
                                    @endphp
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script src={{ asset('assets/vendor/jquery/jquery.min.js') }}></script>

<script>
    $(document).ready(function() {
        $('.year-item').click(function() {
            // alert('ok')
            $('.year-item').removeClass('active');
            $(this).addClass('active');
            var year = $(this).data('year');
            $('.download-area .year-pdf-item').addClass('hide');
            $('.download-area .year-' + year).removeClass('hide');
        });
    });
</script>

</html>
