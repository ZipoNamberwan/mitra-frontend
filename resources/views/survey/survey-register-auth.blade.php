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
    <div class="row mt-0">
        <div class="col-12 p-0 mt-3 mb-2">
            <div class="card px-3 pt-4 pb-0 mt-3 mb-3">
                <h2 class="text-center"><strong>Pendaftaran {{$survey->name}}</strong></h2>
                <div class="row">
                    <div class="col-md-12 mx-0 text-center">
                        <form id="msform" action="/survey-register/{{ $survey->id }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <ul id="progressbar" class="col-mb-6 text-center">
                                <li class="active" id="account"><strong>Update Biodata</strong></li>
                                <li id="personal"><strong>Isi No HP</strong></li>
                                <li id="confirm"><strong>Konfirmasi</strong></li>
                            </ul>
                            <fieldset id="mitra-info-form">
                                <div class="card-wrapper">
                                    <!-- Custom form validation -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-2">Update Biodata</h3>
                                            <p class="mb-0"><small>*Wajib Diisi</small></p>
                                        </div>
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-control-label" for="validationCustom03">Nama Lengkap*</label>
                                                        <input onchange="nameChange()" type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ @old('name', $mitra->name) }}">
                                                        @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-control-label" for="validationCustom03">Nama Panggilan</label>
                                                        <input type="text" name="nickname" class="form-control @error('nickname') is-invalid @enderror" id="validationCustom03" value="{{ @old('nickname', $mitra->nickname) }}">
                                                        @error('nickname')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-control-label" for="">Foto</label>
                                                        <img class="img-preview img-fluid mb-3 col-sm-5 image-preview" src="@if ($mitra->photo != null) {{ asset('storage/' . $mitra->photo) }} @endif" style="display:block">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="photo" name="photo" lang="en" onchange="previewPhoto()" accept="image/*">
                                                            <label class="custom-file-label" for="customFileLang" id="photolabel">Pilih
                                                                Gambar</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="exampleDatepicker">Tanggal
                                                                Lahir*</label>
                                                            <input name="birthdate" id="birthdate" class="form-control @error('birthdate') is-invalid @enderror" placeholder="Select date" type="date" value="{{ @old('birthdate', $mitra->birthdate) }}">
                                                            @error('birthdate')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
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
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-control-label">Pendidikan*</label>
                                                        <select name="education" class="form-control" data-toggle="select">
                                                            <option value="0" disabled selected>Pilih
                                                                Pendidikan terakhir</option>
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
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-control-label" for="validationCustom03">Profesi*</label>
                                                        <input type="text" name="profession" class="form-control @error('profession') is-invalid @enderror" id="profession" value="{{ @old('profession', $mitra->profession) }}">
                                                        @error('profession')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-control-label" for="validationCustom03">Alamat*</label>
                                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" value="{{ @old('address', $mitra->address) }}">
                                                        @error('address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="form-control-label">Kecamatan*</label>
                                                        <select onchange="subdistrictChange()" id="subdistrict" name="subdistrict" class="form-control" data-toggle="select" name="subdistrict" required>
                                                            <option value="0" disabled selected> -- Pilih
                                                                Kecamatan -- </option>
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
                                                    <div class="col-md-12 mt-3">
                                                        <label class="form-control-label">Desa*</label>
                                                        <select onchange="villageChange()" id="village" name="village" class="form-control" data-toggle="select" name="village">
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
                                <input type="button" name="next" class="next btn btn-primary" value="Selanjutnya" />
                            </fieldset>
                            <fieldset id="phone-form">
                                <div class="card-wrapper">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-2">Isi No HP</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-control-label mb-3" for="phone">Pilih No HP yang akan didaftarkan</label>
                                                    <select onchange="selectPhone()" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" data-toggle="select">
                                                        <option value="0" selected disabled> -- Pilih No HP -- </option>
                                                        @foreach ($mitra->phonenumbers as $phone)
                                                        <option value="{{ $phone->id }}">{{ $phone->phone }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div id="phone-invalid" class="text-valid mt-1" style="display: none;">
                                                        No HP belum dipilih
                                                    </div>
                                                    @error('phone')
                                                    <div class="text-valid mt-1">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-control-label mb-3" for="phone">Jika No HP ganti, tekan tombol di bawah ini dan masukkan No HP yang baru</label>
                                                    <label class="form-control-label" for="phone">Apakah akan mengganti No HP?</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-1">
                                                    <label class="custom-toggle">
                                                        <input class="custom-control-input" id="toggle-phone" name="toggle-phone" type="checkbox" @if(old('toggle-phone')=="on" ) checked @endif>
                                                        <span class="custom-toggle-slider rounded-circle" data-label-off="Tidak" data-label-on="Ya"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <input onchange="onNewPhoneChange()" style="display: none;" id="newphone" placeholder="Masukkan No HP baru di sini" type="number" name="newphone" class="form-control @error('newphone') is-invalid @enderror" id="validationCustom03" value="{{ @old('newphone', $mitra->newphone) }}">
                                                    @error('newphone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="phoneregistered" name="phoneregistered" />
                                <input type="button" name="previous" class="previous btn btn-secondary" value="Kembali" />
                                <input type="button" name="next" class="next btn btn-primary" value="Selanjutnya" />
                            </fieldset>
                            <fieldset id="confirmation-form">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Konfimasi Data</h3>
                                        <span>*Harap Cek Kembali Data yang sudah Dimasukkan</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Nama Lengkap</label>
                                                    <br />
                                                    <span id="namelabel"></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Wilayah Asal</label>
                                                    <br />
                                                    <span id="villagelabel"></span>
                                                    <span id="subdistrictlabel"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mb-1">
                                                <span>Akan Melakukan Pendaftaran</span> <span class="badge badge-lg bg-success">{{$survey->name}}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <span>No HP yang didaftarkan: </span><span id="phonelabel"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous btn btn-secondary" value="Kembali" />
                                <input type="submit" name="next" class="next btn btn-primary" value="Daftar" />
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
<script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<script src="/assets/vendor/select2/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {

        var current_fs, next_fs, previous_fs;
        var opacity;

        $(".next").click(function() {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            // console.log('current ' + current_fs.attr('id'));
            // console.log('prev ' + previous_fs.attr('id'));

            var valid = true;
            if (current_fs.attr('id') == 'mitra-info-form') {
                if (document.getElementById('name').value == '') {
                    valid = false;
                    document.getElementById('name').classList.add("is-invalid");
                } else {
                    document.getElementById('name').classList.remove("is-invalid");
                }
                if (document.getElementById('address').value == '') {
                    valid = false;
                    document.getElementById('address').classList.add("is-invalid");
                } else {
                    document.getElementById('address').classList.remove("is-invalid");
                }
                if (document.getElementById('profession').value == '') {
                    valid = false;
                    document.getElementById('profession').classList.add("is-invalid");
                } else {
                    document.getElementById('profession').classList.remove("is-invalid");
                }
                if (document.getElementById('birthdate').value == '') {
                    valid = false;
                    document.getElementById('birthdate').classList.add("is-invalid");
                } else {
                    document.getElementById('birthdate').classList.remove("is-invalid");
                }
            } else if (current_fs.attr('id') == 'phone-form') {
                if (document.getElementById('toggle-phone').checked) {
                    if (document.getElementById('newphone').value == '') {
                        valid = false;
                        document.getElementById('newphone').classList.add("is-invalid");
                    } else {
                        document.getElementById('newphone').classList.remove("is-invalid");
                    }
                    document.getElementById('phone-invalid').style.display = 'none';
                } else {
                    if (document.getElementById('phone').value == '0') {
                        valid = false;
                        document.getElementById('phone-invalid').style.display = 'block';
                    } else {
                        document.getElementById('phone-invalid').style.display = 'none';
                    }
                    document.getElementById('newphone').classList.remove("is-invalid");
                }
            } else {
                valid = false;
            }

            if (valid) {
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
            }
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
    function nameChange() {
        document.getElementById('namelabel').innerText = document.getElementById('name').value;
    }

    function subdistrictChange() {
        document.getElementById('subdistrictlabel').innerText = document.getElementById('subdistrict').options[document.getElementById('subdistrict').selectedIndex].text;
    }

    function villageChange() {
        document.getElementById('villagelabel').innerText = document.getElementById('village').options[document.getElementById('village').selectedIndex].text;
    }

    function selectPhone() {
        if (document.getElementById('toggle-phone').checked == false) {
            document.getElementById('phoneregistered').value = document.getElementById('phone').options[document.getElementById('phone').selectedIndex].text;
        }
        document.getElementById('phonelabel').innerText = document.getElementById('phoneregistered').value;
    }

    function onNewPhoneChange() {
        if (document.getElementById('toggle-phone').checked == true) {
            document.getElementById('phoneregistered').value = document.getElementById('newphone').value;
        }
        document.getElementById('phonelabel').innerText = document.getElementById('phoneregistered').value;
    }
    nameChange();
    subdistrictChange();
</script>
<script>
    var togglePhone = document.getElementById('toggle-phone');
    var newPhone = document.getElementById('newphone');
    var phone = document.getElementById('phone');
    if (togglePhone.checked) {
        newPhone.disabled = false;
    }
    togglePhone.addEventListener('change', (event) => {
        if (event.target.checked) {
            newPhone.style.display = 'block';
            phone.disabled = true;
            document.getElementById('phoneregistered').value = document.getElementById('newphone').value;
        } else {
            newPhone.style.display = 'none';
            phone.disabled = false;
            document.getElementById('phoneregistered').value = document.getElementById('phone').options[document.getElementById('phone').selectedIndex].text;
        }
        document.getElementById('phonelabel').innerText = document.getElementById('phoneregistered').value;
    })
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
                villageChange();
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