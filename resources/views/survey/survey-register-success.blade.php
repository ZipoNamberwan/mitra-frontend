@extends('layout/main')
@section('stylesheet')

@endsection
@section('container')

<div class="card mx-6 my-3">
    <div class="card-body text-center">
        <i class="fa fa-check-circle fa-10x text-success mb-4"></i>
        <h3 class="card-title">Sukses</h3>
        <p class="card-text">Anda telah Terdaftar di Kegiatan {{$survey->name}}</p>
        <a href="/" class="btn btn-primary">Home</a>
    </div>
</div>
@endsection
@section('optionaljs')

@endsection