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
                        <form method="POST" action="{{ route('users.update') }}">
                            @method('PUT')
                            @csrf
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <div class="form-group row">
                                <label for="is_administrator" class="col-md-4 col-form-label text-md-right">権限 <span class="badge badge-danger">必須</span></label>
                                <div class="col-md-6">
                                    <select id="is_administrator" name="is_administrator" class="form-control">
                                        @foreach(config('user_type') as $index => $type_name)
                                            <option value="{{ $index }}" {{ ($user->is_administrator == $index) ? 'selected' : ''  }}>
                                                {{ $type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" id="id" name="id" value="{{$user->id}}">
                            <div class="form-group row">
                                <label for="user_name_id" class="col-md-4 col-form-label text-md-right">{{ __('UserNameId') }} <span class="badge badge-danger">必須</span></label>

                                <div class="col-md-6">
                                    <input id="user_name_id" type="text" class="form-control @error('user_name_id') is-invalid @enderror" name="user_name_id" value="{{ $user->user_name_id }}" required autocomplete="user_name_id" autofocus>

                                    @error('user_name_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User name') }} <span class="badge badge-danger">必須</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="zipcode" class="col-md-4 col-form-label text-md-right">{{ __('zipcode') }} <span class="badge badge-danger">必須</span></label>

                                <div class="col-md-6">
                                    <input id="zipcode" type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ $user->zipcode }}" required  autocomplete="zipcode" autofocus>
                                    @error('zipcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('address') }} <span class="badge badge-danger">必須</span></label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user->address }}" required  autocomplete="address" autofocus>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }} <span class="badge badge-danger">必須</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('phone_number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $user->phone_number }}" autocomplete="phone_number" autofocus>
                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="department_id" class="col-md-4 col-form-label text-md-right">{{ __('department') }} <span class="badge badge-danger">必須</span></label>
                                <div class="col-md-6">
                                    <select id="department_id" type="text" class="form-control @error('department_id') is-invalid @enderror" name="department_id" required autocomplete="department_id" autofocus>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ ($user->department_id == $department->id) ? 'selected' : ''  }}>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="position_id" class="col-md-4 col-form-label text-md-right">{{ __('position') }}</label>
                                <div class="col-md-6">
                                    <select id="position_id" type="text" class="form-control @error('position_id') is-invalid @enderror" name="position_id" autocomplete="position_id" autofocus>
                                        <option value=""> --- </option>
                                        @foreach($positions as $position)
                                            <option value="{{ $position->id }}" {{ ($user->position_id == $position->id) ? 'selected' : ''  }}>{{ $position->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('position_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn.btn-info mx-auto d-block">
                                        {{ __('Update user') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="/users/index" class="btn btn-primary mt-3">戻る</a>
            </div>
        </div>
    </div>
@endsection
