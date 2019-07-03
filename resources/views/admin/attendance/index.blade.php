@extends ('common.admin')
@section ('content')

<h2 class="brand-header">勤怠情報</h2>
<div class="main-wrap">
  <div class="btn-wrapper">
    <div class="my-info day-info">
      <p>想定出席人数</p>
      <div class="study-hour-box clearfix">
        <div class="userinfo-box"><i class="fa fa-user fa-2x" aria-hidden="true"></i></div>
        <p class="study-hour"><span>3</span>人</p>
      </div>
    </div>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table">
      <caption><p>出社済み</p></caption>
      <thead>
        <tr class="row">
          <th class="col-xs-1"></th>
          <th class="col-xs-2">名前</th>
          <th class="col-xs-2">研修開始日</th>
          <th class="col-xs-3">出社時間</th>
          <th class="col-xs-2">修正申請</th>
          <th class="col-xs-2">詳細</th>
        </tr>
      </thead>
      <tbody>
        <tr class="row">
          <td class="col-xs-1"><img src="https://avatars.slack-edge.com/2019-01-25/532734044915_486bec3294a9f7b34291_192.png" class="avatar-img"></td>
          <td class="col-xs-2">Kiyoshi Sakata</td>
          <td class="col-xs-2">2019/07/02</td>
          <td class="col-xs-3">09:45</td>
          <td class="col-xs-2">-</td>
          <td class="col-xs-2"><a href="/admin/attendance/1/user" class="btn btn-sucssess"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="content-wrapper table-responsive attendance-table">
    <table class="table">
      <caption><p class="still">出社未登録</p></caption>
      <thead>
        <tr class="row">
          <th class="col-xs-1"></th>
          <th class="col-xs-4">名前</th>
          <th class="col-xs-4">研修開始日</th>
          <th class="col-xs-3">詳細</th>
        </tr>
      </thead>
      <tbody>
        <tr class="row">
          <td class="col-xs-1"><img src="https://avatars.slack-edge.com/2019-01-11/521652138498_a80d324258d73c87ad2e_192.jpg" class="avatar-img"></td>
          <td class="col-xs-4">Daichi Ando</td>
          <td class="col-xs-4">2017/04/03</td>
          <td class="col-xs-3"><a href="/admin/attendance/2/user" class="btn btn-sucssess"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="content-wrapper table-responsive attendance-table">
    <table class="table">
      <caption><p class="absence">欠席</p></caption>
      <thead>
        <tr class="row">
          <th class="col-xs-1"></th>
          <th class="col-xs-4">名前</th>
          <th class="col-xs-4">研修開始日</th>
          <th class="col-xs-3">詳細</th>
        </tr>
      </thead>
      <tbody>
        <tr class="row">
          <td class="col-xs-1"><img src="https://avatars.slack-edge.com/2019-01-25/532734044915_486bec3294a9f7b34291_192.png" class="avatar-img"></td>
          <td class="col-xs-4">Shohei Kanatani</td>
          <td class="col-xs-4">2017/04/03</td>
          <td class="col-xs-3"><a href="/admin/attendance/4/user" class="btn btn-sucssess"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@endsection


