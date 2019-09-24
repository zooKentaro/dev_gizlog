@extends ('common.user')
@section ('content')

<h2 class="brand-header">欠席登録</h2>
<div class="main-wrap">
  <div class="container">
    {{ Form::open(['route' => ['absence.store', Auth::id()]]) }}
      <div class="form-group @if(!empty($errors->first('absence_reason'))) has-error @endif">
        {{ Form::textarea('absence_reason', null, [ 'class' => 'form-control', 'placeholder' => '欠席理由を入力してください。']) }}
        <span class="help-block">{{ $errors->first('absence_reason') }}</span>
      </div>
      {{ Form::input('hidden', 'registration_date', Carbon::today()->format('Y-m-d'), ['id' => 'date-time']) }}
      {{ Form::input('submit', 'confirm', '登録', ['class' => 'btn btn-success pull-right']) }}
    {{ Form::close() }}
  </div>
</div>

@endsection
