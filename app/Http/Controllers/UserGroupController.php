<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\Expense;
use App\Http\Requests\GroupUserStoreRequest;
use App\Http\Requests\GroupExpenseStoreRequest;
use App\Services\GroupService;

class UserGroupController extends Controller
{
    protected $expense;
    
    public function __construct(GroupService $group_expense)
    {
        $this->group_expense = $expense;
    }

    public function AddUser($group_id)
    {
        $data['group'] =  Group::find($group_id);
        $data['users'] =  User::orderBy('id','desc')->get();
        return view('user_group.addUser',$data);
    }

    public function StoreUser(GroupUserStoreRequest $request, $group_id)
    {
        $group = Group::find($group_id);
        $data['users'] =  $group->user()->sync($request->user);

        return redirect()->route('group.index')->with('success','User added in group successfully.');
    }

    public function AddExpenses($group_id)
    {
        $data['group'] =  Group::find($group_id);
        return view('user_group.addExpense',$data);
    }

    public function StoreExpenses(GroupExpenseStoreRequest $request,$group_id)
    {
        $group = Group::find($group_id);

        $perPerson = $this->group_expense->PerPersonExpense($group_id,$request->amount);

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
