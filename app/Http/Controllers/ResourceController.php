<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use ProjectTools\ResourceInterface;
use Hash;
use Redirect;
use mail;
use Carbon\Carbon;
use App\Resources;



class ResourceController extends Controller
{
    protected $resource;
    
    public function __construct(ResourceInterface $resorce) {
        $this->middleware('auth');
        $this->resource = $resorce;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $input['columns'] = ['resources.*'];
        $input['search_filters'] = $data['search_filters'] = $this->resource->searchField();
        $input['paginate'] = 1;
        $resources = $this->resource->getList($input);
        $data['resources'] = $resources;
        if (!empty($resources)) {
            $data['resources']->appends($request->except('page')); // append get variables for pagination
        }
        
        return view('resource.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(Request $request)
    {
        if($request->get('id')){
            $data['resource'] = $this->resource->getById($request->get('id'));
        }
        else{
            $data['resource'] = new Resources();
        }
        return view('resource.create')->with($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\NewResourceRequest $request)
    {
        $input = $request->all();
        $input['submitted_by'] = auth()->user()->display_name();
        try {
            $result = $this->resource->create($input);
            if ($result->id) {
                return redirect()->route('resource.list')->withSuccess('Resource added successfully');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->withError('Error in adding new resource.');
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
    public function update(\App\Http\Requests\UpdateResourceRequest $request, $id)
    {
        $result = $this->resource->update($id,$request->all());
        if($result->id){
            return redirect()->route('resource.list')->withSuccess('Resource Updated successfully');
        }
        return redirect()->back()->withError('Resource not found.');
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
