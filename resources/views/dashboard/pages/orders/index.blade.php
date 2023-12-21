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
                    <h1 class="m-0 text-dark">الطلبات</h1>
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
                            <table id="orders" class="table table-bordered table-hover dataTable" role="grid"
                                aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1" aria-sort="ascending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">
                                            من
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">
                                            الي
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">
                                            نوع الشحنة
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">
                                            السعر
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">
                                            المسافة
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">
                                            اسم المرسل
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">بيانات المستخدم
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">بيانات المستلم
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">بيانات الدفع
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">حالة الطلب
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">بيانات المندوب
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">بيانات التواريخ
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                            colspan="1">تفاصيل اضافية
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $order->from }}</td>
                                            <td>{{ $order->to }}</td>
                                            <td>{{ $order->shipment_type }}</td>
                                            <td>
                                                <div class="d-flex" style="gap: 4px">
                                                    <span>{{ config('app.custom.currency') }}</span>
                                                    <span>{{ $order->price }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex" style="gap: 4px">
                                                    <span>Km</span>
                                                    <span>{{ $order->distance }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $order->sender_name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#user-{{ $count }}">
                                                    عرض
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#recipient-{{ $count }}">
                                                    عرض
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#payment-{{ $count }}">
                                                    عرض
                                                </button>
                                            </td>
                                            <td>{{ $order->status }}</td>
                                            <td>
                                                @if ($order->delivery_order)
                                                    <button type="button" class="btn btn-sm btn-info"
                                                        data-toggle="modal" data-target="#delivery-{{ $count }}">
                                                        عرض
                                                    </button>
                                                @else
                                                    ليس بعد
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#dates-{{ $count }}">
                                                    عرض
                                                </button>
                                            </td>
                                            <td>
                                                @if ($order->details == null)
                                                    لا يوجد
                                                @else
                                                    <button type="button" class="btn btn-sm btn-info"
                                                        data-toggle="modal" data-target="#details-{{ $count }}">
                                                        عرض
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="user-{{ $count }}" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">بيانات المستخدم</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>الأسم: {{ $order->user->name }}</p>
                                                        <p>البريد الألكتروني: {{ $order->user->email }}</p>
                                                        <p>رقم الهاتف: {{ $order->user->phone }}</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-sm btn-default"
                                                            data-dismiss="modal">اغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="recipient-{{ $count }}"
                                            style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">بيانات المستلم</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>الأسم: {{ $order->recipient_name }}</p>
                                                        <p>رقم الهاتف: {{ $order->recipient_phone }}</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-sm btn-default"
                                                            data-dismiss="modal">اغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="payment-{{ $count }}" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">بيانات الدفع</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>من سيدفع: {{ $order->who_pay }}</p>
                                                        <p>حالة الدفع: {{ $order->payment_status }}</p>
                                                        <p>الرقم التعريفي لعملية الدفع: {{ $order->payment_id }}</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-sm btn-default"
                                                            data-dismiss="modal">اغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="dates-{{ $count }}" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">بيانات التواريخ</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>تاريخ انشاء الطلب:
                                                            {{ $order->created_at->format('F j, Y') }}</p>
                                                        @if ($order->status === 'استلم المندوب الطلب')
                                                            <p>تاريخ استلام المندوب للطلب:
                                                                {{ $order->updated_at->format('F j, Y') }}</p>
                                                        @endif
                                                        @if ($order->status === 'تم التسليم')
                                                            <p>تاريخ تسليم المندوب للطلب:
                                                                {{ $order->updated_at->format('F j, Y') }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-sm btn-default"
                                                            data-dismiss="modal">اغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($order->delivery_order)
                                            <div class="modal fade" id="delivery-{{ $count }}"
                                                style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">بيانات المندوب</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>الاسم: {{ $order->delivery_order->delivery_name }}</p>
                                                            <p>اسم المستخدم الخاص بالمندوب:
                                                                {{ $order->delivery_order->delivery_username }}</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-sm btn-default"
                                                                data-dismiss="modal">اغلاق</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($order->details))
                                            <div class="modal fade" id="details-{{ $count }}"
                                                style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">تفاصيل اضافية عن الطلب</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ $order->details }}</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-sm btn-default"
                                                                data-dismiss="modal">اغلاق</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
            $('#orders').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "pageLength": 20,
                "ordering": true,
                "info": false,
                "autoWidth": true,
                "scrollX": true,
                "language": {
                    "sSearch": "",
                    "searchPlaceholder": "البحث في الطلبات",
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
