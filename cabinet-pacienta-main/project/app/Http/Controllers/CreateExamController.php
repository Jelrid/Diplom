<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSchedule;
use App\Models\EmployerPost;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Method;
use App\Models\Methodology;
use App\Models\ResearchSchedule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

use App\Services\EmployeeScheduleService;

class CreateExamController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('CreateExam', [
            'methods' => Method::getActiveMethods()->get(),
            'methodology' => Methodology::getActiveMethodologies()->with('employees')->get(),
            'workTime' => ResearchSchedule::getActiveSchedule()->with('employeeSchedules')->get(),
            'seansTime' => EmployerPost::getActiveTime()->get(),
        ]);
    }


    public function dates(Request $request) {
        $year= $request->get('year');
        $month= $request->get('month');
        $method = $request->get('method');
        $employee = $request->get('employee');

        return response()->json(EmployeeScheduleService::getDates($year, $month, $method, $employee));
    }

    public function dataIndex(){
        $data = EmployeeSchedule::select('employee_id','time_start','time_end')->paginate(100);
        return response()->json($data);
    }

    public function indexEditExam($id){
        return Inertia::render('EditExam', [
			'DATAdata' => ResearchSchedule::where('research_id', $id)->get(),
            'methods' => Method::getActiveMethods()->get(),
            'methodology' => Methodology::getActiveMethodologies()->with('employees')->get(),
            'workTime' => ResearchSchedule::getActiveSchedule()->with('employeeSchedules')->get(),
            'seansTime' => EmployerPost::getActiveTime()->get(),
		]
	);
    }

	public function editExam(Request $request, $id){
		$dataTime = $request->date ;
		$date = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $dataTime)->format('Y-m-d');
				$data = ResearchSchedule::where('research_id',$id)->first();
		$data->time_start = $request->time;
		$data->date = $date;
		$data->save();

		return Redirect::route('profile.edit')->with('success');
	}

   

    public function dataIndexSchedule(){
        $data = ResearchSchedule::select('employee_id','date','time_start','time_end')->paginate(100);


        return response()->json($data);
    }

    public function store(Request $request){

        // dd($request->toArray());
        $this->validate($request, [
            'methoData'=>'required',
            'methodologyData'=>'required',
            'employeeData'=>'required',
            'date'=>'required',
            'time'=>'required',
        ]);

		$dates = $request->date;
		$dateTime = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $dates)->format('Y-m-d');
		
        $Schedule = ResearchSchedule::create([
            'method_id'=> $request->methoData			,
            'methodology_id'=> $request->methodologyData,
            'employee_id'=> $request->employeeData,
            'pacient_id'=> $request->user()->pacient_id,
            'date'=> $dateTime,
            'time_start'=> $request->time,
            'to_employee_check'=> '0',
            'vip_research' => '0',
            'cabinet_id' => '0',
            'methodology_group'=> '0',
            'methodology_group_bonus'=> '0',
            'methodology_side'=> '0',
            'diagnosis_id'=> '0',  
            'is_first'=> '0',
            'is_first_place'=> '0',
            'secondary'=> '0',
            'pre_date'=> '1',
            'urgency_conclusion_time'=> '10:00',
            'urgency_conclusion_commit_time'=> '10:00',
            'place0'=> '0',
            'place1'=> '0',
            'place2'=> '0',
            'place2_directory'=> '0',
            'place2_employee'=> '0',
            'place2_quote'=> '0',
            'place2_barter'=> '0',
            'place2_param'=> '0',
            'place2_appointment'=> '0',
            'place2_certificate'=> '0',
            'fomsId'=> '0',
            'fomsCompanyId'=> '0',
            'foms_status'=> '0',
            'foms_fail_text'=> '0',
            'vip_type'=> '0',
            'privilege'=> '0',
            'discount'=> '0',
            'promo_discount'=> '0',
            'urgency_id'=> '0',
            'urgency_conclusion'=> '0',
			'urgency_conclusion_user'=> '0',
			'urgency_conclusion_commit_user'=> '0',
			'price'=> '0',
			'bonus_prepay'=> '0',
			'pay'=> '0',
			'prepay'=> '0',
			'active'=> '0',
			'appointment_doctor'=> '0',
			'appointment_clinic'=> '0',
			'monitor_text'=> '0',
			'contrast_id'=> '0',
			'price_id'=> '0',
			'dynamic_contrast'=> '0',
			'self_contrast'=> '0',
			'mrt_id'=> '0',
			'dlp'=> '0',
			'radiation'=> '0',
			'done_status'=> '0',
			'done_note'=> '0',
			'cancel_user'=> '0',
			'cancel_time'=> '2000-01-01 00:00:00',
			'cancel_status'=> '0',
			'cancel_note'=> '',
			'parent_id'=> '0',
			'registrator_id'=> '0',
			'register_time'=> '2000-03-26 00:00:00',
			'real_come_time'=> '0',
			'real_research_time'=> '00:00',
			'real_research_done'=> '00:00',
			'real_results'=> '00:00',
			'card_id'=> '0',
			'bonus_card_id'=> '0',
			'rule_id'=> '0',
			'done_lock'=> '0',
			'clear_time'=> '00:00',
			'status'=> '55',
			'time_employee_id'=> '0',
			'move_apply'=> '0',
			'note'=> '0',
			'study_note'=> '0',
			'conflict'=> '0',
			'anamnesis'=> '0',
			'result_ready_time'=> '0',
			'redo'=> '0',
			'redo_user'=> '0',
			'redo_message'=> '0',
			'redo_research_id'=> '0',
			'commit_status'=> '0',
			'commit_percent'=> '0',
			'commit_user_id'=> '0',
			'commit_time'=> '00:00',
			'commit_sender_user_id'=> '0',
			'commit_sender_time'=>'0',
			'filming_done'=>'0',
			'filming_done_time'=>'00:00',
			'filming_done_employee_id'=>'0',
			'conclusion_done'=>'0',
			'conclusion_done_time'=>'00:00',
			'med_worker'=>'0',
			'email_conclusion'=>'0',
			'email_conclusion_user'=>'0',
			'email_conclusion_time'=>'0',
			'email_conclusion_send'=>'0',
			'mobile_move'=>'0',
			'mobile_move_time'=>'0',
			'mobile_move_employee'=>'0',
			'mobile_date'=>'24.03.2002',
			'mobile_time_start'=>'00:00',
			'mobile_time_end'=>'00:00',
			'mobile_cabinet_id'=>'0', 
			'mobile_employee_id'=>'0',
			'move_old_time'=>'00:00',
			'repeat_reason'=>'0',
			'repeat_note'=>'0',
			'dicom_media_type'=>'0',
			'temperature'=>'0',
            
        ]);

		return Redirect::route('profile.edit', $Schedule->research_id)->with('success');
    }


}
