
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
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

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
                        <div class="info">THÔNG TIN KHÁCH HÀNG</div>
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
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
                        <div>CHI TIẾT ĐƠN HÀNG</div>
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên Sản phẩm</th>
                            <th scope="col">Order id</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Ngày mua</th>
                            <th scope="col">Số lượng</th>

                            
                          </tr>
                        </thead>
                        @foreach ($data->order_detail as $item)
                        <tbody>
                          <tr>
                            <th scope="row"><b>{{ $item->id }}</b><br></th>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->order_id }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->quantity }}</td>
                            
                          </tr>
                         
                        </tbody>
                        @endforeach
                      </table>
                      Tổng số lượng: <b>{{ $data->quantity }}</b>
                      Tổng tiền: <b>{{ $data->total }}</b>
                  
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>

    <style>
        body { font-family: DejaVu Sans, serif; }
    </style>

    


