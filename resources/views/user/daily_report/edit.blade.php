@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['daily_report.update', $report->id], 'method' => 'PUT']) !!}
      <input class="form-control" name="user_id" type="hidden">
      <div class="form-group form-size-small @if (!empty($errors->first('reporting_time'))) has-error @endif">
        <input class="form-control" name="reporting_time" type="date" value="{!! $report->reporting_time->format('Y-m-d') !!}">
        <span class="help-block">{{ $errors->first('reporting_time') }}</span>
      </div>
      <div class="form-group @if (!empty($errors->first('title'))) has-error @endif">
        <input class="form-control" placeholder="Title" name="title" type="text" value="{{ $report->title }}">
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group @if (!empty($errors->first('contents'))) has-error @endif">
        <textarea class="form-control" placeholder="本文" name="contents" cols="50" rows="10">{{ $report->contents }}</textarea>
        <span class="help-block">{{ $errors->first('contents') }}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">Update</button>
    {!! Form::close() !!}
  </div>
</div>

@endsection

