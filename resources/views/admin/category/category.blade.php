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
                <h3 class="page-header">{{ __('Category') }}</h3>
                <div><a style="margin-left:500px" href="  {{ route('catetogory.create') }}"></i>{{ __('Add category') }}</a></div>

            </div>



            <table class="table table-bordered" id="danhsach">
                <thead>
                    <tr>
                        <th class="cell-small text-center" data-toggle="tooltip" title=""
                            data-original-title="Toggle all!"><input type="checkbox" id="check5-all" name="check5-all"></th>
                        <th style="text-align: center">STT</th>
                        <th class="text-center">#</th>

                        <th style="width: 250px"> {{ __('Category name') }}</th>
                        <th style="width: 250px"> {{ __('Category') }}</th>
                        <th style="width: 250px"> {{ __('Created_at') }}</th>



                        <th class="cell-small text-center"><i class="fa fa-bolt"></i>{{ __('Edit/Delete') }}</th>

                    </tr>
                </thead>
                @foreach ($data as $item)
                    <tbody>

                        <th class="cell-small text-center" data-toggle="tooltip" title=""
                            data-original-title="Toggle all!"><input type="checkbox" id="check5-all" name="check5-all"></th>
                        <td style="text-align: center">{{ ++$i }}</td>
                        <th style="text-align: center">{{ $item->id }}</th>
                        <th>{{ $item->name }}</th>
                        <th>{{ optional($item->parent)->name }}</th>
                        <th>{{ $item->created_at }}</th>

                        <td class="text-center">
                            <div class="btn-group" style="width: 72px">
                                <a href="/welcome/{{ $item->id }}" data-toggle="tooltip" title=""
                                    class="btn btn-xs btn-info" data-original-title="Chi tiết sản phẩm"><i
                                        class="fa fa-info-circle"></i></a>
                                <a href="{{ route('category.edit', ['id' => $item->id]) }}" data-toggle="tooltip"
                                    title="" class="btn btn-xs btn-success"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg></a>


                                <a href="{{ route('category.delete', ['id' => $item->id]) }}"><input type="submit"
                                        value="X" type="submit" data-toggle="tooltip" title=""
                                        class="btn btn-xs btn-danger"><i class="bi bi-x-lg"></i></a>


                            </div>
                        </td>


                    </tbody>
                @endforeach

            </table>
            {{ $data->links() }}
        </div>
        <!-- /.content -->
    @endsection
