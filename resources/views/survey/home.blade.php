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
                            <li class="breadcrumb-item active" aria-current="page"> Home</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Rata-Rata Nilai Survey</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$mitra->avgrating()}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-circle-08"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="mb-0">Status Pendaftaran</h3>
                        </div>
                    </div>
                </div>
                <!-- Body Table -->
                <div class="table-responsive py-4">
                    <table class="table" id="datatable-id" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Suvey</th>
                                <th>No HP yang Didaftarkan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <!-- card-header -->
                <div class="card-header">
                    <div class="row-6">
                        <h3 class="mb-0">Pengalaman Survey</h3>
                    </div>
                </div>
                <!-- Body Table -->
                <div class="table-responsive py-4">
                    <table class="table" id="datatable-idsurvey" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Survey</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
<script src="/assets/vendor/momentjs/moment-with-locales.js"></script>

<script>
    var table = $('#datatable-id').DataTable({
        "responsive": true,
        "order": [],
        "serverSide": true,
        "processing": true,
        "ajax": {
            "url": '/survey-list-data',
            "type": 'GET'
        },
        "columns": [{
                "responsivePriority": 8,
                "width": "2,5%",
                "orderable": false,
                "data": "index",
            },
            {
                "responsivePriority": 1,
                "width": "2,5%",
                "data": "name",
            },
            {
                "responsivePriority": 1,
                "width": "2,5%",
                "data": "phoneregistered",
            },
            {
                "responsivePriority": 1,
                "width": "2,5%",
                "data": "status_id",
                "render": function(data, type, row) {
                    if (type == 'display') {
                        return '<span class="badge badge-' + row.status_color + '">' + data + '</span>';
                    }
                    return data;
                }
            }
        ],
        "language": {
            'paginate': {
                'previous': '<i class="fas fa-angle-left"></i>',
                'next': '<i class="fas fa-angle-right"></i>'
            }
        }
    });
</script>

<script>
    var table = $('#datatable-idsurvey').DataTable({
        "responsive": true,
        "order": [],
        "serverSide": true,
        "processing": true,
        "ajax": {
            "url": '/survey-exp-list-data',
            "type": 'GET'
        },
        "columns": [{
                "responsivePriority": 8,
                "width": "2,5%",
                "orderable": false,
                "data": "index",
            },
            {
                "responsivePriority": 1,
                "width": "2,5%",
                "data": "name",
            },
            {
                "responsivePriority": 1,
                "width": "2,5%",
                "data": "start_date",
                "render": function(data, type, row) {
                    var unixTimestamp = new Date(data).getTime() / 1000 - (new Date).getTimezoneOffset() * 60;
                    if (type === 'display' || type === 'filter') {
                        return moment.unix(unixTimestamp).locale('id').format('ll');
                    }
                    return unixTimestamp;
                }
            },
            {
                "responsivePriority": 1,
                "width": "2,5%",
                "data": "end_date",
                "render": function(data, type, row) {
                    var unixTimestamp = new Date(data).getTime() / 1000 - (new Date).getTimezoneOffset() * 60;
                    if (type === 'display' || type === 'filter') {
                        return moment.unix(unixTimestamp).locale('id').format('ll');
                    }
                    return unixTimestamp;
                }
            }
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