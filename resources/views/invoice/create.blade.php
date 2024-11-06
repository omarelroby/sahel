@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
اضافة فاتورة
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة
                فاتورة</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>أكمل المتطلبات</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('invoice.index') }}">رجوع</a>
                    </div>
                </div><br>
                <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                    action="{{route('invoice.store')}}" method="post">
                    {{csrf_field()}}

                    <div class="">

                          <div class="row mg-b-20">
                            <div class="parsley-input col-md-4" id="fnWrapper">
                                <label>رقم الفاتورة: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-xl mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="invoice_number" readonly value="{{$invoice_number}}" required="" type="text">
                            </div>
                       <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>اسم العميل: <span class="tx-danger">*</span></label>
                                <select class="form-control" name="client_id" required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>تاريخ الفاتورة: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-xl mg-b-20" data-parsley-class-handler="#lnWrapper"
                                       name="invoice_date" value="{{date('Y-m-d')}}" required="" type="text">
                            </div>
                              <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>تاريخ الاستحقاق: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-xl mg-b-20" data-parsley-class-handler="#lnWrapper"
                                       name="due_date"     type="date">
                            </div>
                              <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>الإجمالي: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-xl mg-b-20" data-parsley-class-handler="#lnWrapper"
                                       name="total_amount"     type="text">
                            </div>
                        </div>
                   </div>
                   <div class="row mg-b-20">
                       <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                           <button class="btn btn-success pd-x-20" id="add_other" type="button"  >إضافة Items </button>
                       </div>
                    </div>

                    <div class="other-blog"></div>
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


<script>
    var y = 1;
    $(document).on('click', '#add_other', function() {
        $('.other-blog').append(`
                            <div class="well row " style="margin-top: 50px;" id="programTag${y}">
                        <div class="parsley-input col-md-12" id="fnWrapper">
                         <a style="text-decoration: none" count="${y}" href="#" class="closeTag btn btn-danger btn-sm" data-dismiss="alert" aria-label="close">&times;     </a>
                          </div>
                            <div class="parsley-input col-md-4" id="fnWrapper">
                                <label>الوصف <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-md mg-b-20"
                                       data-parsley-class-handler="#lnWrapper" name="items[${y}][description]" required="" type="text">
                            </div>
                             <div class="parsley-input col-md-4" id="fnWrapper">
                                <label>سعر الوحدة<span class="tx-danger">*</span></label>
                                <input class="form-control form-control-md mg-b-20"
                                       data-parsley-class-handler="#lnWrapper" name="items[${y}][price_unit]" required="" type="text">
                            </div>
                            <div class="parsley-input col-md-4" id="fnWrapper">
                                <label>العدد<span class="tx-danger">*</span></label>
                                <input class="form-control form-control-md mg-b-20"
                                       data-parsley-class-handler="#lnWrapper" name="items[${y}][quantity]" required="" type="text">
                            </div>
                        </div>
           `);
         y++;
    })

    $(document).on('click', '.closeTag', function() {
        var count = $(this).attr('count');
        $(`#programTag${count}`).remove();
    })



</script>

@endsection
