<?php

namespace App\Http\Controllers\Administer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvailController extends Controller
{
    /*
    *
    *$dArray=>データ
    *$c_page=>現在のページ
    *$per_page=>ページ内の表示数
    *で動くページネーター
    */
    public static function purepagenator($all_cnt,$c_page,$per_page){
        $link = new \stdClass();
        $displayData =  new \stdClass();
        $pagenator =  new \stdClass(); 
        $totalData = $all_cnt;
        $totalPageCount = ceil($totalData/$per_page);
        $linkArray = array();
        if($c_page > 1){
            $link->prePageNum = $c_page - 1;
        }
        if($c_page < $totalPageCount){
            $link ->nextPageNum = $c_page + 1;
        }
        if($c_page > 4){
            $link ->firstPageNum   = 1;
        }
        if($c_page < $totalPageCount - 3){
            $link ->lastPageNum    = $totalPageCount;
        }
        $start = 1;
        $end = $totalPageCount;
        if($c_page > 3){
            $start = $c_page - 3; 
        }
        if($c_page < $totalPageCount - 3){
            $end = $c_page + 3; 
        }
        for($i = $start;$i < $end + 1;$i++){
            $linkArray[$i-$start] = $i;
        }

        $link ->linkNum = $linkArray;
        $pagenator ->link = $link;
        return $pagenator;
    }
    /*
    *$dArray=>データ
    *$c_page=>現在のページ
    *$per_page=>ページ内の表示数
    *で動くページネーター
    */
    public static function complexpagenator($dArray,$c_page,$per_page){
        $link = new \stdClass();
        $displayData =  new \stdClass();
        $pagenator =  new \stdClass(); 
        foreach($dArray as $array){
            $dArray = $array;
        }
        $separateData = array_chunk($dArray, $per_page);
        $displayData = $separateData[$c_page - 1];
        $totalData = count($dArray);
        $totalPageCount = ceil($totalData/$per_page);
        $linkArray = array();
        if($c_page > 1){
            $link->prePageNum = $c_page - 1;
        }
        if($c_page < $totalPageCount){
            $link ->nextPageNum = $c_page + 1;
        }
        if($c_page > 4){
            $link ->firstPageNum   = 1;
        }
        if($c_page < $totalPageCount - 3){
            $link ->lastPageNum    = $totalPageCount;
        }
        $start = 1;
        $end = $totalPageCount;
        if($c_page > 3){
            $start = $c_page - 3; 
        }
        if($c_page < $totalPageCount - 3){
            $end = $c_page + 3; 
        }
        for($i = $start;$i < $end + 1;$i++){
            $linkArray[$i-$start] = $i;
        }
        $link ->linkNum = $linkArray;
        $pagenator ->link = $link;
        $pagenator ->data = $displayData;

        return $pagenator;
    }

}
