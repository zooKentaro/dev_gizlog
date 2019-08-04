<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
// use App\Models\User;
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
}

