<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\User\AttendanceRequest;

class AttendanceController extends Controller
{
    private $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::User();
        $todayDate = $this->attendance->todaysRecord($user->id);

        return view('user.attendance.index', compact('user', 'todayDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendanceRequest $request)
    {
        $inputs = $request->all();
        $inputs['modification_flg'] = 0;
        $this->attendance->fill($inputs)->create($inputs);

        return redirect()->route('attendance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $inputs = $request->all();
        $inputs['end_time'] = Carbon::now();
        $this->attendance->find($id)->fill($inputs)->save();

        return redirect()->route('attendance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     *
     * @param AttendanceRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function absenceStore(AttendanceRequest $request, $id)
    {
        $inputs = $request->all();
        $inputs['modification_flg'] = 0;
        $inputs['user_id'] = Auth::id();
        //$this->attendance->checkAbsenceStatus();  //欠席理由を登録する際に今日のレコードがあるかどうかのチェック用メソッド 一旦保留

        $this->attendance->fill($inputs)->create($inputs);

        return redirect()->route('attendance.index');
    }

    /**
     * @param AttendanceRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modificationUpdate(AttendanceRequest $request, $id)
    {
        $inputs = $request->all();
        $inputs['modification_flg'] = 1;
        $requestDayDate = $this->attendance->whereDate('start_time', $inputs['request_day'])->get();
        if (empty($requestDayDate[0])) {
            return redirect()->route('attendance.index');
        }
        $this->attendance->find($requestDayDate[0]['id'])->fill($inputs)->save();

        return redirect()->route('attendance.index');
    }
}
