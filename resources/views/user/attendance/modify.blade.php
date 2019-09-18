@extends ('common.user')
@section ('content')

<h2 class="brand-header">修正申請</h2>
<div class="main-wrap">
  <div class="container">
    {{ Form::open(['route' => ['modification.update', Auth::id()], 'method' => 'PUT']) }}
      <div class="form-group form-size-small @if(!empty($errors->first('request_day'))) has-error @endif">
        <input class="form-control" name="request_day" type="date" value="">
        <span class="help-block">{{ $errors->first('request_day') }}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('modification_reason'))) has-error @endif">
        {{ Form::textarea('modification_reason', null, ['class' => 'form-control', 'placeholder' => '修正申請の内容を入力してください。']) }}
        <span class="help-block">{{ $errors->first('modification_reason') }}</span>
        {{-- <textarea class="form-control" placeholder="修正申請の内容を入力してください。" name="modification_reason" cols="50" rows="10"></textarea> --}}
      </div>
      <input class="btn btn-success pull-right" type="submit" value="申請">
      {{ Form::hidden('user_id', Auth::id()) }}
    {{ Form::close() }}
  </div>
</div>

@endsection
