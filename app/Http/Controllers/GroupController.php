<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Group;
use App\Http\Requests\GroupStoreRequest;
use App\Services\GroupService;

class GroupController extends Controller
{
    protected $group_expense;
    
    public function __construct(GroupService $group_expense)
    {
        $this->group_expense = $group_expense;
    }

    public function index()
    {
        $groups = $this->group_expense->groupDetails();
        return view('group.list',compact('groups'));
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
