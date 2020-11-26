<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable 
{
    use HasFactory;

    public function getMemberInfo($email)
    {
        $columnList = [
            "id",
            "name",
            "email",
            "course",
            "prefecture",
            "progress",
            "job_area",
            "age",
            "current_work",
            "memo",
            "created_at",
            "updated_at",
        ];


        $whereList = [
            ["delete_flag","=",0],
            ["email","=",$email],
            ["status","=",1],
        ];
        $dispData =$this::from("members")
                    ->where($whereList)
                    ->get($columnList);

        return $dispData;
    }
}
