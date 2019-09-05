@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {{ Form::open(['route' => ['question.confirm']]) }}
      <div class="form-group @if(!empty($errors->first('tag_category_id'))) has-error @endif">
        {{ Form::input('hidden', 'user_id', Auth::id(), ['class' => 'form-control']) }}
        {{ Form::input('hidden', 'id', null, ['class' => 'form-control']) }}
        {{ Form::select('tag_category_id', $tagCategories->pluck('name', 'id'), null, ['class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id', 'placeholder' => 'Select category']) }}
        <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('title'))) has-error @endif">
        {{ Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'title']) }}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('content'))) has-error @endif">
        {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) }}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {{ Form::submit('create', ['class' => 'btn btn-success pull-right', 'name' => 'confirm']) }}
    {{ Form::close() }}
  </div>
</div>

@endsection

