@extends ('common.user')
@section ('content')

<h2 class="brand-header">修正申請</h2>
<div class="main-wrap">
  <div class="container">
    {{ Form::open(['route' => ['modification.update', Auth::id()], 'method' => 'PUT']) }}
      <div class="form-group form-size-small @if(!empty($errors->first('request_day'))) has-error @endif">
        {{ Form::input('date', 'request_day', null, ['class' => 'form-control']) }}
        <span class="help-block">{{ $errors->first('request_day') }}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('modification_reason'))) has-error @endif">
        {{ Form::textarea('modification_reason', null, ['class' => 'form-control', 'placeholder' => '修正申請の内容を入力してください。']) }}
        <span class="help-block">{{ $errors->first('modification_reason') }}</span>
      </div>
      {{ Form::input('submit', null, '申請', ['class' => 'btn btn-success pull-right']) }}
      {{ Form::hidden('user_id', Auth::id()) }}
    {{ Form::close() }}
  </div>
</div>

@endsection
