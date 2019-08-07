<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use Carbon\Carbon;

class ReportController extends Controller
{
    public $report;

    public function __construct(Report $report)
    {
        $this->middleware('auth');
        $this->report = $report;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.daily_report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return redirect()->to('report');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        return redirect()->to('report');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    // public function destroy(Request $request)
    {
        $report = $this->report->find($id);
        $report['deleted_at'] = new Carbon;
        $report->save();
        return redirect()->to('home');
    }
}
