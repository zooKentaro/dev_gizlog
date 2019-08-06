@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'daily_report.store']) !!}
      <input class="form-control" name="user_id" type="hidden">
      <input class="form-control" name="deleted_at" type="hidden" value="NULL">
      <div class="form-group form-size-small">
        <input class="form-control" name="reporting_time" type="date">
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        <input class="form-control" placeholder="Title" name="title" type="text">
        @if($errors->has('title'))
          <div class="error">
            <p>{{ $errors->first('title') }}</p>
          </div>
        @endif
        <span class="help-block"></span>
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="Content" name="contents" cols="50" rows="10"></textarea>
        <span class="help-block"></span>
        @if($errors->has('contents'))
          <div class="error">
            <p>{{ $errors->first('contents') }}</p>
          </div>
        @endif
      </div>
      <button type="submit" class="btn btn-success pull-right">Add</button>
    {!! Form::close() !!}
  </div>
</div>

@endsection

