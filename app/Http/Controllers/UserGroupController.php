<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\Expense;

class UserGroupController extends Controller
{
    public function AddUser($group_id)
    {
        $data['group'] =  Group::find($group_id);
        $data['users'] =  User::orderBy('id','desc')->get();
        return view('user_group.addUser',$data);
    }

    public function StoreUser(Request $request, $group_id)
    {
        $request->validate([
            'user' => 'required',
        ]);
        $group = Group::find($group_id);
        $data['users'] =  $group->user()->sync($request->user);

        return redirect()->route('group.index')->with('success','User added in group successfully.');
    }

    public function AddExpenses($group_id)
    {
        $data['group'] =  Group::find($group_id);
        return view('user_group.addExpense',$data);
    }

    public function StoreExpenses(Request $request, $group_id)
    {
        $request->validate([
            'amount' => 'required',
            'user' => 'required',
            'description' => 'required',
        ]);

        $group = Group::find($group_id);
        $totalUser = count($group->user);
        $perPerson = round($request->amount / $totalUser , 2);

        $expense = Expense::create([
            'amount' => $request->amount,
            'per_person' => $perPerson,
            'description' => $request->description,
            'paid_by' => $request->user,
        ]);
        $expense_id = $expense->id;

        $data['users'] =  $group->expenses()->attach($expense_id);

        return redirect()->route('group.index')->with('success','Expenses added in group successfully.');
    }

    public function ViewExpenses($group_id)
    {
        $data['group'] =  Group::find($group_id);
        return view('user_group.viewExpense',$data);
    }

    public function ExpenseDetails($expense_id)
    {
        $data['expense'] =  Expense::find($expense_id);
        return view('user_group.expenseDetails',$data);
    }
}
