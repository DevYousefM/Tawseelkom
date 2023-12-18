@extends('dashboard.layouts.main')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 d-flex justify-content-between">
                    <h1 class="m-0 text-dark">المندوبين</h1>
                    <a class="btn btn-info text-white" href="{{ route('add.deliveries') }}">أضافة مندوب</a>
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
                            <table id="deliveries" class="table table-bordered table-hover dataTable" role="grid"
                                aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-sort="ascending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">أسم المندوب
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">أسم المستخدم
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">أوامر
                                        </th>
                                        {{-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                            Platform(s)</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="Engine version: activate to sort column ascending">
                                            Engine version</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-label="CSS grade: activate to sort column ascending">CSS
                                            grade</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach ($deliveries as $delivery)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $delivery->name }}</td>
                                            <td>{{ $delivery->username }}</td>
                                            <td>
                                                <div class="d-flex" style="justify-content: space-evenly">
                                                    <a href="{{ route('edit.deliveries', $delivery->id) }}"
                                                        class="btn btn-sm btn-primary">تعديل</a>
                                                    <form method="POST" style="width:fit-content"
                                                        action="{{ route('delete.deliveries', $delivery->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Are you sure you want to delete?')"
                                                            type="submit" class="btn btn-sm btn-danger">حذف</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $count++; ?>
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
            $('#deliveries').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "pageLength": 20,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "language": {
                    "sSearch": "",
                    "searchPlaceholder": "البحث عن مندوب",
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
