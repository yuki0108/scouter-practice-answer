@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>会議室一覧</div>
                        <div class="font-weight-bold text-danger">管理者</div>
                      </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr class="table-secondary">
                                <th>会議室名</th>
                                <th>上限利用時間</th>
                                <th>承認</th>
                                <th>予約を編集</th>
                                <th>予約を削除</th>
                            </tr>
                            @foreach ($meetingRooms as $room)
                              <tr>
                                <td>{{ $room->name }}</td>
                                <td>@if (isset($room->max_use_hour))
                                        {{ $room->max_use_hour }} 時間
                                    @else
                                        上限利用時間なし
                                    @endif</td>
                                <td>
                                    @if ($room->needs_approval)
                                        承認制
                                    @else
                                        承認必要なし
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('rooms.edit', ['id' => $room->id]) }}" class="btn btn-primary">編集</a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('rooms.delete', ['id' => $room->id]) }}" class="btn btn-danger">削除</a>
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
