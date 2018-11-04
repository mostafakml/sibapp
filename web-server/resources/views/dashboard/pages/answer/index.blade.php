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


    <div class="head"><h3>سوالات</h3></div>
    <div class="row">
        <div class="col-xs-12">
            <table class="ui very compact table striped" width="100%" id="sortable_tb" cellspacing="0">
                <thead>
                <tr>
                    <th>شماره</th>
                    <th>متن جواب</th>

                </tr>
                </thead>
                <tbody>
                @foreach($answers as  $key =>$answer)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $answer->text }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <br>



@endsection

@section('footer')
    <script src="{{asset('js/date/jalaali.js')}}"></script>
    <script src="{{asset('js/date/jquery.Bootstrap-PersianDateTimePicker.js')}}"></script>
    <script src="{{asset('js/upload.min.js')}}"></script>
    <script src="{{asset('js/croppie.js')}}"></script>



@endsection