@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body text-center">
                    <p class="font-weight-bold">一般ユーザー</p>
                    <a class="btn btn-primary w-50 mb-3" href="{{ route('reservations.index') }}">予約一覧</a><br/>
                    <a class="btn btn-primary w-50 mb-3" href="{{ route('reservations.create') }}">会議室予約</a><br/>
                    <br/>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
