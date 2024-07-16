<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\CabinetSchedule;
use App\Models\CancelExam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\EmployerPost;
use App\Models\Method;
use App\Models\Methodology;
use App\Models\ResearchSchedule;
use Inertia\Inertia;
use Inertia\Response;
use GuzzleHttp\Client;
use Carbon\Carbon;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'status' => session('status'),
            'methods' => Method::getActiveMethods()->get(),
            'methodology' => Methodology::getActiveMethodologies()->with('employees')->get(),
            'workTime' => ResearchSchedule::getActiveSchedule()->with('employees', 'methods', 'methodologys', 'contrast', 'posts')->get(),
            'seansTime' => EmployerPost::getActiveTime()->get(),
            'sheduleOkTime' => CabinetSchedule::getActiveScheduled()->with('employeeSchedule')->get(),

        ]);
    }



    public function conclusion(Request $request)
    {
        $client = new Client();
        $headers = [
            'X-Requested-With' => 'XMLHttpRequest',
            // Other headers as needed
        ];
        $RESEARCH_ID = 77474;
        // $request->id;
        $url = 'http://10.100.3.20:8001/api/research-conclusion';

        $response = $client->request("GET", $url, [
            'headers' => $headers,
            'query' => [
                'id' => '71546',
                'sid' => 'b22ceec1-576a-46ee-8d5d-a61b81d0c8a4'
            ],
        ]);
        $content = json_decode($response->getBody()->getContents());


        if ($content->status===true) {
            $file = base64_decode(\Defuse\Crypto\Crypto::decrypt($content->data->content, \Defuse\Crypto\Key::loadFromAsciiSafeString(env("DECRYPT_KEY"))));
            return response()->pdf($file,'Заключение.pdf');
        }


    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $data = $request->user();
        $data->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    public function updateStatus(Request $request)
    {
        $elem = ResearchSchedule::where('research_id', $request->id)->first();
        $elem->status = -1;
        $elem->cancel_time = Carbon::now();
        $elem->cancel_status = 5;
        $elem->cancel_note = $request->descript;
        $elem->save();


        return Redirect::route('profile.edit')->with('success');
    }



}
