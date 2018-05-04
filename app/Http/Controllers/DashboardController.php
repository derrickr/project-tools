<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests;
use ProjectTools\RequestInterface;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['gantt_requests'] =  DB::select(DB::raw("SELECT requests.req_no, requests.title, requests.planned_start, requests.planned_finish FROM requests WHERE requests.id = requests.latest ORDER BY requests.req_no ASC"));
        $data['gantt_count'] = DB::select(DB::raw("SELECT COUNT(planned_finish) as count FROM requests WHERE id = latest"));
        $data['request_status'] = DB::select(DB::raw("SELECT requests.status, count(requests.status) AS quantity FROM requests WHERE requests.id = requests.latest GROUP BY requests.status"));
        $data['requesters'] = DB::select(DB::raw("SELECT users.first_name, users.last_name, COUNT(requests.requester) as quantity FROM requests, users WHERE users.email = requests.requester AND requests.id = requests.latest GROUP BY requests.requester ORDER BY quantity DESC"));
        return view('dashboard.dashboard',$data);
    }
}
