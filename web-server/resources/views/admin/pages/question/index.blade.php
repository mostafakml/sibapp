@extends('admin.template.admin_template')
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


    <div class="head"><h3>سوالات</h3></div>
    <div class="row">
        <div class="col-xs-12">
            <table class="ui very compact table striped" width="100%" id="sortable_tb" cellspacing="0">
                <thead>
                <tr>
                    <th>شماره</th>
                    <th>متن سوال</th>
                    <th>جواب ادمین</th>
                    <th>حذف سوال</th>
                    <th>جواب سوال</th>

                </tr>
                </thead>
                <tbody>
                @foreach($questions as  $key =>$question)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $question->text }}</td>
                        <td>@if($question->admin_answer_status)  حواب داده شده@else حواب داده نشده @endif</td>
                        <td>
                            <form action="/admin/question/{{ $question->id }}" method="post">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <button class="btn btn-default" type="submit">حذف</button>
                            </form>
                        </td>
                        <td><a href="{{route('admin.question.answer.create' ,[$question->id])}}">جواب</a> </td>


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