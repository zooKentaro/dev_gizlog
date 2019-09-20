@extends ('common.user')
@section ('content')

<h2 class="brand-header">欠席登録</h2>
<div class="main-wrap">
  <div class="container">
    {{ Form::open(['route' => ['absence.store', Auth::id()]]) }}
      <div class="form-group @if(!empty($errors->first('absence_reason'))) has-error @endif">
        <textarea class="form-control" placeholder="欠席理由を入力してください。" name="absence_reason" cols="50" rows="10"></textarea>
        <span class="help-block">{{ $errors->first('absence_reason') }}</span>
      </div>
    <input id="date-time" name="registration_date" type="hidden" value="{{ Carbon::today()->format('Y-m-d') }}">
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="登録">
    {{ Form::close() }}
  </div>
</div>

@endsection
