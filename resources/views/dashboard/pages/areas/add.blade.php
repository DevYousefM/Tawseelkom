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
                    <h1 class="m-0 text-dark">أضافة مركز</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <!-- form start -->
                <form role="form" action="{{ route('store.areas') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="area">المركز</label>
                            <input type="text" name="area" value="{{ old('area') }}" class="form-control"
                                id="area" placeholder="أسم المركز">
                            @error('area')
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
