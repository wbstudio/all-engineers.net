<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    //member表示用
    public function getInquiryList($id)
    {
        $columnList = [
            "id",
            "member_id",
            "admin_id",
            "speaker",
            "comment",
            "status",
            "delete_flag",
            "created_at",
            "updated_at",
        ];

        $whereList = [
            ["delete_flag","=",0],
            ["id","=",$id],
        ];
        $dispData =$this::from("inquiries")
                    ->where($whereList)
                    ->orderBy('created_at', 'asc')
                    ->get($columnList);

        return $dispData;
    }
   
    //member表示用
    public function getInquiryUnreadFlag($id)
    {
        $columnList = [
            "id",
            "status",
            "created_at",
            "updated_at",
        ];

        $whereList = [
            ["delete_flag","=",0],
            ["speaker","=",1],
            ["id","=",$id],
        ];

        $dispData =$this::from("inquiries")
                    ->where($whereList)
                    ->orderBy('created_at', 'desc')
                    ->offset(0)
                    ->limit(1)
                    ->get($columnList);

        return $dispData;
    }
   
}
