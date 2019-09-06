@extends ('common.user')
@section ('content')

<h2 class="brand-header">投稿内容確認</h2>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      {{ $tagCategories['name'] }}の質問
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $question['title'] }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{{ $question['content'] }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="btn-bottom-wrapper">
    @if(isset($question['id']))
      {{ Form::open(['route' => ['question.update', $question['id']], 'method' => 'PUT']) }}
    @else
      {{ Form::open(['route' => 'question.store']) }}
    @endif
      {{ Form::input('hidden', 'user_id', $question['user_id']) }}
      {{ Form::input('hidden', 'tag_category_id', $question['tag_category_id']) }}
      {{ Form::input('hidden', 'title', $question['title']) }}
      {{ Form::input('hidden', 'content', $question['content']) }}
      {{ Form::button('<i class="fa fa-check" aria-hidden="true"></i>', ['class' => 'btn btn-success', 'type' => 'submit']) }}
    {{ Form::close() }}
  </div>
</div>

@endsection

