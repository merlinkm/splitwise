<?php namespace App\Services;

use App\Models\Group;
use Illuminate\Support\Facades\DB;

class GroupService {

    public function groupDetails()
    {
        $group_id = DB::table('groups')
                ->join('group_user','groups.id','=','group_user.group_id','left')
                ->where('groups.user_id',env('SESSION_ID'))
                ->orWhere('group_user.user_id',env('SESSION_ID'))
                ->pluck('groups.id');

        for($i= 0; $i < count($group_id) ; $i++){
            $id[] = $group_id[$i];
        }

        return Group::whereIn('id',$id)->orderBy('id','desc')->get();

    }

    public function PerPersonExpense($group_id,$amount)
    {
        $group = Group::find($group_id);
        $totalUser = count($group->user);
        $perPerson = round($amount / $totalUser , 2);
        return $perPerson;
    }
}
