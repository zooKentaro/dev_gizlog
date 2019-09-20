@extends ('common.user')
@section ('content')

<h2 class="brand-header">マイページ</h2>

<div class="main-wrap">
  <div class="btn-wrapper">
    <div class="my-info day-info">
      <p>学習経過日数</p>
      <div class="study-hour-box clearfix">
        <div class="userinfo-box"><img src="{{ $user->avatar }}"></div>
        <p class="study-hour"><span>{{ $totalDays }}</span>日</p>
      </div>
    </div>
    <div class="my-info">
      <p>累計学習時間</p>
      <div class="study-hour-box clearfix">
        <div class="userinfo-box"><img src="{{ $user->avatar }}"></div>
        <p class="study-hour"><span>{{ $totalTimes }}</span>時間</p>
      </div>
    </div>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table">
      <thead>
        <tr class="row">
          <th class="col-xs-2">date</th>
          <th class="col-xs-3">start time</th>
          <th class="col-xs-3">end time</th>
          <th class="col-xs-2">state</th>
          <th class="col-xs-2">request</th>
        </tr>
      </thead>
      <tbody>
        @foreach($myAttendances as $myAttendance)
          @if(empty($myAttendance->start_time) && empty($myAttendance->end_time))
            <tr class="row absent-row">
              <td class="col-xs-2">{{ $myAttendance->created_at->format('m-d (D)') }}</td>
              <td class="col-xs-3">{{ empty($myAttendance->start_time) ? '-' : $myAttendance->start_time->format('H:i') }}</td>
              <td class="col-xs-3">{{ empty($myAttendance->end_time) ? '-' : $myAttendance->end_time->format('H:i') }}</td>
              <td class="col-xs-2">欠席</td>
              <td class="col-xs-2">{{ $myAttendance->modification_flg === 1 ? '申請中' : '-'  }}</td>
            </tr>
          @elseif(!empty($myAttendance->start_time) && empty($myAttendance->end_time))
            <tr class="row">
              <td class="col-xs-2">{{ $myAttendance->created_at->format('m-d (D)') }}</td>
              <td class="col-xs-3">{{ empty($myAttendance->start_time) ? '-' : $myAttendance->start_time->format('H:i') }}</td>
              <td class="col-xs-3">{{ empty($myAttendance->end_time) ? '-' : $myAttendance->end_time->format('H:i') }}</td>
              <td class="col-xs-2">研修中</td>
              <td class="col-xs-2">{{ $myAttendance->modification_flg === 1 ? '申請中' : '-'  }}</td>
            </tr>
          @else
            <tr class="row">
              <td class="col-xs-2">{{ $myAttendance->created_at->format('m-d (D)') }}</td>
              <td class="col-xs-3">{{ empty($myAttendance->start_time) ? '-' : $myAttendance->start_time->format('H:i') }}</td>
              <td class="col-xs-3">{{ empty($myAttendance->end_time) ? '-' : $myAttendance->end_time->format('H:i') }}</td>
              <td class="col-xs-2">出社</td>
              <td class="col-xs-2">{{ $myAttendance->modification_flg === 1 ? '申請中' : '-'  }}</td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
