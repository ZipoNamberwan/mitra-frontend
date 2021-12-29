@extends('layout/main')
@section('stylesheet')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- <link rel="stylesheet" href="/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css"> -->
<link rel="stylesheet" href="/assets/vendor/datatables2/datatables.min.css" />
<link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.min.css" />

@endsection

@section('container')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <!-- Table -->
    @if (session('success-edit') || session('success-create'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Sukses! </strong>{{ session('success-create') }} {{ session('success-edit') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    @if (session('success-delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Sukses! </strong>{{ session('success-delete') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card card-profile">
                <img src="../../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="{{ $mitra->photo != null ? asset('storage/' . $mitra->photo) : asset('storage/images/profile.png') }}" class="rounded-circle image-profile">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                        <a href="/profile/{{ $mitra->email }}/edit" class="btn btn-sm btn-success mr-4">Edit</a>
                    </div>
                </div>
                <div class="text-center">
                    <h5 class="h1">
                        {{ $mitra->name }}, <span class="font-weight-light" id="age"></span>
                    </h5>
                    <p>{{ $mitra->address }}, {{ $mitra->villagedetail->name }}, {{ $mitra->subdistrictdetail->name }}
                    </p>
                    <div class="display-4 mt-0"><i class="fas fa-star text-yellow"></i> {{ $mitra->avgrating() }}</div>
                </div>

                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Informasi Umum</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Email</label>
                                    <p>{{ $mitra->email }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Kode Petugas</label>
                                    <p>3513{{ $mitra->code }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Nama Panggilan</label>
                                    <p>{{ $mitra->nickname }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-last-name">Jenis Kelamin</label>
                                    <p>{{ $mitra->sex }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">No HP</label>
                                    <p>
                                        {{$mitra->phonenumbers->implode('phone', '; ')}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4" />
                    <!-- Address -->
                    <h6 class="heading-small text-muted mb-4">Background</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-address">Pendidikan</label>
                                    <p>{{ $mitra->educationdetail->name }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Pekerjaan</label>
                                    <p>{{ $mitra->profession }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4" />
                    <!-- Address -->
                    <h6 class="heading-small text-muted mb-4">Pengalaman Survei</h6>
                    <div class="pl-lg-4">
                        @if (count($mitra->surveys) > 0)
                        <p>
                            @foreach ($mitra->surveys as $survey)
                            @if ($survey->pivot->status_id == 2)
                            {{ $survey->name }},
                            @endif
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
</div>

@endsection
@section('optionaljs')
<script src="/assets/vendor/datatables2/datatables.min.js"></script>
<script src="/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>
<script src="/assets/vendor/momentjs/moment-with-locales.js"></script>
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>

<script>
    function getAge(dateString) {
        var today = new Date();
        var birthDate = new Date(dateString);
        console.log(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }

    document.getElementById("age").innerHTML = getAge("{{ $mitra->birthdate }}");
</script>
@endsection