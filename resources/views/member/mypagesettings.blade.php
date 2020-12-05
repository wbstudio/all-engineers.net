@extends('member.layout')
@section('title', 'Page Title')

@section('head')
<link rel="stylesheet" href="{{ asset('css/member/mypagesettings.css') }}">
@endsection

@section('content')
<div class="innre_contents">
<h2 class="contents_title">Mypage Settings<h2>
<form action="" method="POST">
    @csrf
    <table>
        <tr>
            <th>Name</th>
            <td><input type="text" name="name" value="{{ $member->name }}"></td>
        </tr>
        <tr>
            <th>Age</th>
            <td>
                <select name="age">
                    <option>年齢</option>
                    @for ($i = 18; $i <= 50; $i++)
                        <option value="{{ $i }}" @if(isset($member->age) && $member->age == $i) selected @endif>{{ $i }}歳</option>
                    @endfor                    
                </select>
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td><input type="text" name="email" value="{{ $member->email }}"></td>
        </tr>
        <tr>
            <th>Course</th>
            <td>
            {{config("course.$member->course.name")}}コース
            </td>
        </tr>
        <tr>
            <th>Living Area</th>
            <td>{{config("simple_prefectuer.$member->prefecture")}}</td>
        </tr>
        <tr>
            <th>Progress</th>
            <td>現在の進捗状況は{{$member->progress}}%です。</td>
        </tr>
        <tr>
            <th>Current Work</th>
            <td><input type="text" name="current_work" value="{{$member->current_work}}" placeholder="現在の職業"></td>
        </tr>
        <tr>
            <th class="ver_top">Working Area</th>
            <td>
                @foreach(Config::get('prefecture') as $rural)
                    <h5> {{$rural['name']}}</h5>
                    @foreach($rural['prefecture'] as $prefecture)
                    <div class="prefecture">
                        <input type="checkbox" name="work_area[]" value="{{$prefecture['key']}}" {{ is_array($member->work_area) && in_array($prefecture['key'], $member->work_area, true)? 'checked="checked"' : '' }}><span>{{$prefecture['name']}}</span>
                    </div>
                    @endforeach
                @endforeach
                <h5></h5>
                <div class="prefecture">
                <input type="checkbox" name="work_area[]" value="47" {{ is_array($member->work_area) && in_array("47", $member->work_area, true)? 'checked="checked"' : '' }}><span>リモート</span>
                </div>
            </td>
        </tr>
        <tr>
            <th class="ver_top">Memo</th>
            <td><textarea name="memo" placeholder="これまでの経歴、将来の夢や不安、等をお好きにご記入ください。">{!! $member->memo !!}</textarea></td>
        </tr>
    </table>
    <input type="hidden" name="id" value="{{$member->id}}">
    <div class="btn_area">
        <input type="submit" value="更新する">
    </div>

</form>
</div>
@endsection