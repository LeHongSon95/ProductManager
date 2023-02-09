@extends('admin.layout.masterLayoutAdmin')
@section('admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Edit category') }}</h1>
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
                            {{-- {{ dd($result) }} --}}
                            <form action="{{ route('category.update', $data->id) }}" method="POST"
                                class="form-horizontal form-box" enctype="multipart/form-data">
                                <div class="form-box-content">
                                    <!-- Input Sizes -->
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right"> {{ __("Category") }}
                                            </label>
                                        <div class="col-md-6">
                                            <input value="{{ $data->name }}" type="text" id="name"
                                                class="form-control" name="name" autofocus>
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputStatus">Parent id</label>
                                        {{-- {{ dd($data) }} --}}
                                        <select id="inputStatus" class="form-control custom-select" name="parent_id">
                                            
                                            @if ($data->parent_id == null)
                                                <option value="" selected>NULL</option>
                                            @else
                                                <option value="">NULL</option>
                                                <option value=" {{ $data->parent->id  }}" selected>{{ $data->parent->name }}</option>
                                            @endif
                                            @forelse ($result as $itemResult)
                                                <option value="{{ $itemResult->id }}">{{ $itemResult->name }}</option>
                                            @empty
                                            @endforelse

                                        </select>
                                        @if ($errors->has('parent_id'))
                                            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group form-actions">


                                        <button type="submit" class="btn btn-primary">
                                           {{ __("Edit")}}
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
