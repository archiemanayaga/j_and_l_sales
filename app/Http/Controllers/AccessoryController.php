<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\Http\Request;

use App\Http\Requests;

class AccessoryController extends Controller
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
    		$accessories = Accessory::where('name', 'LIKE', "%$name%")
                ->orderBy('id', 'desc')
                ->paginate(5);
    		$accessories->appends($this->request->only('search'));
    	} else {
    		$accessories = Accessory::orderBy('id', 'desc')->paginate(5);	
    	}

    	return view('accessories.index', compact('accessories'));
    }

    public function store()
    {
        $this->validate($this->request, [
            'name' => 'required',
            'price' => 'required'
        ]);
        $data = $this->request->except('_token');
        $data['user_id'] = \Auth::user()->id;
        Accessory::create($data);

        return back();
    }

    public function edit($id)
    {
        return [
            'status' => 'ok',
            'accessory' => Accessory::find($id)
        ];
    }

    public function update()
    {
        $id = $this->request->get('id');
        Accessory::find($id)
            ->update($this->request->except(['_token', 'id']));

        return back();
    }

    public function delete()
    {
        $id = $this->request->get('id');
        Accessory::find($id)->forceDelete();

        return back();
    }
}
