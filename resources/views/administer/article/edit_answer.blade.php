@extends('administer.layout')
@section('title', 'Page Title')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('js/administer/article.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
@section('head')

@endsection

@section('content')
<div class="container">
<div class="edit">
    <h2>編集-解答</h2>
        <form method="POST" action="" class="regist_place">
        @csrf
            <table>
                <tr>
                    <th>commentary</th>
                    <td colspan="2">
                        <textarea name="commentary" id="editor">
                        @isset($dispobj -> commentary)
                            {!! $dispobj -> commentary !!}
                        @endisset
                        </textarea>
                        <script>
                            window.onload=function(){
                                CKEDITOR.replace('editor',{
                                    filebrowserBrowseUrl:filemanager.ckBrowseUrl
                                })
                            }
                        </script>
                    </td>
                </tr>
                <tr>
                    <th>status</th>
                    <td colspan="2">
                        <select class="status" name="status">
                            <option value="">公開状態</option>
                            @foreach(Config::get('status') as $key => $status)
                                <option value="{{$key}}" @if(isset($dispobj -> status) && $dispobj -> status == $key) selected @endif>{{$status}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>
            <div class="btn_area">
            @foreach($hiddenArr as $hiddenkey => $hiddenval)
            <input type="hidden" name ="{{$hiddenkey}}" value="{{$hiddenval}}">
            @endforeach
            <input type="button" value="登録" class="submit">
            <input type="button" value="戻る" class="back">
            </div>
        </form>
    </div>
</div>
</div>
@endsection