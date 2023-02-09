@extends('admin.layout.masterLayoutAdmin')
@section('admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Edit User') }}</h1>
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
                                <h3 class="card-title">{{ __('Infomation') }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <form action="{{ route('user.update', $data->id) }}" method="POST"
                                class="form-horizontal form-box" enctype="multipart/form-data">
                                <div class="form-box-content">
                                    <!-- Input Sizes -->
                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('Users name') }}</label>
                                        <div class="col-md-9">
                                            <input value="{{ $data->user_name }}" type="text" name="user_name"
                                                id="name" class="form-control">
                                        </div>
                                        @if ($errors->has('user_name'))
                                            <span class="text-danger">{{ $errors->first('user_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('First name') }}</label>
                                        <div class="col-md-9">
                                            <input value="{{ $data->first_name }}" type="text" name="first_name"
                                                id="price" class="form-control">
                                        </div>
                                        @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('Last name') }}</label>
                                        <div class="col-md-9">
                                            <input value="{{ $data->last_name }}" type="text" name="last_name"
                                                id="last_name" class="form-control">
                                        </div>
                                        @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="province">{{ __('City') }}</label>
                                        <select class="custom-select" name="province_id" id="province">
                                            <option selected value="{{ $data->province->id }}">{{ $data->province->name }}
                                            </option>
                                            @foreach ($province as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                            <small class="alert-danger">{{ $message }}</small>
                                        @enderror <br>
                                    </div>

                                    <div class="form-group">
                                        <label for="district">{{ __('District') }}</label>
                                        <select selected class="custom-select" name="district_id" id="district">
                                            <option selected value="{{ $data->district->id }}">{{ $data->district->name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="district">{{ __('Wards') }}</label>
                                        <select class="custom-select" name="commune_id" id="commune">
                                            <option selected value="{{ $data->commune->id }}">{{ $data->commune->name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('Birtday') }}</label>
                                        <div class="col-md-9">
                                            <input value="{{ $data->birtday }}" type="date" name="birtday"
                                                id="birtday" class="form-control">
                                        </div>
                                        @if ($errors->has('birtday'))
                                            <span class="text-danger">{{ $errors->first('birtday') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('Avatar') }}</label>
                                        <div class="col-md-9">
                                            <img id="avatar" style="width: 50px"
                                                src="{{ asset('upload/user/' . $data->avatar) }}" alt="">
                                            <input type="file" accept="image/gif, image/jpeg, image/png" name="avatar"
                                                onchange="chooseFile(this)" id="" class="form-control">
                                        </div>
                                        @if ($errors->has('avatar'))
                                            <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('Email') }}</label>
                                        <div class="col-md-9">
                                            <input value="{{ $data->email }}" type="email" name="email" id="email"
                                                class="form-control">
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif

                                        <div class="form-group form-actions">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Edit') }}
                                            </button>

                                        </div>
                                    </div>
                                    @csrf
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    function chooseFile(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
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
