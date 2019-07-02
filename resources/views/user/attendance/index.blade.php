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
      <a class="button start-btn" id="register-attendance" href=#openModal>出社時間登録</a>
  </div>
  <ul class="button-wrap">
    <li>
      <a class="at-btn absence" href="/attendance/absence">欠席登録</a>
    </li>
    <li>
      <a class="at-btn modify" href="/attendance/modify">修正申請</a>
    </li>
    <li>
      <a class="at-btn my-list" href="/attendance/mypage">マイページ</a>
    </li>
  </ul>
</div>

<div id="openModal" class="modalDialog">
  <div>
    <div class="register-text-wrap">
      <p>Cancelを押して再度登録してください</p>
    </div>
    <div class="register-btn-wrap">
      @if (empty($attendance))
        {!! Form::open(['route' => 'attendance.register.start']) !!}
          {!! Form::input('hidden', 'start_time', null, ['id' => 'date-time-target']) !!}
      @else
        {!! Form::open(['route' => ['attendance.register.end', $attendance->id], 'method' => 'put']) !!}
          {!! Form::input('hidden', 'end_time', null, ['id' => 'date-time-target']) !!}
      @endif
        {!! Form::input('hidden', 'user_id', Auth::id() ) !!}
        {!! Form::input('hidden', 'date', Carbon::now()->format('Y-m-d')) !!}
        <a href="#close" class="cancel-btn">Cancel</a>
        {!! Form::submit('Yes', ['class' => 'yes-btn']) !!}
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection

