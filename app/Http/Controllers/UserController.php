<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
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
    		$users = User::where('name', 'LIKE', "%$name%")
                ->orderBy('id', 'desc')->paginate(5);
    		$users->appends($this->request->only('search'));
    	} else {
    		$users = User::orderBy('id', 'desc')->paginate(5);	
    	}

    	$roles = Role::all();
    	
    	return view('users.index', compact('users', 'roles'));
    }

    public function store()
    {
        $this->validate($this->request, [
            'name' => 'required',
            'email' => 'email|unique:users|required',
            'role_id' => 'required'
        ]);
        $data = $this->request->except('_token');
        $data['password'] = bcrypt('secret');

        User::create($data);

        return back();
    }

    public function edit($id)
    {
        return [
            'status' => 'ok',
            'user' => User::find($id)
        ];
    }

    public function update()
    {
    	$this->validate($this->request, [
    		'name' => 'required',
            'role_id' => 'required'
        ]);

        $id = $this->request->get('id');

        User::find($id)
            ->update($this->request->except(['_token', 'id']));

        return back();
    }

    public function reset()
    {
        $id = $this->request->get('id');

        User::find($id)
            ->update(['password' => bcrypt('secret')]);

        return back();
    }

    public function delete()
    {
        $id = $this->request->get('id');

        User::find($id)->forceDelete();

        return back();
    }
}
