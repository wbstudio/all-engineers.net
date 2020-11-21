<?php

namespace App\Models\Administer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    public function getArticlesList($param=null)
    {
        $columnList = [
            "id",
            "course",
            "classification",
            "order",
            "title",
            "heading",
            "status",
            "created_at",
            "updated_at",
        ];


        $whereList = [
            ["delete_flag","=",0],
        ];
        if(isset($param["course"]) && $param["course"] != null){
            $whereList[] = ["course","=",$param["course"]];
        }
        if(isset($param["classification"]) && $param["classification"] != null){
            $whereList[] = ["classification","=",$param["classification"]];
        }


        $offset = 0;
        $limit = $param["per_page"];
        if(isset($param["page"]) && $param["page"] != 1){
            $offset = ($param["page"] - 1) * $param["per_page"];
        }


        $dispData =$this::from("articles")
                    ->where($whereList)
                    ->orderby("order","asc")
                    ->offset($offset)
                    ->limit($limit)
                    ->get($columnList);

        $aList["data"] = $dispData;


        $Cnt = DB::table('articles')->where($whereList)->count();

        
        $aList["AllCnt"] = $Cnt;
        return $aList;
    }


    public function getArticleData($id)
    {
        $columnList = [
            "id",
            "course",
            "classification",
            "order",
            "title",
            "heading",
            "explanation",
            "movie_link",
            "question",
            "commentary",
            "status",
            "created_at",
            "updated_at",
        ];


        $whereList = [
            ["delete_flag","=",0],
            ["id","=",$id],
        ];



        $dispData =$this::from("articles")
                    ->where($whereList)
                    ->get($columnList);

        return $dispData;
    }





}
