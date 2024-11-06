@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
اضافة عميل
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة
                عميل</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">



        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('customers.index') }}">رجوع</a>
                    </div>
                </div><br>
                <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                    action="{{route('customers.store')}}" method="post">
                    {{csrf_field()}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="">

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-4" id="fnWrapper">
                                <label>اسم العميل: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-xl mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="name"   type="text">
                            </div>

                            <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>الهاتف: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-xl mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="phone"   type="text">
                            </div>
                            <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>رقم البطاقة الشخصية: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-xl mg-b-20" data-parsley-class-handler="#lnWrapper"
                                       name="identity"   type="text">
                            </div>
                        </div>


                    </div>

                    <div class="row mg-b-20">

                        <div class="parsley-input col-md-12 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>العنوان: <span class="tx-danger">*</span></label>
                            <textarea class="form-control form-control-xl mg-b-20" data-parsley-class-handler="#lnWrapper"
                                   name="address" required=""  >
                            </textarea>
                        </div>

                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-main-primary pd-x-20" type="submit">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')


<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection
