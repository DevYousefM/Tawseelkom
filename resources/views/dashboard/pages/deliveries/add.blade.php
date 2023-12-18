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
                    <h1 class="m-0 text-dark">أضافة مندوب</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <!-- form start -->
                <form role="form" action="{{ route('store.deliveries') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">ألاسم</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                id="name" placeholder="أسم المندوب">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">أسم المستخدم <span style="color: red;font-size:12px">
                                    (مطلوب عند تسجيل الدخول ويجب ان يكون غير مكرر مع مندوب
                                    اخر)
                                </span></label>
                            <input value="{{ old('username') }}" type="text" name="username" class="form-control"
                                id="username" placeholder="اسم المستخدم">
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">كلمة المرور</label>
                            <div class="position-relative">
                                <input value="{{ old('password') }}" type="password" name="password" class="form-control"
                                    id="password" placeholder="كلمة المرور">
                                <div class="password-toggle">
                                    <i class="fa fa-eye-slash">
                                    </i>
                                </div>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">تأكيد كلمة المرور</label>
                            <div class="position-relative">
                                <input value="{{ old('password_confirmation') }}" type="password"
                                    name="password_confirmation" class="form-control" id="password_confirmation"
                                    placeholder="تأكيد كلمة المرور">
                                <div class="password-toggle">
                                    <i class="fa fa-eye-slash">
                                    </i>
                                </div>
                            </div>
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
