<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Group;
use App\Http\Requests\GroupStoreRequest;

class GroupController extends Controller
{
    public function index()
    {
        $group_id = DB::table('groups')
                ->join('group_user','groups.id','=','group_user.group_id','left')
                ->where('groups.user_id',env('SESSION_ID'))
                ->orWhere('group_user.user_id',env('SESSION_ID'))
                ->pluck('groups.id');

        for($i= 0; $i < count($group_id) ; $i++){
            $id[] = $group_id[$i];
        }
        $data['groups'] = Group::whereIn('id',$id)->orderBy('id','desc')->get();

        return view('group.list',$data);
    }

    public function create()
    {
        return view('group.create');
    }

    public function store(GroupStoreRequest $request)
    {
        $group = new Group;
        $group->name = $request->name;
        $group->user_id = env('SESSION_ID');
        $group->save();

        return redirect()->route('group.index')->with('success','Groups has been created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
