@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>ユーザー詳細</div>
                        <div class="font-weight-bold text-danger">管理者</div>
                      </div>
                    </div>

                    <div class="card-body">
                        <div class="text-right mb-2">
                            <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary">編集</a>
                        </div>

                        <table class="table table-bordered">
                            <tr>
                                <td>権限</td>
                                <td>
                                    @if($user->is_administrator == 1)
                                        管理者
                                    @else
                                        一般ユーザー
                                    @endif
                                </td>
                            </tr>
                            <tr>
                            <td>氏名</td>
                            <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                              <td>郵便番号</td>
                              <td>{{ $user->zipcode }}</td>
                            </tr>
                            <tr>
                            <td>住所</td>
                            <td>{{ $user->address }}</td>
                            </tr>
                            <tr>
                            <td>メールアドレス</td>
                            <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                            <td>携帯電話</td>
                            <td> {{ $user->phone_number }}</td>
                            </tr>
                            <tr>
                            <td>所属部署</td>
                            <td>{{ $user->department->name }}</td>
                            </tr>
                            <tr>
                            <td>役職</td>
                            <td>
                                @if(isset($user->position_id))
                                    {{ $user->position->name }}
                                @else
                                    未入力
                                @endif
                            </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <a href="/users/index" class="btn btn-primary mt-3">戻る</a>
            </div>
        </div>
    </div>
@endsection
