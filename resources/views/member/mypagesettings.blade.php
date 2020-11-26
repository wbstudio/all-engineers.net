@extends('member.layout')
@section('title', 'Page Title')
@section('head')

@endsection

@section('content')
<div class="innre_contents">
<form action="" method="POST">
    <table>
        <tr>
            <th>Name</th>
            <td><input neme="name" value="{{ $member->name }}"></td>
        </tr>
        <tr>
            <th>Age</th>
            <td></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><input neme="name" value="{{ $member->email }}"></td>
        </tr>
        <tr>
            <th>Course</th>
            <td></td>
        </tr>
        <tr>
            <th>Residence</th>
            <td></td>
        </tr>
        <tr>
            <th>Progress</th>
            <td></td>
        </tr>
        <tr>
            <th>Job Area</th>
            <td></td>
        </tr>
        <tr>
            <th>Current Work</th>
            <td><input neme="name" value=""></td>
        </tr>
        <tr>
            <th>Memo</th>
            <td><textarea name="memo">{!! $member->memo !!}</textarea></td>
        </tr>
    </table>
</form>
</div>
@endsection