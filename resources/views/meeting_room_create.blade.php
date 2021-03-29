@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>会議室追加</div>
                            <div class="font-weight-bold text-danger">管理者</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('rooms.store') }}">
                            @csrf
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif


                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Meeting room name') }} <span class="badge badge-danger">必須</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="max_use_hour" class="col-md-4 col-form-label text-md-right">{{ __('Max use hour') }}</label>

                                <div class="col-md-6 d-flex align-items-center">
                                    <input id="max_use_hour" type="text" class="mr-3 form-control w-75 @error('max_use_hour') is-invalid @enderror" name="max_use_hour" value="{{ old('max_use_hour') }}" autocomplete="max_use_hour" autofocus>
                                    <span>時間</span>
                                    @error('max_use_hour')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="needs_approval" class="col-md-4 col-form-label text-md-right">{{ __('Needs approval') }} <span class="badge badge-danger">必須</span></label>
                                <div class="col-md-6">
                                    <select id="needs_approval" type="text" class="form-control @error('needs_approval') is-invalid @enderror" name="needs_approval"  required autocomplete="needs_approval" autofocus>
                                        <option value="1" {{ (old('needs_approval') == '1') ? 'selected' : ''  }}>する</option>
                                        <option value="0" {{ (old('needs_approval') == '0') ? 'selected' : ''  }}>しない</option>
                                    </select>
                                    @error('needs_approval')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn.btn-info mx-auto d-block">
                                        {{ __('Add meeting room') }}
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
