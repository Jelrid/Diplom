<?php

namespace App\Http\Controllers;

use App\Models\Contrast;
use App\Models\EmployeeSchedule;
use App\Models\EmployerPost;
use App\Models\Method;
use App\Models\ResearchSchedule;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function index(Request $request)
    {
        $data = ResearchSchedule::where('research_id', 777096)->paginate(100);
        dd($data->toArray());
    }
}
