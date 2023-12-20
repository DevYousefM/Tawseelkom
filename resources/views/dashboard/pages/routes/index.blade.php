@extends('dashboard.layouts.main')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 d-flex justify-content-between">
                    <h1 class="m-0 text-dark">المسارات</h1>
                    <a class="btn btn-info text-white" href="{{ route('refresh.routes') }}">تحديث المسارات</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card-body">
                @include('dashboard.components.success')
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6"></div>
                        <div class="col-sm-12 col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="routes" class="table table-bordered table-hover dataTable" role="grid"
                                aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-sort="ascending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">من
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">الي
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">نوع الشحنة
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">السعر
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">المسافة
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach ($routes as $route)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $route->fromArea->area }}</td>
                                            <td>{{ $route->toArea->area }}</td>
                                            <td>{{ $route->shipmentType->title }}</td>
                                            <td>
                                                <span class="d-none">{{ $route->price }}</span>
                                                <div style="width:130px">
                                                    <form action="{{ route('update.route.price', $route->id) }}"
                                                        class="input-group mb-3" method="post">
                                                        @csrf
                                                        @method('post')
                                                        <span class="input-group-text px-2"
                                                            style="font-size: 13px">{{ config('app.custom.currency') }}</span>
                                                        <input type="number" name="price"
                                                            value="{{ $route->price ?? 0 }}" style="width:10px"
                                                            class="form-control text-center px-1">
                                                        <button type="submit" style="font-size: 10px"
                                                            class="btn btn-success btn-sm input-group-text bg-success"><i
                                                                class="fas fa-check"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="d-none">{{ $route->distance }}</span>
                                                <div style="width:130px">
                                                    <form action="{{ route('update.route.distance', $route->id) }}"
                                                        class="input-group mb-3" method="post">
                                                        @csrf
                                                        @method('post')
                                                        <span class="input-group-text px-2"
                                                            style="font-size: 13px">km</span>
                                                        <input type="number" step="any" name="distance"
                                                            value="{{ $route->distance ?? 0 }}" style="width:10px"
                                                            class="form-control text-center px-1">
                                                        <button type="submit" style="font-size: 10px"
                                                            class="btn btn-success btn-sm input-group-text bg-success"><i
                                                                class="fas fa-check"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                        ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <!-- DataTables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function() {
            $('#routes').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "pageLength": 10,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "language": {
                    "sSearch": "",
                    "searchPlaceholder": "البحث عن مسار",
                    "paginate": {
                        "previous": "السابق",
                        "next": "التالي"
                    },
                    "emptyTable": "لا يوجد بيانات"
                }
            });
        });
    </script>
@endsection
