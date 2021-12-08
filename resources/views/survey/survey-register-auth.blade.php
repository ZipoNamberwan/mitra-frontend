@extends('layout/main')
@section('stylesheet')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/css/stepper.css">
    <link rel="stylesheet" href="/assets/vendor/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/assets/css/container.css">
    <link rel="stylesheet" href="/assets/css/text.css">
@endsection

@section('container')


    <!-- MultiStep Form -->
    <div class="container-fluid" id="grad1">
        <div class="row justify-content-center mt-0">
            <div class="col-12 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2><strong>Update Data Mitra</strong></h2>
                    <p>Silahkan periksa kembali kesesuaian data mitra</p>
                    <div class="row">
                        <div class="col-md-12 mx-0">

                            <form id="msform" action="/survey-register/{{ $survey->id }}" method="POST"
                                enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <!-- progressbar -->
                                <ul id="progressbar" class="col-mb-6">
                                    <li class="active" id="account"><strong>Data Mitra</strong></li>
                                    <li id="personal"><strong>Nomor Handphone</strong></li>
                                    <li id="confirm"><strong>Selesai</strong></li>
                                </ul> <!-- fieldsets -->
                                <fieldset>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col">
                                                <div class="card-wrapper">
                                                    <!-- Custom form validation -->
                                                    <div class="card">
                                                        <!-- Card body -->
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6">

                                                                    <div class="col-md-14 mb-3">
                                                                        <label class="form-control-label"
                                                                            for="validationCustom03">Nama Lengkap*</label>
                                                                        <input type="text" name="name"
                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                            id="validationCustom03"
                                                                            value="{{ @old('name', $mitra->name) }}">
                                                                        @error('name')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-14 mb-3">
                                                                        <label class="form-control-label"
                                                                            for="validationCustom03">Nama Panggilan</label>
                                                                        <input type="text" name="nickname"
                                                                            class="form-control @error('nickname') is-invalid @enderror"
                                                                            id="validationCustom03"
                                                                            value="{{ @old('nickname', $mitra->nickname) }}">
                                                                        @error('nickname')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-14 mb-3">
                                                                        <label class="form-control-label"
                                                                            for="">Foto</label>
                                                                        <img class="img-preview img-fluid mb-3 col-sm-5 image-preview"
                                                                            src="@if ($mitra->photo != null) {{ asset('storage/' . $mitra->photo) }} @endif"
                                                                            style="display:block">
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input"
                                                                                id="photo" name="photo" lang="en"
                                                                                onchange="previewPhoto()" accept="image/*">
                                                                            <label class="custom-file-label"
                                                                                for="customFileLang" id="photolabel">Pilih
                                                                                Gambar</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-14 mb-3">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label"
                                                                                for="exampleDatepicker">Tanggal
                                                                                Lahir*</label>
                                                                            <input name="birthdate"
                                                                                class="form-control @error('birthdate') is-invalid @enderror"
                                                                                placeholder="Select date" type="date"
                                                                                value="{{ @old('birthdate', $mitra->birthdate) }}">
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
                                                                            <input name="sex" class="custom-control-input"
                                                                                id="sex_radio1" value="L" type="radio"
                                                                                {{ old('sex', $mitra->sex) == 'L' ? 'checked' : '' }}>
                                                                            <label class="custom-control-label"
                                                                                for="sex_radio1">Laki-laki</label>
                                                                        </div>

                                                                        <div class="custom-control custom-radio mb-3">
                                                                            <input name="sex" class="custom-control-input"
                                                                                id="sex_radio2" value="P" type="radio"
                                                                                {{ old('sex', $mitra->sex) == 'P' ? 'checked' : '' }}>
                                                                            <label class="custom-control-label"
                                                                                for="sex_radio2">Perempuan</label>
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
                                                                        <label
                                                                            class="form-control-label">Pendidikan*</label>
                                                                        <select name="education" class="form-control"
                                                                            data-toggle="select">
                                                                            <option value="0" disabled selected>Pilih
                                                                                Pendidikan terakhir</option>
                                                                            @foreach ($educations as $education)
                                                                                <option value="{{ $education->id }}"
                                                                                    {{ old('education', $mitra->education) == $education->id ? 'selected' : '' }}>
                                                                                    {{ $education->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('education')
                                                                            <div class="text-valid">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-14 mb-3">
                                                                        <label class="form-control-label"
                                                                            for="validationCustom03">Profesi*</label>
                                                                        <input type="text" name="profession"
                                                                            class="form-control @error('profession') is-invalid @enderror"
                                                                            id="validationCustom03"
                                                                            value="{{ @old('profession', $mitra->profession) }}">
                                                                        @error('profession')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-14 mb-3">
                                                                        <label class="form-control-label"
                                                                            for="validationCustom03">Alamat*</label>
                                                                        <input type="text" name="address"
                                                                            class="form-control @error('address') is-invalid @enderror"
                                                                            id="validationCustom03"
                                                                            value="{{ @old('address', $mitra->address) }}">
                                                                        @error('address')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-14">
                                                                        <label class="form-control-label">Kecamatan*</label>
                                                                        <select id="subdistrict" name="subdistrict"
                                                                            class="form-control" data-toggle="select"
                                                                            name="subdistrict" required>
                                                                            <option value="0" disabled selected> -- Pilih
                                                                                Kecamatan -- </option>
                                                                            @foreach ($subdistricts as $subdistrict)
                                                                                <option value="{{ $subdistrict->id }}"
                                                                                    {{ old('subdistrict', $mitra->subdistrictdetail->id) == $subdistrict->id ? 'selected' : '' }}>
                                                                                    {{ $subdistrict->name }}</option>
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
                                                                        <select id="village" name="village"
                                                                            class="form-control" data-toggle="select"
                                                                            name="village">
                                                                        </select>
                                                                    </div>
                                                                    @error('village')
                                                                        <div class="text-valid">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="button" name="next" class="next action-button-next" value="Next Step" />
                                </fieldset>
                                <fieldset>
                                    {{-- <div class="col-md-6">
                                        <div class="col-md-14 mb-3">
                                            <label class="form-control-label">Silahkan pilih nomor handphone anda :</label>
                                            <select name="education" class="form-control" data-toggle="select">
                                                <option value="0" disabled selected>Pilih Nomor HP</option>
                                                @foreach ($phonenumbers as $phone)
                                                    <option value="{{ $education->id }}"
                                                        {{ old('phone', $mitra->education) == $education->id ? 'selected' : '' }}>
                                                        {{ $education->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <input type="button" name="previous" class="previous action-button-previous"
                                        value="Previous" />
                                    <input type="button" name="next" class="next action-button-next" value="Next Step" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Nama
                                                        Lengkap</label>
                                                    <p>
                                                        tyfytf
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Jenis
                                                        Kelamin</label>
                                                    <p>
                                                        Laki-laki
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Desa</label>
                                                    <p>
                                                        Klompangan
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="input-first-name">Kecamatan</label>
                                                    <p>
                                                        Ajung
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p>Anda akan mengikuti survey {{ $survey->name }} <br> nomor handphone
                                        @foreach ($mitra->phonenumbers->where('is_main', '=', 1) as $phone)
                                            {{ $phone->phone }},
                                        @endforeach</p>

                                    <input type="button" name="previous" class="previous action-button-previous"
                                        value="Previous" />
                                    <input type="submit" name="next" class="next action-button-next" value="submit" />
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('optionaljs')

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>

    <script>
        $(document).ready(function() {

            var current_fs, next_fs, previous_fs; //fieldsets
            var opacity;

            $(".next").click(function() {

                current_fs = $(this).parent();
                next_fs = $(this).parent().next();

                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 600
                });
            });

            $(".previous").click(function() {

                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();

                //Remove class active
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

                //show the previous fieldset
                previous_fs.show();

                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        previous_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 600
                });
            });

            $('.radio-group .radio').click(function() {
                $(this).parent().find('.radio').removeClass('selected');
                $(this).addClass('selected');
            });

            $(".submit").click(function() {
                return false;
            })

        });
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
