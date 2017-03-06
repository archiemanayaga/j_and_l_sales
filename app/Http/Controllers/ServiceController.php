<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

use App\Http\Requests;

class ServiceController extends Controller
{

 	protected $request;

	public function __construct(Request $request) 
	{
		$this->request = $request;
	}

    public function index()
    {
    	if($this->request->has('search')) {
    		$name = $this->request->get('search');
    		$services = Service::where('name', 'LIKE', "%$name%")
                ->orderBy('id', 'desc')->paginate(5);
    		$services->appends($this->request->only('search'));
    	} else {
    		$services = Service::orderBy('id', 'desc')->paginate(5);	
    	}
    	
    	return view('services.index', compact('services'));
    }

    public function store()
    {
        $this->validate($this->request, [
            'name' => 'required',
            'fee' => 'required'
        ]);
        $data = $this->request->except('_token');
        $data['user_id'] = \Auth::user()->id;
        Service::create($data);

        return back();
    }

    public function edit($id)
    {
        return [
            'status' => 'ok',
            'service' => Service::find($id)
        ];
    }

    public function update()
    {
        $id = $this->request->get('id');

        Service::find($id)
            ->update($this->request->except(['_token', 'id']));

        return back();
    }

    public function delete()
    {
        $id = $this->request->get('id');

        Service::find($id)->forceDelete();

        return back();
    }
}
