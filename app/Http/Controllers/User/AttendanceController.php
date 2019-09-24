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
    private $MODIFICATION_FLG = 0;

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
        $this->MODIFICATION_FLG = 0;
        $inputs['modification_flg'] = $this->MODIFICATION_FLG;
        $attendance = $this->attendance->todaysRecord(Auth::id());
        if (empty($attendance)) {
            $this->attendance->fill($inputs)->create($inputs);
        }

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
        $inputs['user_id'] = $id;
        $attendance = $this->attendance->where('user_id', Auth::id())
            ->where('registration_date', Carbon::today()
            ->format('Y-m-d'))
            ->exists();
        if ($attendance) {
            return redirect()->route('attendance.index');
        }
        $this->attendance->updateOrCreate(['registration_date' => $inputs['registration_date'], 'user_id' => $id],
            ['user_id' => $inputs['user_id'],
            'modification_flg' => $inputs['modification_flg'],
            'registration_date' => $inputs['registration_date'],
            'absence_reason' => $inputs['absence_reason'],
            ]
        );

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
        $this->MODIFICATION_FLG = 1;
        $inputs['modification_flg'] = $this->MODIFICATION_FLG;
        $requestDayDate = $this->attendance->whereDate('start_time', $inputs['request_day'])->get();
        if (empty($requestDayDate[0])) {
            return redirect()->route('attendance.index');
        }
        $this->attendance->find($requestDayDate[0]['id'])->fill($inputs)->save();

        return redirect()->route('attendance.index');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showAbsence()
    {
        return view('user.attendance.absence');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showModify()
    {
        return view('user.attendance.modify');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showMypage()
    {
        $myAttendances = $this->attendance->where('user_id', Auth::id())->get();
        $totalDays = $this->attendance->whereNotNull('end_time')->count();
        $user = Auth::user();
        $totalTime = 0;
        foreach($myAttendances as $myAttendance)
        {
            if (!empty($myAttendance->start_time) && !empty($myAttendance->end_time)) {
                $data1 = new Carbon($myAttendance->end_time);
                $data2 = new Carbon($myAttendance->start_time);
                $totalTime += $data1->diffInMinutes($data2)/60;
            }
        }
        $totalTimes = round($totalTime, 0);

        return view('user.attendance.mypage', compact('myAttendances', 'user', 'totalDays', 'totalTimes'));
    }
}
