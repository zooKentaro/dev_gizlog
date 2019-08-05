<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;

class UserController extends Controller
{
    public $todo;

    /**
     * UserController constructor.
     * @param User $users
     */
    public function __construct(Todo $todo)
    {
        $this->middleware('auth');
        $this->todo = $todo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        $todos = $this->todo->getByUserId($userId);
        return view('user.daily_report.index', compact('todos'));
    }

    public function create()
    {
        return view('user.daily_report.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        // dd($input);
        $this->todo->fill($input)->save();
        return redirect()->to('home');
    }

    public function show($id)
    {
        $this->todo->find($id);
        return view('user.daily_report.show', compact('todo'));
    }
}

