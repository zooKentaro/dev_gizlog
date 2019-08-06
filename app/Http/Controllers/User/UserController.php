<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use Carbon\Carbon;

class UserController extends Controller
{
    public $report;

    /**
     * UserController constructor.
     * @param User $users
     */
    public function __construct(Report $report)
    {
        $this->middleware('auth');
        $this->report = $report;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        $reports = $this->report->getByUserId($userId);
        return view('user.daily_report.index', compact('reports'));
    }

    public function create()
    {
        return view('user.daily_report.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->report->fill($input)->save();
        return redirect()->to('home');
    }

    public function show($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.show', compact('report'));
    }

    public function edit($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->report->find($id)->fill($input)->save();
        return redirect()->to('home');
    }

    public function delete(Request $request)
    {
        $report = $this->report->find($request->id);
        $report['deleted_at'] = new Carbon;
        $report->save();
        return redirect()->to('home');
    }
}

