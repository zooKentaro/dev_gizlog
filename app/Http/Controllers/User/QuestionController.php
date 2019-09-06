<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Comment;
use App\Models\TagCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuestionsRequest;

class QuestionController extends Controller
{
    private $question;
    private $comment;
    private $tagCategory;

    public function __construct(Question $question, Comment $comment, TagCategory $tagCategory)
    {
        $this->question = $question;
        $this->comment = $comment;
        $this->tagCategory = $tagCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\User\QuestionsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionsRequest $request)
    {
        $searchWord = $request->input('search_word');
        $searchTag = $request->input('tag_category_id');
        $questions = $this->question->fetchSearchQuestions($searchWord, $searchTag);
        $tagCategories = $this->tagCategory->all();

        return view('user.question.index', compact('questions', 'tagCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $tagCategories = $this->tagCategory->all();

        return view('user.question.create', compact('tagCategories', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\User\QuestionsRequest $request
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $question = $this->question->with(['user', 'comments', 'comments.user'])->find($id);

        return view('user.question.show', compact('question', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->question->find($id);
        $tagCategories = $this->tagCategory->all();

        return view('user.question.edit', compact('question', 'tagCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\User\QuestionsRequest $request
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();

        return redirect()->route('question.showMyPage');
    }

    /**
    * Display the My Page of the question.
    *
    * @return \Illuminate\Http\Response
    */
    public function showMyPage()
    {
        $questions = $this->question->with(['user', 'tagCategory', 'comments'])
                                    ->where('user_id', Auth::id())
                                    ->orderby('created_at', 'desc')
                                    ->get();

        return view('user.question.mypage', compact('questions'));
    }

    /**
    * Check what you are trying to update.
    *
    * @param App\Http\Requests\User\QuestionsRequest $request
    * @return \Illuminate\Http\Response
    */
    public function confirm(QuestionsRequest $request)
    {
        $question = $request->all();
        $tagCategories = $this->tagCategory->find($question['tag_category_id']);

        return view('user.question.confirm', compact('question', 'tagCategories'));
    }
}
