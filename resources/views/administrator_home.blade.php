@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body text-center">
                    <p class="font-weight-bold">管理者</p>
                    <a class="btn btn-primary w-50 mb-3" href="{{ route('reservations.index') }}">全予約一覧</a><br/>
                    <a class="btn btn-primary w-50 mb-3" href="{{ route('rooms.index') }}">会議室一覧</a><br/>
                    <a class="btn btn-primary w-50 mb-3" href="{{ route('rooms.create') }}">会議室追加</a><br/>
                    <a class="btn btn-primary w-50 mb-3" href="{{ route('users.index') }}">ユーザー一覧</a><br/>
                    <a class="btn btn-primary w-50 mb-3" href="{{ route('items.create') }}">備品追加</a><br/>
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
