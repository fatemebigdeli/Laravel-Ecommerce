@extends('admin.layout.admin')

@section('title')
    index brands
@endsection
@section('content')
<!-- Content Row -->
<div class="row">

    <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
        <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4" >
            <h5 class="font-weight-bold mb-3 mb-md-0">لیست برندها ({{ $brands->total() }})</h5>
            <div>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.brands.create') }}">
                    <i class="fa fa-plus"></i>
                        ایجاد برند
                    </a>
            </div>
        </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $key => $brand)
                <tr>
                    <th>{{ $brands->firstitem() + $key }}</th>
                    <th>{{ $brand->name }}</th>
                    <th>
                        <span class="{{ $brand->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                            {{ $brand->is_active }}
                        </span>
                    </th>
                    <th><a class="btn btn-sm btn-outline-success" href="{{ route('admin.brands.show' , ['brand'=> $brand->id]) }}">نمایش</a>
                    <a class="btn btn-sm btn-outline-info mr-3" href="{{ route('admin.brands.edit' , ['brand'=> $brand->id]) }}">ویرایش</a> </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $brands->render() }}
    </div>
    </div>
</div>
@endsection


