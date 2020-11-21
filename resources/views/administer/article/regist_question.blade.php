@extends('administer.layout')
@section('title', 'Page Title')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('js/administer/article.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
@section('head')

@endsection

@section('content')
<div class="container">
<div class="regist">
    <h2>編集-説明,問題</h2>
        <form method="POST" action="{{route('article_regist_answer')}}" class="regist_place">
        @csrf
            <table>
                <tr>
                    <th>course<br>classification</th>
                    <td>
                        course:
                        <select class="course" name="course">
                            <option value="">コース</option>
                            @foreach(Config::get('course') as $key => $course)
                                <option value="{{$key}}">{{$course["name"]}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        classification:
                        <select class="classification"  name="classification" disabled>
                            <option value="">分類</option>
                            @foreach(Config::get('course') as $key => $course)
                                @foreach($course["classification"] as $idx => $classification)
                                    <option value="{{$idx}}" class="course_{{$key}}">{{$classification}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>title</th>
                    <td colspan="2">
                        <input type="text" name="title" value="{{$dispobj -> title}}">
                    </td>
                </tr>
                <tr>
                    <th>heading</th>
                    <td colspan="2">
                        <textarea name="heading">
                        {!!$dispobj -> heading!!}
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <th>explanation</th>
                    <td colspan="2">
                        <textarea name="explanation" id="editor">
                        {!!$dispobj -> explanation!!}
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
                    <th>movie_link</th>
                    <td colspan="2">
                        <input type="text" name="movie_link" value="{{$dispobj -> movie_link}}">
                    </td>
                </tr>

                <tr>
                    <th>question</th>
                    <td colspan="2">
                        <textarea name="question" id="question">
                        {!!$dispobj -> question!!}
                        </textarea>
                    </td>
                </tr>
            </table>
            <div class="btn_area">
                <input type="submit" value="登録" class="submit">
            </div>
            <input type="hidden" name ="coursehidden" value="{{$dispobj -> course}}">
            <input type="hidden" name ="classhidden" value="{{$dispobj -> classification}}">
            @foreach($hiddenArr as $hiddenkey => $hiddenval)
            <input type="hidden" name ="{{$hiddenkey}}" value="{{$hiddenval}}">
            @endforeach
        </form>
    </div>
</div>
</div>
@endsection