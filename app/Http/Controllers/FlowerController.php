<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;

use App\Http\Requests;

class FlowerController extends Controller
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
    		$flowers = Flower::where('name', 'LIKE', "%$name%")
                ->orderBy('id', 'desc')->paginate(5);
    		$flowers->appends($this->request->only('search'));
    	} else {
    		$flowers = Flower::orderBy('id', 'desc')->paginate(5);	
    	}
    	
        return view('flowers.index', compact('flowers'));
    }

    public function store()
    {
        $this->validate($this->request, [
            'name' => 'required',
            'price' => 'required'
        ]);
        $data = $this->request->except('_token');
        $data['user_id'] = \Auth::user()->id;
        Flower::create($data);

        return back();
    }

    public function edit($id)
    {
        return [
            'status' => 'ok',
            'flower' => Flower::find($id)
        ];
    }

    public function update()
    {
        $id = $this->request->get('id');

        Flower::find($id)
            ->update($this->request->except(['_token', 'id']));

        return back();
    }

    public function delete()
    {
        $id = $this->request->get('id');

        Flower::find($id)->forceDelete();

        return back();
    }
}
