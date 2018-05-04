<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use ProjectTools\RequestInterface;
class RequestController extends Controller
{
    protected $request;
    public function __construct(RequestInterface $request) {
        $this->middleware('auth');
        $this->request = $request;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();

        $input['paginate'] = 1;
        $input['search_filters'] = $data['search_filters'] = $this->request->searchField();
        $input['columns'] = ['requests.*','users.first_name as req_first_name','users.last_name as req_last_name'];
        $input['join'] = ['requester'];
        $input['raw_where'] = '`requests`.`id` = `requests`.`latest`';
        $requests = $this->request->getList($input);
        $data['requests'] = $requests;
        if (!empty($data['requests'])) {
            $data['requests']->appends($request->except('page')); // append get variables for pagination
        }
        return view('request.list',$data);
    }
    
    /**
     * Display a history of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history($id)
    {
        $requests = DB::select(DB::raw("SELECT requests.id, requests.title, requests.requester, requests.submitted_date, requests.status, requests.tot_cost, requests.planned_start, requests.planned_finish, users.first_name, users.last_name FROM requests, users WHERE requests.requester = users.email AND requests.req_no = '$id' ORDER BY requests.submitted_date DESC"));
                //. "SELECT requests.req_no, requests.title, requests.planned_start, requests.planned_finish FROM requests WHERE requests.id = requests.latest ORDER BY requests.req_no ASC"));
        $data['requestid'] = $id;
        $data['requests'] = $requests;
        

        return view('request.history',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->has('id')){
            $data['request'] = $this->request->getById($request->get('id'));
            //print '<pre>'; print_r($data['request']); exit;
           // $data['requestCount'] = DB::select(DB::raw('SELECT COUNT(req_no) as req_no FROM requests WHERE req_no = ' . $data['request']->req_no));
            $data['requestCount'] = \App\Requests::where('req_no',$data['request']->req_no)->count();
//            $data['minRecord'] = DB::select(DB::raw('SELECT MIN(id) as minRec FROM requests WHERE req_no = ' . $data['request']->req_no));
            $data['minRecord'] = \App\Requests::where('req_no',$data['request']->req_no)->min('id');
            return view('request.edit',$data);
        }
        else{
            $data['request'] = new \App\Requests();
            return view('request.create',$data);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\RequestFormRequest $request)
    {
        $inputs = $request->all();
        $result = $this->request->create($inputs);
        if($result->id){
            return redirect()->route('request.list')->withSuccess('New request created successfully');
        }
        return redirect()->back()->withError('Error in creating new request.');
//        $this->request->sav
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
        //
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
    
    public function actions(Request $request,$action)
    {
        if ($request->has('id')) {
            $data['request'] = $this->request->getById($request->get('id'));
            $data['action'] = $action;
            return view('request.partial.actions-popup',$data);
        }
        abort(401);
    }
    public function save_action(\App\Http\Requests\RequestActionFormRequest $request,$action,$id)
    {
        $inputs= $request->all();
        $result = $this->request->actions($id,$action,$inputs);
        return redirect()->route('request.list');
    }
}
