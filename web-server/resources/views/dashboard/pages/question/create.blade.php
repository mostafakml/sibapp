@extends('dashboard.template.admin_template')
@section('header')

@endsection
@section('content')

    <div class="head"><h3>ثبت سوال جدید
        </h3></div>
    <div class="col-xs-12 no-gutter">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>

    <div class="col-xs-12 no-gutter">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>

    <div class="row">
        <div class="col-xs-12">
            <form action="{{route('dashboard.question.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <fieldset>

                    <legend>فایل </legend>
                    <div class="row">
                        <input type="file" name="file">
                        @if($errors->has('file'))
                            <small>{{ $errors->first('file')}}</small>
                        @endif


                    </div>
                    </fieldset>

                <fieldset>

                    <legend>متن سوال</legend>
                    <div class="row">
                        <input type="text"  name="text">
                        @if($errors->has('text'))
                            <small>{{ $errors->first('text')}}</small>
                        @endif

                    </div>
                </fieldset>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="pull-left">
                            <button class="btn-gray">ثبت</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('footer')
    <script src="{{asset('js/date/jalaali.js')}}"></script>
    <script src="{{asset('js/date/jquery.Bootstrap-PersianDateTimePicker.js')}}"></script>
    <script src="{{asset('js/upload.min.js')}}"></script>
    <script src="{{asset('js/croppie.js')}}"></script>



@endsection