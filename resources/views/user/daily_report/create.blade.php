@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'daily_report.store']) !!}
      <input class="form-control" name="user_id" type="hidden">
      <input class="form-control" name="deleted_at" type="hidden" value="NULL">
      <div class="form-group form-size-small @if (!empty($errors->first('reporting_time'))) has-error @endif">
        <input class="form-control" name="reporting_time" type="date">
        <span class="help-block">{{ $errors->first('reporting_time') }}</span>
      </div>
      <div class="form-group @if (!empty($errors->first('title'))) has-error @endif">
        <input class="form-control" placeholder="Title" name="title" type="text">
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group @if (!empty($errors->first('contents'))) has-error @endif">
        <textarea class="form-control" placeholder="Content" name="contents" cols="50" rows="10"></textarea>
        <span class="help-block">{{ $errors->first('contents') }}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">Add</button>
    {!! Form::close() !!}
  </div>
</div>

@endsection

