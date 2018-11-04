@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                        @role('admin')
                        <a href="{{route('admin.question.index')}}">مدیریت سوالات</a>
                        @endrole
                        @role('writer')
                        <a href="{{route('dashboard.question.index')}}">سوالات</a>
                        @endrole
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
