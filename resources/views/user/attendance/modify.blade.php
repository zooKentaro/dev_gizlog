@extends ('common.user')
@section ('content')

<h2 class="brand-header">修正申請</h2>
<div class="main-wrap">
  <div class="container">
    <form method="POST" action="/attendance/modify" accept-charset="UTF-8">
      <input name="user_id" type="hidden" value="">
      <div class="form-group form-size-small">
        <input class="form-control" name="date" type="date" value="">
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="修正申請の内容を入力してください。" name="request_content" cols="50" rows="10"></textarea>
        <span class="help-block"></span>
      </div>
      <input class="btn btn-success pull-right" type="submit" value="submit">
    </form>
  </div>
</div>

@endsection

