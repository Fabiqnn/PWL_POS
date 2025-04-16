@extends('layouts.template')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('profile_pict/'.auth()->user()->profile_picture) }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ auth()->user()->nama }}</h3>

                            <p class="text-muted text-center">{{ auth()->user()->level->level_nama }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Username</b> <a class="float-right"> {{ auth()->user()->username }} </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{ auth()->user()->email }}</a>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Edit
                                        Profile</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- /.tab-pane -->

                                <div class="active tab-pane" id="settings">
                                    <form class="form-horizontal" method="POST" action="{{ url('user/'.auth()->user()->user_id.'/update_profile') }}" enctype="multipart/form-data" id="form-update-profile">
                                        @csrf
                                        <div class="form-group row" style="align-items: center">
                                            <label class="col-sm-2 col-form-label">Profile</label>
                                            <div class="form-group col-sm-10">
                                                <label for="file_profile"><img class="profile-user-img img-fluid img-circle mb-2" src="{{ asset('profile_pict/'.auth()->user()->profile_picture) }}"
                                                        alt="User profile picture"></label>
                                                {{-- Tombol upload yang menyerupai tombol --}}
                                                <label for="file_profile" class="btn btn-info" style="margin-left: 10px; cursor: pointer; font-weight: 500"> <i class="fa fa-file-image"></i> Upload Foto Baru </label>
                                                <span id="profile_name"></span>
                                                {{-- Input file disembunyikan --}}
                                                <input type="file" name="file_profile" id="file_profile" style="display: none;">
                                                <small id="error-file_profile" class="error-text form-text text-danger"></small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="form-group col-sm-10">
                                                <input type="text" class="form-control" id="inputName" placeholder="name" value="{{ auth()->user()->nama }}" name="nama">
                                                <small id="error-nama" class="error-text form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="form-group col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ auth()->user()->email }}" name="email">
                                                <small id="error-email" class="error-text form-text text-danger"></small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">

                                                <button type="submit" class="btn btn-danger">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function () {
            const profile = document.getElementById('file_profile');
            const profileImgPreview = document.querySelector('label[for="file_profile"] img');

            profile.addEventListener('change', function () {
                if (profile.files.length > 0) {
                    document.getElementById('profile_name').innerHTML = profile.files[0].name;

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        profileImgPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(profile.files[0]);
                }
            });

            formProfile = $("#form-update-profile")
            $("#form-update-profile").validate({
                rules: {
                    file_profile: {
                        required: false, 
                        extension: "jpeg, jpg, png"
                    },
                    nama: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    email: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    }
                },
                submitHandler: function(form) {    
                    var formProfile = new FormData(form); // Jadikan form ke FormData untuk menghandle file

                    $.ajax({
                        type: form.method,
                        url: form.action,
                        data: formProfile, // Data yang dikirim berupa FormData
                        processData: false, // Setting processData dan contentType ke false, untuk menghandle file
                        contentType: false,
                        success: function (response) {
                            if (response.status) { // jika sukses
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                }).then((result) => {
                                   location.reload(); 
                                });
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function (prefix, valueOfElement) { 
                                    $('#error-'+prefix).text(valueOfElement[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan', 
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid')
                }
            });
        });
    </script>  
@endpush