@extends('admin.layout.masterLayoutAdmin')
@section('admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>General Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">General Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Quick Example</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">

                                @csrf
                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Users name') }}</label>
                                    <div class="col-md-6">
                                        <input  type="text" id="user_name" class="form-control" name="user_name"
                                            autofocus>
                                        @if ($errors->has('user_name'))
                                            <span class="text-danger">{{ $errors->first('user_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" id="first_name" class="form-control" name="first_name"
                                            autofocus>
                                        @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="province">{{ __('City') }}</label>
                                    <select class="custom-select" name="province_id" id="province">
                                        <option selected value="">Choose...</option>
                                        @foreach ($province as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('province_id')
                                        <small class="alert-danger">{{ $message }}</small>
                                    @enderror <br>
                                </div>

                                <div class="form-group">
                                    <label for="district">{{ __('District') }}</label>
                                    <select class="custom-select" name="district_id" id="district">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="district">{{ __('Wards') }}</label>
                                    <select class="custom-select" name="commune_id" id="commune">
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
                                    <div class="col-md-6">
                                        <input type="file" id="avatar" class="form-control" name="avatar" autofocus>
                                        @if ($errors->has('avatar'))
                                            <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" id="last_name" class="form-control" name="last_name"
                                            autofocus>
                                        @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="birtday" class="col-md-4 col-form-label text-md-right">{{ __('Birtday') }}</label>
                                    <div class="col-md-6">
                                        <input type="date" id="birtday" class="form-control" name="birtday" autofocus>
                                        @if ($errors->has('birtday'))
                                            <span class="text-danger">{{ $errors->first('birtday') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email"
                                            autofocus>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#province').on('change', function() {
            var provinceId = $(this).val();
            $('#district').html('');
            $.ajax({
                url: '{{ route('user.district') }}',
                type: 'get',
                data: {
                    province_id: provinceId
                },
                success: function(res) {
                    $('#district').html('<option value="">Select District</option>');
                    $.each(res, function(key, value) {
                        $('#district').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    // $('#commune').html('<option value="">Select Commune</option>');
                }
            });
        });
        $('#district').on('change', function() {
            var districtId = $(this).val();
            $.ajax({
                url: '{{ route('user.commune') }}',
                type: 'get',
                data: {
                    district_id: districtId,
                },
                success: function(res) {
                    let html = '';
                    html = '<option value="">Select commune</option>';
                    $.each(res, function(key, value) {
                        html += '<option value="' + value
                            .id + '">' + value.name + '</option>';

                    });
                    $('#commune').html('').append(html);
                }
            });
        });
    });
</script>
