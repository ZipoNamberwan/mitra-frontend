@extends('layout.main')
@section('stylesheet')
<link rel="stylesheet" href="/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/assets/css/container.css">
<link rel="stylesheet" href="/assets/css/text.css">
@endsection
@section('container')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="ni ni-app"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ubah</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card-wrapper">
                <!-- Custom form validation -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-2">Ubah Mitra</h3>
                        <p class="mb-0"><small>*Wajib Diisi</small></p>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form method="POST" action="/profile/{{ $mitra->email }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-14 mb-3">
                                        <label class="form-control-label" for="email">E-mail* <small>Email harus
                                                menggunakan akun GMAIL</small></label>
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="validationCustom03" placeholder="email@gmail.com" value="{{ @old('email', $mitra->email) }}" disabled>

                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-14 mb-3">
                                        <label class="form-control-label" for="validationCustom03">Nama Lengkap*</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="validationCustom03" value="{{ @old('name', $mitra->name) }}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-14 mb-3">
                                        <label class="form-control-label" for="validationCustom03">Nama
                                            Panggilan</label>
                                        <input type="text" name="nickname" class="form-control @error('nickname') is-invalid @enderror" id="validationCustom03" value="{{ @old('nickname', $mitra->nickname) }}">
                                        @error('nickname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-14 mb-3">
                                        <label class="form-control-label" for="">Foto</label>
                                        <img class="img-preview img-fluid mb-3 col-sm-5 image-preview" src="@if ($mitra->photo != null) {{ asset('storage/' . $mitra->photo) }} @endif" style="display:block">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="photo" name="photo" lang="en" onchange="previewPhoto()" accept="image/*">
                                            <label class="custom-file-label" for="customFileLang" id="photolabel">Pilih
                                                Gambar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-14 mb-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="exampleDatepicker">Tanggal
                                                Lahir*</label>
                                            <input name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" placeholder="Select date" type="date" value="{{ @old('birthdate', $mitra->birthdate) }}">
                                            @error('birthdate')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-14 mb-3">
                                        <label>Jenis Kelamin*</label>
                                        <div class="custom-control custom-radio mb-3">
                                            <input name="sex" class="custom-control-input" id="sex_radio1" value="L" type="radio" {{ old('sex', $mitra->sex) == 'L' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="sex_radio1">Laki-laki</label>
                                        </div>

                                        <div class="custom-control custom-radio mb-3">
                                            <input name="sex" class="custom-control-input" id="sex_radio2" value="P" type="radio" {{ old('sex', $mitra->sex) == 'P' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="sex_radio2">Perempuan</label>
                                        </div>
                                        @error('sex')
                                        <div class="text-valid">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-14 mb-3">
                                        <label class="form-control-label">Pendidikan*</label>
                                        <select name="education" class="form-control" data-toggle="select">
                                            <option value="0" disabled selected>Pilih Pendidikan terakhir</option>
                                            @foreach ($educations as $education)
                                            <option value="{{ $education->id }}" {{ old('education', $mitra->education) == $education->id ? 'selected' : '' }}>
                                                {{ $education->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('education')
                                        <div class="text-valid">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-14 mb-3">
                                        <label class="form-control-label" for="validationCustom03">Profesi*</label>
                                        <input type="text" name="profession" class="form-control @error('profession') is-invalid @enderror" id="validationCustom03" value="{{ @old('profession', $mitra->profession) }}">
                                        @error('profession')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-14 mb-3">
                                        <label class="form-control-label" for="validationCustom03">Alamat*</label>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="validationCustom03" value="{{ @old('address', $mitra->address) }}">
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-14">
                                        <label class="form-control-label">Kecamatan*</label>
                                        <select id="subdistrict" name="subdistrict" class="form-control" data-toggle="select" name="subdistrict" required>
                                            <option value="0" disabled selected> -- Pilih Kecamatan -- </option>
                                            @foreach ($subdistricts as $subdistrict)
                                            <option value="{{ $subdistrict->id }}" {{ old('subdistrict', $mitra->subdistrictdetail->id) == $subdistrict->id ? 'selected' : '' }}>
                                                {{ $subdistrict->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('subdistrict')
                                    <div class="text-valid">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="col-md-14 mt-3">
                                        <label class="form-control-label">Desa*</label>
                                        <select id="village" name="village" class="form-control" data-toggle="select" name="village">
                                        </select>
                                    </div>
                                    @error('village')
                                    <div class="text-valid">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <button type="submit" class="btn btn-primary mt-3" value="Simpan">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('optionaljs')
<script src="/assets/vendor/select2/dist/js/select2.min.js"></script>
<script src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
    function previewPhoto() {
        var photolabel = document.getElementById('photolabel');
        const photo = document.querySelector('#photo');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(photo.files[0]);
        photolabel.innerText = photo.files[0].name;

        oFReader.onload = function(OFREvent) {
            imgPreview.src = OFREvent.target.result;
        }

    }
</script>

<script>
    $(document).ready(function() {
        $('#subdistrict').on('change', function() {
            loadVillage('0');
        });
    });

    function loadVillage(selectedvillage) {
        let id = $('#subdistrict').val();
        $('#village').empty();
        $('#village').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
            type: 'GET',
            url: '/mitras/village/' + id,
            success: function(response) {
                var response = JSON.parse(response);
                $('#village').empty();
                $('#village').append(`<option value="0" disabled selected>Pilih Desa</option>`);
                response.forEach(element => {
                    if (selectedvillage == String(element.id)) {
                        $('#village').append('<option value=\" ' + element.id + ' \" selected>' +
                            element.name + '</option>');
                    } else {
                        $('#village').append('<option value=\" ' + element.id + ' \">' + element
                            .name + '</option>');
                    }
                });
            }
        });
    }
</script>

@if (old('subdistrict', $mitra->subdistrictdetail->id))
<script>
    loadVillage("{{ old('village', $mitra->villagedetail->id, '0') }}");
</script>
@endif

@endsection