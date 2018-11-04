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
        {{--<div class="col-xs-12">--}}
            {{--<form action="{{route('dashboard.question.store')}}" method="post" enctype="multipart/form-data">--}}
                {{--{{ csrf_field() }}--}}
                    {{--<fieldset>--}}

                    {{--<legend>فایل اکسل</legend>--}}
                    {{--<div class="row">--}}
                        {{--<input type="file" name="file">--}}

                    {{--</div>--}}
                    {{--</fieldset>--}}
                {{--<div class="row">--}}
                    {{--<div class="col-xs-12">--}}
                        {{--<div class="pull-left">--}}
                            {{--<button class="btn-gray">ثبت</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
    </div>
    <div class="head"><h3>سوالات</h3></div>
    <div class="row">
        <div class="col-xs-12">
            <table class="ui very compact table striped" width="100%" id="sortable_tb" cellspacing="0">
                <thead>
                <tr>
                    <th>شماره</th>
                    <th>متن سوال</th>
                    <th>جواب ادمین</th>
                    <th>جواب ها</th>
                    <th>حذف سوال</th>

                </tr>
                </thead>
                <tbody>
                @foreach($questions as  $key =>$question)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $question->text }}</td>
                        <td>@if($question->admin_answer_status)  حواب داده شده@else حواب داده نشده @endif</td>
                        <td>@if($question->admin_answer_status)  <a href="{{route('dashboard.question.answer.index' ,[$question->id])}}">جواب </a>
                        @else حواب داده نشده @endif</td>

                        <td>
                            <form action="/dashboard/question/{{ $question->id }}" method="post">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <button class="btn btn-default" type="submit">حذف</button>
                            </form>
                        </td>


                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <br>

    <div class="row"><a href="{{route('dashboard.question.create')}}"><button class="btn btn-block"> ثبت سوال جدید</button></a> </div>


@endsection

@section('footer')
    <script src="{{asset('js/date/jalaali.js')}}"></script>
    <script src="{{asset('js/date/jquery.Bootstrap-PersianDateTimePicker.js')}}"></script>
    <script src="{{asset('js/upload.min.js')}}"></script>
    <script src="{{asset('js/croppie.js')}}"></script>



@endsection