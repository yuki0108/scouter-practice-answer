@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>ユーザー一覧</div>
                            <div class="font-weight-bold text-danger">管理者</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <form method="GET" action="{{ route('users.index') }}">
                                @csrf
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <div class="form-group row">
                                    <label for="user_name_id" class="col-md-4 col-form-label text-md-right">{{ __('UserNameId') }}</label>

                                    <div class="col-md-6">
                                        <input id="user_name_id" type="text" class="form-control @error('user_name_id') is-invalid @enderror" name="user_name_id" value="{{  Request::get("user_name_id") }}" autocomplete="user_name_id" autofocus>

                                        @error('user_name_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{  Request::get("name") }}" autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('phone_number') }}</label>

                                    <div class="col-md-6">
                                        <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ Request::get("phone_number") }}" autocomplete="phone_number" autofocus>

                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="department_id" class="col-md-4 col-form-label text-md-right">{{ __('department') }}</label>
                                    <div class="col-md-6">
                                        <select id="department_id" type="text" class="form-control" name="department_id" autocomplete="department_id" autofocus>
                                            <option value=""> --- </option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}" {{ (Request::get("department_id") == $department->id) ? 'selected' : '' }}>{{ $department->name }}</option>
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
                                        <select id="position_id" type="text" class="form-control" name="position_id" autocomplete="position_id" autofocus>
                                            <option value=""> --- </option>
                                            @foreach($positions as $position)
                                                <option value="{{ $position->id }}" {{ (Request::get("position_id") == $position->id) ? 'selected' : '' }}>{{ $position->name }}</option>
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
                                            {{ __('Search users') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <table class="table table-bordered">
                            <tr class="table-secondary">
                                <th>ユーザーID</th>
                                <th>氏名</th>
                                <th>メールアドレス</th>
                                <th>携帯電話</th>
                                <th>所属部署</th>
                                <th>役職</th>
                                <th>ユーザー編集</th>
                            </tr>
                            @foreach ($users as $user)
                              <tr>
                                <td>
                                    <a href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->user_name_id }}</td></a>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td> {{ $user->department->name }}</td>
                                <td>@if(isset($user->position_id))
                                        {{ $user->position->name }}
                                    @else
                                        未入力
                                    @endif
                                </td>
                                <td class="text-center">
                                  <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary">編集</a>
                                </td>
                              </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div>
                    <a href="/" class="btn btn-primary mt-3">戻る</a>
                </div>
            </div>
        </div>
    </div>
@endsection
