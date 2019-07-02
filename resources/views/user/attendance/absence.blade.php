@extends ('common.user')
@section ('content')

<h2 class="brand-header">欠席登録</h2>
<div class="main-wrap">
  <div class="container">
    <form method="POST" action="/attendance/absence" accept-charset="UTF-8">
      <input name="date" type="hidden" value="">
      <input name="absent_flg" type="hidden" value="">
      <input name="user_id" type="hidden" value="">
      <div class="form-group">
        <textarea class="form-control" placeholder="欠席理由を入力してください。" name="absent_reason" cols="50" rows="10"></textarea>
        <span class="help-block"></span>
      </div>
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="register">
    </form>
  </div>
</div>

@endsection

