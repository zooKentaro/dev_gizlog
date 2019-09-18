@extends ('common.user')
@section ('content')

<h2 class="brand-header">勤怠登録</h2>

<div class="main-wrap">

  <div id="clock" class="light">
    <div class="display">
      <div class="weekdays"></div>
      <div class="today"></div>
      <div class="digits"></div>
    </div>
  </div>
  <div class="button-holder">
    @if(empty($todayDate['start_time']))
      <a class="button start-btn" id="register-attendance" href=#openModal>出社時間登録</a>
    @elseif(empty($todayDate['end_time']))
      <a class="button end-btn" id="register-attendance" href=#openModal>退社時間登録</a>
    @else
      <a class="button disabled" id="register-attendance" href=#openModal>退社済み</a>
    @endif
  </div>
  <ul class="button-wrap">
    <li>
      <a class="at-btn absence" href="{{ route('absence') }}">欠席登録</a>
    </li>
    <li>
      <a class="at-btn modify" href="{{ route('modify') }}">修正申請</a>
    </li>
    <li>
      <a class="at-btn my-list" href="{{ route('mypage') }}">マイページ</a>
    </li>
  </ul>
</div>

<div id="openModal" class="modalDialog">
  <div>
    <div class="register-text-wrap"><p>12:38 で出社時間を登録しますか？</p></div>
    <div class="register-btn-wrap">
      @if (empty($todayDate['start_time']))
        {{ Form::open(['route' => ['attendance.store']]) }}
      @elseif(empty($todayDate['end_time']))
        {{ Form::open(['route' => ['attendance.update', $todayDate['id']], 'method' => 'PUT']) }}
      @else
        //何も送信しないようにする
      @endif
        <input id="date-time-target" name="start_time" type="hidden" value="2019-07-03 12:38:41">
        <input name="user_id" type="hidden" value="{{ $user->id }}">
        <input id="date-time" name="date" type="hidden" value="2019-07-03">
        <a href="#close" class="cancel-btn">Cancel</a>
        <input class="yes-btn" type="submit" value="Yes">
      {{ Form::close() }}
    </div>
  </div>
</div>

@endsection
