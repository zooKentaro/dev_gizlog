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
    public function index(Request $request)
    {
        $userId = Auth::id();
        $reporting_time = $request->input('search-month');
        if ($reporting_time !== NULL) {
            $reports = $this->report->where('reporting_time', 'like', "%$reporting_time%")->where('deleted_at', 'NULL')->get();
        } else {
            $reports = $this->report->getByUserId($userId);
        }

        return view('user.daily_report.index', compact('reports'));
    }

    public function create()
    {
        return view('user.daily_report.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'contents' => 'required|max:200',
        ], [
            'title.required' => '入力必須項目です。',
            'contents.required' => '入力必須項目です。'
        ]);

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
        $this->validate($request, [
            'title' => 'required|max:200',
            'contents' => 'required|max:200',
        ], [
            'title.required' => '入力必須項目です。',
            'contents.required' => '入力必須項目です。'
        ]);

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
