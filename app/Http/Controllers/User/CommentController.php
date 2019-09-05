<?php

namespace App\Http\Controllers\User;

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

    /**
    * Store a newly created resource in storage.
    *
    * @param App\Http\Requests\User\CommentRequest $request
    * @return \Illuminate\Http\Response
    */
    public function storeComment(CommentRequest $request)
    {
        $inputs = $request->all();
        $this->comment->fill($inputs)->save();

        return redirect()->route('question.show', $inputs['question_id']);
    }
}
