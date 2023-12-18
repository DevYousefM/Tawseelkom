@extends('dashboard.layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/dist/css/style.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 d-flex justify-content-between">
                    <h1 class="m-0 text-dark">أضافة نوع شحنة</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <!-- form start -->
                <form role="form" action="{{ route('store.shipment_types') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">نوع الشحنة</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                id="title" placeholder="نوع الشحنة">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="desc">وصف النوع</label>
                            <textarea name="desc" class="form-control" id="desc" placeholder="وصف نوع الشحنة">{{ old('desc') }}</textarea>
                            @error('desc')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">أضافة</button>
                    </div>
                </form>
            </div>
        </div><!-- container-fluid -->
    </section>
@endsection
