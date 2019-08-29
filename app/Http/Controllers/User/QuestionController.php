<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Comment;
use App\Models\User;
use App\Models\TagCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuestionsRequest;
use App\Http\Requests\User\CommentRequest;


class QuestionController extends Controller
{
    protected $question;
    protected $comment;
    protected $tagCategory;

    public function __construct(Question $question, Comment $comment, TagCategory $taguCategory)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->comment = $comment;
        $this->tagCategory = $taguCategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchConditions = $request->all();

        $searchWord = $request->input('search_word');
        $searchTag = $request->input('tag_category_id');
        $questions = $this->question->fetchSearchQuestions($searchWord, $searchTag);

        return view('user.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tagCategorys = $this->tagCategory->get();

        return view('user.question.create', compact('tagCategorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $request)
    {
        $inputs = $request->all();
        $this->question->create($inputs);

        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $question = $user->questions->find($id);
        $comments = $this->comment->getComment($id);

        return view('user.question.show', compact('question', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $question = $user->questions->find($id);
        $tagCategorys = $this->tagCategory->get();

        return view('user.question.edit', compact('question', 'tagCategorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsRequest $request, $id)
    {
        $inputs = $request->all();
        $this->question->find($id)->fill($inputs)->save();

        return redirect()->route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();

        return redirect()->route('question.myPage');
    }

    public function storeComment(CommentRequest $request)
    {
        $inputs = $request->all();
        $this->comment->fill($inputs)->save();
        $question_id = $inputs['question_id'];

        return redirect()->route('question.show', $question_id);
    }

    public function showMyPage()
    {
        $questions = $this->question->with(['user', 'tagCategory', 'comment'])->orderby('id', 'desc')->get();

        return view('user.question.mypage', compact('questions'));
    }

    public function confirm(QuestionsRequest $request)
    {
        $sendQuestion = $request->all();
        $tagName = $this->tagCategory->find($sendQuestion['tag_category_id']);

        return view('user.question.confirm', compact('sendQuestion', 'tagName'));
    }
}
