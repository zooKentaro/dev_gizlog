<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\Report;
use Carbon\Carbon;

class ReportController extends Controller
{
    protected $report;

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
        if (is_null($reporting_time) || empty($reporting_time)) {
            $reports = $this->report->getByUserId($userId);
            $reports = $reports->sortByDesc('reporting_time');
        } else {
            $dt = Carbon::parse($reporting_time);
            $reports = $this->report->getSearchReports($dt, $userId);
            $reports = $reports->sortByDesc('reporting_time');
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
    public function store(DailyReportRequest $reportRequest)
    {
        $input = $reportRequest->all();
        $input['user_id'] = Auth::id();
        $this->report->fill($input)->save();
        return redirect()->route('report');
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
    public function update(DailyReportRequest $reportRequest, $id)
    {
        $input = $reportRequest->all();
        $input['user_id'] = Auth::id();
        $this->report->find($id)->fill($input)->save();
        return redirect()->route('report');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = $this->report->find($id);
        $report->delete();
        return redirect()->route('report');
    }
}
