@extends ('common.user')
@section ('content')

<h2 class="brand-header">投稿内容確認</h2>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      {{ $tagName['name'] }}の質問
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $sendQuestion['title'] }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{{ $sendQuestion['content'] }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="btn-bottom-wrapper">
      @if(isset($sendQuestion['id']))
        {{ Form::open(['route' => ['question.update', $sendQuestion['id']], 'method' => 'PUT']) }}
      @else
        {{ Form::open(['route' => 'question.store']) }}
      @endif

      <input name="user_id" type="hidden" value="{{ $sendQuestion['user_id'] }}">
      <input name="tag_category_id" type="hidden" value="{{ $sendQuestion['tag_category_id'] }}">
      <input name="title" type="hidden" value="{{ $sendQuestion['title'] }}">
      <input name="content" type="hidden" value="{{ $sendQuestion['content'] }}">
      <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button>
      {{ Form::close() }}
  </div>
</div>

@endsection

