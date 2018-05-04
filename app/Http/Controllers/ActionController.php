<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use ProjectTools\UserInterface;
use ProjectTools\ActionInterface;
use Hash;
use Redirect;
use Mail;
use Carbon\Carbon;
use App\User;
use App\Actions;
class ActionController extends Controller
{
    public function __construct(ActionInterface $action) {
        $this->middleware('auth');
        $this->action = $action;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
        $input = $request->all();
        $input['search_filters'] = $data['search_filters'] = $this->action->searchField();
        $input['paginate'] = 1;
        $input['page_limit'] = 25;        
        $actions = $this->action->getList($input);
        $data['actions'] = $actions;
        if (!empty($data['actions'])) {
            $data['actions']->appends($request->except('page')); // append get variables for pagination
        }
        return view('action.list',$data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->get('id')){
            $data['action'] = $this->action->getById($request->get('id'));
        }
        else{
            $data['action'] = new Actions();
        }
        return view('action.create')->with($data);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\NewActionRequest $request)
    {
        $input = $request->all();
        $result = $this->action->create($input);
        if($result->id){
            $message = (new \App\Mail\ActionStatusMailer($result,'new'))
                ->onConnection('database')
                ->onQueue('emails');
                Mail::queue($message);
//            Mail::to($result->owner)->send(new \App\Mail\ActionOpened($result));
            return redirect()->route('action.list')->withSuccess('Action created successfully');
        }    
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
   public function update(Request $request,$id)
    {

        $result = $this->action->update($id,$request->all());

        if($result->id){
            if($result->status == Actions::ACTION_CLOSE){
                $message = (new \App\Mail\ActionStatusMailer($result,'close'))
                ->onConnection('database')
                ->onQueue('emails');
                Mail::queue($message);
//                Mail::to($result->owner)->send(new \App\Mail\ActionClosed($result));
                return redirect()->route('action.list')->withSuccess('Action closed successfully');
            }
            elseif($result->status == Actions::ACTION_OPEN){
                $message = (new \App\Mail\ActionStatusMailer($result,'update'))
                ->onConnection('database')
                ->onQueue('emails');
                Mail::queue($message);
//                Mail::to($result->owner)->send(new \App\Mail\ActionUpdated($result));
                return redirect()->route('action.list')->withSuccess('Action updated successfully');
            }
        }    
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
}
