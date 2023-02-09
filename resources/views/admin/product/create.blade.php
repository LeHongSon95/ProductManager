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
                            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">

                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">
                                        {{ __("Product name") }}</label>
                                    <div class="col-md-6">
                                        <input type="text" id="name" class="form-control" name="name" autofocus>
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="sku" class="col-md-4 col-form-label text-md-right">
                                        Sku</label>
                                    <div class="col-md-6">
                                        <input type="text" id="sku" class="form-control" name="sku" autofocus>
                                        @if ($errors->has('sku'))
                                            <span class="text-danger">{{ $errors->first('sku') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __("Image") }}</label>
                                    <div class="col-md-6">
                                        <input type="file" id="avatar" class="form-control" name="avatar" autofocus>
                                        @if ($errors->has('avatar'))
                                            <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="stock" class="col-md-4 col-form-label text-md-right">
                                        {{ __("Stock") }}</label>
                                    <div class="col-md-6">
                                        <input type="stock" id="stock" class="form-control" name="stock"
                                            autofocus>
                                        @if ($errors->has('stock'))
                                            <span class="text-danger">{{ $errors->first('stock') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="birtday" class="col-md-4 col-form-label text-md-right">{{ __("Expired at") }}</label>
                                    <div class="col-md-6">
                                        <input type="date" id="expired_at" class="form-control" name="expired_at"
                                            autofocus>
                                        @if ($errors->has('expired_at'))
                                            <span class="text-danger">{{ $errors->first('expired_at') }}</span>
                                        @endif
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{ __("Category name") }}</label>
                                    <div class="col-md-9">
                                        <select id="inputStatus" class="form-control custom-select" name="category_id">

                                           @foreach ( $category as $item )
                                           
                                           <option value="{{ $item->id }}">{{  $item->name }}</option>

                                           @endforeach
                                            
                                        </select>
                                    </div>
                                    @if ($errors->has('category_id'))
                                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __("Add") }}
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
