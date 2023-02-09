@extends('admin.layout.masterLayoutAdmin')
@section('admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Project Detail</li>
                            <button
                                style="margin-left:50px; background-color:cornflowerblue; border: 0.5px solid cornflowerblue "><a
                                    style="text-decoration: none; color:white"
                                    href=" {{ route('order.PDF', ['id' => $data->id]) }}">{{ __('PDF') }}</a></button>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projects Detail</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table">
                        <div class="info">{{ __("CUSTOMER INFOMATION") }}</div>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __("Users name") }}</th>
                                <th scope="col">Email</th>
                                <th scope="col">{{ __("Phone") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $data->customer->full_name }}</td>
                                <td>{{ $data->customer->email }}</td>
                                <td>{{ $data->customer->phone }}</td>
                            </tr>

                        </tbody>
                    </table>
                    <table class="table">
                        <div>{{ __("ORDER DETAIL") }}</div>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Product name') }}</th>
                                <th scope="col">{{ __('Order ID') }}</th>
                                <th scope="col">{{ __('Price') }}</th>
                                <th scope="col">{{ __('Quantity') }}</th>
                                <th scope="col">{{ __('Create at') }}</th>


                            </tr>
                        </thead>
                        @foreach ($data->order_detail as $item)
                            <tbody>
                                <tr>
                                    <th scope="row"><b>{{ $item->id }}</b><br></th>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->order_id }}</td>
                                    <td>{{ number_format($item->price, 0, '', ',') }} VND</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->created_at }}</td>

                                </tr>

                            </tbody>
                        @endforeach
                    </table>
                    {{ __('Total quantity') }}: <b>{{ $data->quantity }}</b><br>
                    {{ __('Total payment') }}: <b>{{ number_format($data->total, 0, '', ',') }} VND</b>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection
<style>

</style>
