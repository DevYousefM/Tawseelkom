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
                    <h1 class="m-0 text-dark">تعديل مركز</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('dashboard.components.success', ['title' => 'area_updated'])
            <div class="card card-primary">
                <!-- form start -->
                <form role="form" action="{{ route('update.areas', $area->id) }}" method="post">
                    @csrf
                    @method('post')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="area">المركز</label>
                            <input type="text" name="area" value="{{ $area->area }}" class="form-control"
                                id="area" placeholder="أسم المركز">
                            @error('area')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="in_price">سعر التوصيل ( {{ config('app.custom.currency') }} ) </label>
                            <input value="{{ $area->in_price }}" type="number" name="in_price" class="form-control"
                                id="in_price" placeholder="سعر التوصيل داخل المركز">
                            @error('in_price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </form>
            </div>
        </div><!-- container-fluid -->
    </section>
@endsection
