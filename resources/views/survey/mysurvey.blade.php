@extends('layout/main')
@section('stylesheet')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <link rel="stylesheet" href="/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css"> -->
    <link rel="stylesheet" href="/assets/vendor/datatables2/datatables.min.css" />
    <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.min.css" />
    <link rel="stylesheet" href="/assets/vendor/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
@endsection

@section('container')

    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="ni ni-app"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Mysurvey</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->

    <div class="container-fluid mt--6">
        <!-- Table -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="mb-0 mt-2">Pengalaman Survei</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12" id="row-table">
                                <div class="col-6 mb-0">
                                    @if (count($mitra->surveys) > 0)
                                        <p>
                                            @foreach ($mitra->surveys as $survey)
                                                {{ $survey->name }},
                                            @endforeach
                                        </p>
                                    @else
                                        <p>-</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h3 class="mb-0 mt-2">Survei saat ini</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12" id="row-table">
                                @if (count($mitra->surveys) > 0)
                                    @foreach ($mitra = $currentsurveys as $survey)

                                        {{ $survey->name }}

                                    @endforeach
                                @else
                                    <p>-</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('optionaljs')
    <script src="/assets/vendor/datatables2/datatables.min.js"></script>
    <script src="/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>
    <script src="/assets/vendor/momentjs/moment-with-locales.js"></script>
    <script src="/assets/vendor/select2/dist/js/select2.min.js"></script>
    <script src="/assets/vendor/chartist/chartist.min.js"></script>
    <script src="/assets/vendor/momentjs/moment-with-locales.js"></script>

    <script>
        var table = $('#datatable-id').DataTable({
            "order": [],
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": '/mysurvey-data',
                "type": 'GET',
            },
            "select": {
                "style": 'multi',
            },
            "columns": [{
                    "responsivePriority": 8,
                    "width": "2.5%",
                    "orderable": false,
                    "data": "index",
                },
                {
                    "responsivePriority": 1,
                    "width": "12%",
                    "data": "survey_id",
                },
                
            ],
    
            "language": {
                'paginate': {
                    'previous': '<i class="fas fa-angle-left"></i>',
                    'next': '<i class="fas fa-angle-right"></i>'
                }
            }
        });
    </script>

@endsection
