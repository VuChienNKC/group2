<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\attend_leave;
use App\Models\employee;
use App\Models\slip_mg;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index(){
        $staffs=employee::select('staff_id','staff_name')->get();
        return view('list-staff',compact('staffs'));        
    }

    public function indexstaffProfile(){
        return view('staffprofile');        
    }

    public function GetListStaff(Request $request){
        if($request->ajax()){
            $id = $request->id;
            $staffs = employee::select('staff_id','staff_name','tel','residence','birthday','remarks')
                                        ->where('staff_id',$id)
                                        ->get();
            return response()->json($staffs); 
        }
    }

    public function register(Request $request){
        // $hourly_wage=$request->hourly_wage;
        // $hourly_wage = intval(str_replace(',','', $hourly_wage));//,消してintに変換

        $validatedData = $request->validate([
            'staff_name' => 'required|string',
            'tel' => 'required|numeric',
            'residence' => 'required|string',
            'birthday' => 'required|date',
            'hourly_wage' => 'numeric'
        ],[
            'staff_name.required'=>'スタッフの名前を入力してください。',
            'tel.required'=>'電話番号を入力してください。',
            'tel.numeric'=>'数字をを入力してください。',
            'residence.required'=>'住所を入力してください。',
            'birthday.required'=>'誕生日を入力してください。',
            'birthday.date'=>'年-月-日の形を入力してください。',
            'hourly_wage.numeric'=>'数字をを入力してください。'
        ]);
        $employee = employee::create([
            'staff_name' => $request->input('staff_name'),
            'staff_pass'=> bcrypt('password'),
            'tel' => $request->input('tel'),
            'residence' => $request->input('residence'),
            'birthday' => $request->input('birthday'),
            'hourly_wage' => $request->input('hourly_wage'),
            'remarks' => $request->input('remarks')
        ]);
        return redirect()->route('indexEmpRegister')->with('message','登録完成しました。');
    } 
    //出勤の履歴
    public function indexHistory(Request $request)
    {
        // $id = $request->id;
        $id = 1;//
        $staff_name = employee::select('staff_name')
                                    ->where('staff_id',$id)
                                    ->first();
        $staffs = attend_leave::select('work_date','attend_time','leaving_work')
                                ->where('staff_id',$id)
                                ->get();
        return view('history',compact('staffs','staff_name'));
    }
    //給料計算
    public function indexPay(Request $request)
    {
        $subQuery = DB::table('slip_links')
    ->select('slip_links.slip_id', DB::raw('COUNT(slip_links.staff_id) as cnt'))
    ->join('slip_mgs', 'slip_links.slip_id', '=', 'slip_mgs.slip_id')
    ->groupBy('slip_links.slip_id');

$slip = DB::table($subQuery, 'slip')
    ->select('slip_links.staff_id', DB::raw('SUM(slip_mgs.total / slip.cnt) as total'))
    ->join('slip_mgs', 'slip.slip_id', '=', 'slip_mgs.slip_id')
    ->join('slip_links', 'slip_links.slip_id', '=', 'slip.slip_id')
    ->groupBy('slip_links.staff_id');

$staff = DB::table('employees')
    ->select(
        'employees.staff_name',
        'employees.staff_id',
        DB::raw('SUM(FLOOR(TIMESTAMPDIFF(MINUTE, attend_leaves.attend_time, attend_leaves.leaving_work) / 30)) as total_time'),
        DB::raw('SUM(FLOOR(TIMESTAMPDIFF(MINUTE, attend_leaves.attend_time, attend_leaves.leaving_work) / 30) * employees.hourly_wage) as total_salary'),
        DB::raw('COUNT(attend_leaves.work_date) AS total_working_days'),
        DB::raw('SUM(CASE
                WHEN attend_leaves.num_people > 0 THEN
                    CASE
                        WHEN attend_leaves.attend_time < "20:10:00" THEN attend_leaves.num_people * 2000
                        WHEN attend_leaves.attend_time < "20:30:00" THEN attend_leaves.num_people * 1000
                        ELSE 0
                    END
                ELSE 0
            END) AS total_money_people')
    )
    ->join('attend_leaves', 'employees.staff_id', '=', 'attend_leaves.staff_id')
    ->whereMonth('attend_leaves.work_date', '=', date('m'))
    ->whereYear('attend_leaves.work_date', '=', date('Y'))
    ->groupBy('employees.staff_id', 'employees.staff_name')
    ->orderBy('employees.staff_id');

$result = DB::table($slip, 'slip')
    ->rightJoinSub($staff, 'staff', function ($join) {
        $join->on('slip.staff_id', '=', 'staff.staff_id');
    })
    ->select(
        'staff.staff_id',
        'staff.staff_name',
        DB::raw('COALESCE(u, 0) as Earnings'),
        DB::raw('total_salary + ((u - total_salary + total_money_people) * 0.1) as total_salary'),
        'total_time',
        'total_working_days',
        'total_money_people',
        'total_salary as basic_salary'
    )
    ->get();


    
        
        return view('test',compact('result'));
        // return view('pay-statement',compact('staffs'));
        // return view('test',compact('staff'));
    
    }
    function personPay(Request $request){
        $staff_id = $request->id;

        $results = DB::table('employees')
        ->join('attend_leaves', 'employees.staff_id', '=', 'attend_leaves.staff_id')
        ->leftJoin(DB::raw('(SELECT slip_links.staff_id, SUM(slip_mgs.total / slip.cnt) AS u
                            FROM (
                                SELECT slip_links.slip_id, COUNT(slip_links.staff_id) AS cnt
                                FROM slip_links
                                JOIN slip_mgs ON slip_links.slip_id = slip_mgs.slip_id
                                GROUP BY slip_links.slip_id
                            ) AS slip
                            JOIN slip_mgs ON slip.slip_id = slip_mgs.slip_id
                            JOIN slip_links ON slip_links.slip_id = slip.slip_id
                            GROUP BY slip_links.staff_id) AS slip'), 'slip.staff_id', '=', 'staff.staff_id')
        ->select('staff.staff_id', 'staff.staff_name', DB::raw('COALESCE(slip.u, 0) AS earnings'))
        ->selectRaw('total_salary + ((slip.u - total_salary + total_money_people) * 0.1) AS total_salary')
        ->select('total_time', 'total_working_days', 'total_money_people', 'total_salary AS basic_salary')
        ->whereMonth('attend_leaves.work_date', '=', date('m'))
        ->whereYear('attend_leaves.work_date', '=', date('Y'))
        ->where('employees.staff_id',"=",$staff_id)
        ->groupBy('employees.staff_id', 'employees.staff_name')
        ->orderBy('employees.staff_id')
        ->get();

        return response()->json($results);
    }

    //パスワード変更
    function changePass(Request $request){
        $validatedData = $request->validate([
            'now_password' => 'required',
            'new_password' => 'required',
            'new_passwordConf' => 'required',
        ],[
            'now_password.required'=>'現在のパスワードを入力してください。',
            'new_password.required'=>'新しいパスワードを入力してください。',
            'new_passwordConf.required'=>'新しいパスワードをもう一度入力してください。',
        ]);
        $user = Auth::user();
        $staff_id = $user->staff_id;
        $staff=employee::find($staff_id);
        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->input('now_password'), $staff->password)) {
            return redirect()->back()->with('message', '現在のパスワードは間違ってます');
        }
        // Kiểm tra mật khẩu mới
        if ($request->input('now_password') === $request->input('new_password')) {
            return redirect()->back()->with('message', '新パスワードは現在のパスワードと同じです');
        }
        // Cập nhật mật khẩu mới
        $staff->password = Hash::make($request->input('new_password'));
        $staff->fist_login = false;
        $staff->save();
        return redirect()->back()->with('message','パスワードを変更しました');
    }
    function payStatementIndex(){
        $staffs = employee::select('staff_id','staff_name')
                ->get();
        return view('pay-statement',compact('staffs'));
    }
}
