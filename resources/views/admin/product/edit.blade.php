@extends('admin.layout.masterLayoutAdmin')
@section('admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Product') }}</h1>
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

                            <form action="{{ route('product.update', $data->id) }}" method="POST"
                                class="form-horizontal form-box" enctype="multipart/form-data">
                                <div class="form-box-content">
                                    <!-- Input Sizes -->
                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('Product name') }}</label>
                                        <div class="col-md-9">
                                            <input value="{{ $data->name }}" type="text" name="name" id="name"
                                                class="form-control">
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('Category name') }}</label>
                                        <div class="col-md-9">
                                            <select id="inputStatus" class="form-control custom-select" name="category_id">

                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach

                                                <option selected value="{{ $data->product_catelory->id }}">
                                                    {{ $data->product_catelory->name }}</option>

                                            </select>
                                        </div>
                                        @if ($errors->has('category_id'))
                                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('Stock') }}</label>
                                        <div class="col-md-9">
                                            <input value="{{ $data->stock }}" type="text" name="stock" id="stock"
                                                class="form-control">
                                        </div>
                                        @if ($errors->has('stock'))
                                            <span class="text-danger">{{ $errors->first('stock') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('Price') }}</label>
                                        <div class="col-md-9">
                                            <input value="{{  $data->price }}" type="text" name="price" id="price"
                                                class="form-control">
                                        </div>
                                        @if ($errors->has('price'))
                                            <span class="text-danger">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('Expired at') }}</label>
                                        <div class="col-md-9">
                                            <input value="{{ $data->expired_at }}" type="date" name="expired_at"
                                                id="expired_at" class="form-control">
                                        </div>
                                        @if ($errors->has('expired_at'))
                                            <span class="text-danger">{{ $errors->first('expired_at') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">{{ __('Image') }}</label>
                                        <div class="col-md-9">
                                            <img id="avatar" style="width: 50px"
                                                src="{{ asset('upload/product/' . $data->avatar) }}">
                                            <input type="file" accept="image/gif, image/jpeg, image/png"
                                                name="avatar_tmp" onchange="chooseFile(this)" id=""
                                                class="form-control">
                                        </div>
                                        @if ($errors->has('avatar_tmp'))
                                            <span class="text-danger">{{ $errors->first('avatar_tmp') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Sku</label>
                                        <div class="col-md-9">
                                            <input value="{{ $data->sku }}" type="text" name="sku" id="sku"
                                                class="form-control">
                                        </div>
                                        @if ($errors->has('sku'))
                                            <span class="text-danger">{{ $errors->first('sku') }}</span>
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
</script>