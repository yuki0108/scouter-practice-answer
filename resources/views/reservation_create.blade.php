@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>会議室予約</div>
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
                        <form method="POST" action="{{ route('reservations.store') }}">
                            @csrf
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <div class="form-group row">
                                <label for="meeting_room_id" class="col-md-4 col-form-label text-md-right">{{ __('Meeting room') }}</label>
                                <div class="col-md-6">
                                    <select id="meeting_room_id" type="text" class="form-control @error('meeting_room_id') is-invalid @enderror" name="meeting_room_id"  required autocomplete="meeting_room_id" autofocus>
                                        @foreach($meetingRooms as $room)
                                            <option value="{{ $room->id }}" {{ (old('meeting_room_id') == $room->id) ? 'selected' : ''  }}>{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('meeting_room_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start time') }}</label>

                                <div class="col-md-6">
                                    <input id="start_time" type="datetime-local" min="{{ date("Y-m-d") }}T{{ date("H:m") }}" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time') }}" required autocomplete="start_time" autofocus>

                                    @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('End time') }}</label>

                                <div class="col-md-6">
                                    <input id="end_time" type="datetime-local" min="{{ date("Y-m-d") }}T{{ date("H:m") }}" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time') }}" required autocomplete="end_time" autofocus>

                                    @error('end_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Item') }}</label>
                                <div class="form-inline">
                                    @foreach($items as $item)
                                        <label class="checkbox-inline">
                                            <input id="{{ 'item' . $item->id }}" type="checkbox" name="items[]" value="{{ $item->id }}" {{ in_array((string)$item->id, old("items", []), true)? ' checked' : '' }}>
                                        &nbsp;{{ $item->name }}&nbsp;&nbsp;&nbsp;
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn.btn-info mx-auto d-block">
                                        {{ __('Reserve meeting room') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div>
                  <a href="/" class="btn btn-primary mt-3">戻る</a>
                </div>
            </div>
        </div>
    </div>
@endsection
