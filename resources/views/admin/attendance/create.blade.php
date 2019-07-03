@extends ('common.admin')
@section ('content')

<h2 class="brand-header">個別勤怠作成</h2>
<div class="main-wrap">
  <div class="user-info-box clearfix">
    <div class="left-info">
      <img src="https://avatars.slack-edge.com/2019-01-25/532734044915_486bec3294a9f7b34291_192.png"><p class="user-name">Shohei Kanatani</p>
      <i class="fa fa-envelope-o" aria-hidden="true"><p class="user-email">gizumo@test.com</p></i>
    </div>
    <div class="right-info">
      <div class="my-info">
        <p>研修開始日</p>
        <div class="study-hour-box clearfix">
          <p class="study-hour study-date"><span>2019/07/02</span></p>
        </div>
      </div>
    </div>
  </div>
  <div class="attendance-modify-box">
    <form method="POST" action="/admin/attendance/4/user" accept-charset="UTF-8"><input name="_token" type="hidden" value="dGHHSp0GEt2BCJE2VmBK6fq5uufqfC9jFF9L99aX">
      <input name="user_id" type="hidden" value="4">
      <div class="form-group date-form">
        <input class="form-control" name="date" type="date">
      </div>
      <div class="form-group">
        <input class="form-control" name="start_time" type="time">
      </div>
      <p class="to-time">to</p>
      <div class="form-group">
        <input class="form-control" name="end_time" type="time">
      </div>
      <button class="btn btn-modify" type="submit">作成</button>
    </form>
    <form method="POST" action="/admin/attendance/4/user" accept-charset="UTF-8"><input name="_token" type="hidden" value="dGHHSp0GEt2BCJE2VmBK6fq5uufqfC9jFF9L99aX">
      <input name="user_id" type="hidden" value="4">
      <input name="start_time" type="hidden">
      <input name="end_time" type="hidden">
      <input name="absent_flg" type="hidden" value="1">
      <input name="absent_reason" type="hidden" value="管理画面から登録">
      <input id="date-target" name="date" type="hidden">
      <button class="btn btn-danger" type="submit">欠席</button>
    </form>
  </div>
</div>

@endsection



