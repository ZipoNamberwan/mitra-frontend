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

<h6 class="heading-small text-muted mb-4">Pengalaman Survei</h6>
    <div class="pl-lg-4">
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

@endsection
@section('optionaljs')

@endsection