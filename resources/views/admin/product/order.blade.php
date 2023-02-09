@extends('admin.layout.masterLayoutAdmin')
@section('admin')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">


                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div id="page-content">
            <div style="display: flex;align-items: center;}">

                <h3 class="page-header">{{ __('Order Management') }}</h3>
            </div>
            <table class="table table-bordered" id="danhsach">
                <thead>
                    <tr>
                        <th class="cell-small text-center" data-toggle="tooltip" title=""
                            data-original-title="Toggle all!"><input type="checkbox" id="check5-all" name="check5-all"></th>
                        <th class="text-center">#</th>
                        <th style="width: 250px">{{ __('Users name') }}</th>
                        <th style="width: 200px">{{ __('Quantity') }}</th>
                        <th style="width: 200px">{{ __('Total') }}</th>
                        <th style="width: 200px">{{ __('Create at') }}</th>

                        <th class="cell-small text-center"><i class="fa fa-bolt"></i>{{ __('Edit/Delete') }}</th>
                    </tr>
                </thead>
                @foreach ($data as $item)
                    <tbody>

                        <th class="cell-small text-center" data-toggle="tooltip" title=""
                            data-original-title="Toggle all!"><input type="checkbox" id="check5-all" name="check5-all"></th>
                        <th style="text-align: center">{{ $item->id }}</th>
                        <th>{{ $item->customers->full_name}}</th>
                        <th>{{ $item->quantity }}</th>
                        <th>{{$item->total }}</th>
                        <th>{{ $item->created_at }}</th>
                        <!-- <th>Ps15272</th> -->
                        <td class="text-center">
                            <div class="btn-group">
                                <a style="border-radius: 8px" href="{{ route('order.detail', ['id' => $item->id]) }}" data-toggle="tooltip"
                                    title="" class="btn btn-xs btn-info" data-original-title="Chi tiết sản phẩm"><i
                                        class="fa fa-info-circle"></i></a>
                                <a style="border-radius: 8px" href="{{ route('user.edit', ['id' => $item->id]) }}"
                                    data-toggle="tooltip" title="" class="btn btn-xs btn-success"
                                    data-original-title="Sửa"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg></a>

                                <button style="border-radius: 8px; width:41px" class="delete btn btn-xs btn-danger"
                                    data-route="{{ route('user.delete', ['id' => $item->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </button>

                            </div>
                        </td>

                    </tbody>
                @endforeach

            </table>
        </div>
        <!-- /.content -->
    @endsection
    @push('js')
        <script>
            $(".delete").click(function() { //khi bam vo class delete 
                let data = $(this).data("route"); // tao bien router

                Swal.fire({
                    title: "{{ __('Are you sure') }}",
                    text: "{{ __("You won't be able to revert this!") }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __('Yes, delete it!') }}' //alert
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({

                                method: "GET",
                                url: data, //gui ve controller
                            })
                            .done(function(res) {
                                Swal.fire(
                                    '{{ __('Deleted!') }}',
                                    '{{ __('Your file has been deleted.') }}',
                                    'success'

                                )
                                location.reload();
                                console.log(res.message);
                            });

                    }
                })

            });
            $(".filterStock").change(function() { //khi bam vo class delete
                let data = $(this).data("route"); // tao bien router

                $.ajax({

                        method: "POST",
                        url: data, //gui ve controller
                    })
                    .done(function(res) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'

                        )
                        location.reload();
                        console.log(res.message);
                    });

            })
        </script>
    @endpush
