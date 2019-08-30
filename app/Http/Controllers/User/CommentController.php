<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CommentRequest;
use App\Models\Comment;


class CommentController extends Controller
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function storeComment(CommentRequest $request)
    {
        $inputs = $request->all();
        $this->comment->fill($inputs)->save();

        return redirect()->route('question.show', $inputs['question_id']);
    }
}
