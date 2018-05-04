<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use ProjectTools\UserInterface;
use Hash;
use Redirect;
use mail;
use Carbon\Carbon;
use App\User;
use File;
use Image;
class UserController extends Controller
{
     public function __construct(UserInterface $user) {
         $this->middleware('auth');
        $this->user = $user;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
        $input = $request->all();
        $input['search_filters'] = $data['search_filters'] = $this->user->searchField();
        $input['paginate'] = 1;
        $users = $this->user->getList($input);
        $data['users'] = $users;
        if (!empty($data['users'])) {
            $data['users']->appends($request->except('page')); // append get variables for pagination
        }
        return view('user.list',$data);
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->get('id')){
            $data['user'] = $this->user->getById($request->get('id'));
        }
        else{
            $data['user'] = new User();
        }
        return view('user.create')->with($data);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\NewUserRequest $request)
    {
        $input = $request->all();
        if(!isset($input['role']) or empty($input['role'])){
            $input['role'][] = 'user';
        }
        $input['role'] = implode(',', $input['role']);
        $input['avatar'] = $this->avatar($request);
        $result = $this->user->create($input);
        if($result->id){
            return redirect()->route('user.list')->withSuccess('User created successfully');
        }    
    }
    
    public function update(\App\Http\Requests\UpdateUserRequest $request,$id)
    {
        $input = $request->all();
        if(!isset($input['role']) or empty($input['role'])){
            $input['role'][] = 'user';
        }
        $input['role'] = implode(',', $input['role']);
        $input['avatar'] = $this->avatar($request,$id);
        if ($request->get('password') == '') {
            unset($input['password']);
            $result = $this->user->update($id,$input);
        } else {
            $result = $this->user->update($id,$input);
        }
        if($result->id){
            return redirect()->route('user.list')->withSuccess('User Updated Successfully');
        }    
    }
    
    public function check(Request $request){
        $email = $request->get('email');
        $id = $request->get('id');
        $users = User::whereEmail($email)->where('id','!=',$id)->count();
	//	if the count is more than 0, the userName exists
        if ($users > 0) {
            echo '<i title="Sorry username already taken !!!" class="text-red fa fa-remove"></i>';
        } else {
            echo '<i title="Available" class="text-green fa fa-check"></i>';
        }
        exit;
    }
    
    private function avatar($request,$id=null){
        $user = new User();
        if($id){
            $user = $this->user->getById($request->get('id'));
        }
        if ($request->hasFile('avatar')) {
            if($user->avatar){
                File::delete(public_path($user->avatar));
            }
            $request->file('avatar')->store('avatar');
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $file_path = 'images/profile_images/' . $filename;
            Image::make($avatar)->resize(100, 100)->save(public_path($file_path));
            return $file_path;
        }
        return $user->avatar;
    }
}
