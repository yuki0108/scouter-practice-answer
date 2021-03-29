@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>ユーザー編集</div>
                            <div class="font-weight-bold text-danger">管理者</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('items.store') }}">
                            @csrf
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif


                            <div class="form-group row">
                                <label for="item_name" class="col-md-4 col-form-label text-md-right">{{ __('Item name') }} <span class="badge badge-danger">必須</span></label>

                                <div class="col-md-6">
                                    <input id="item_name" type="text" class="form-control @error('item_name') is-invalid @enderror" name="item_name" value="{{ old('item_name') }}" autocomplete="item_name" autofocus>

                                    @error('item_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn.btn-info mx-auto d-block">
                                        {{ __('Add item') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="/" class="btn btn-primary mt-3">戻る</a>
            </div>
        </div>
    </div>
@endsection
