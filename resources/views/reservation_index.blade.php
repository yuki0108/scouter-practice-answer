@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-header">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>予約一覧</div>
                        <div>
                          @if ($isAdmin)
                            <dis class="font-weight-bold text-danger">管理者</dis>
                          @else
                            <div class="font-weight-bold text-danger">一般ユーザー</div>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr class="table-secondary">
                                <th>予約番号</th>
                                <th>会議室名</th>
                                <th>タイトル</th>
                                <th>予約者</th>
                                <th>備品</th>
                                <th>承認状態</th>
                                <th>開始時刻</th>
                                <th>終了時刻</th>
                                <th>状態</th>
                                <th>予約を編集</th>
                                <th>予約を削除</th>
                            </tr>
                            @foreach ($reservations as $reservation)
                              <tr>
                                <td>
                                    {{ $reservation->reservation_number }}
                                </td>
                                <td>
                                    {{ $reservation->meetingRoom->name }}
                                </td>
                                <td>
                                    @if ($isAdmin || $userId == $reservation->user_id)
                                        {{ $reservation->title }}
                                    @else
                                        非公開
                                    @endif
                                </td>
                                <td>
                                    @if ($isAdmin || $userId == $reservation->user_id)
                                        {{ $reservation->user->name }}
                                    @else
                                        非公開
                                    @endif
                                </td>
                                <td>
                                    @if ($isAdmin || $userId == $reservation->user_id)
                                        @if ($reservation->items->count() > 0)
                                            @foreach ($reservation->items as $item)
                                                {{ $item->name }}<br>
                                            @endforeach
                                        @else
                                            備品なし
                                        @endif
                                    @else
                                        非公開
                                    @endif
                                </td>
                                <td>
                                    @if ($isAdmin || $userId == $reservation->user_id)
                                        @if ($reservation->meetingRoom->needs_approval)
                                            @if (isset($reservation->is_approved) == false)
                                                未承認<br>
                                                @if ($isAdmin)
                                                    <a href="{{ route('reservations.approve', ['id' => $reservation->id]) }}">承認する</a><br>
                                                    <a href="{{ route('reservations.reject', ['id' => $reservation->id]) }}">拒否する</a>
                                                @endif
                                            @elseif ($reservation->is_approved == false)
                                                拒否
                                            @elseif ($reservation->is_approved)
                                                承認済み
                                            @endif
                                        @else
                                            承認必要<br>なし
                                        @endif
                                    @else
                                        非公開
                                    @endif
                                </td>
                                <td>
                                    {{ date_create($reservation->start_time)->format('Y年m月d日H時i分') }}
                                </td>
                                <td>
                                    {{ date_create($reservation->end_time)->format('Y年m月d日H時i分') }}
                                </td>
                                <td>
                                    @if ($reservation->isCompleted())
                                        完了
                                    @else
                                        未完了
                                    @endif
                                </td>
                                  <td>
                                      @if ($isAdmin || $userId == $reservation->user_id)
                                          <a href="{{ route('reservations.edit', ['id' => $reservation->id]) }}" class="btn btn-primary">編集</a>
                                      @else
                                          -
                                      @endif
                                  </td>
                                  <td>
                                      @if ($isAdmin || $userId == $reservation->user_id)
                                          <a href="{{ route('reservations.delete', ['id' => $reservation->id]) }}" class="btn btn-danger">削除</a>
                                      @else
                                          -
                                      @endif
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
