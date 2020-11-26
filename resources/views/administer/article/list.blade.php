@extends('administer.layout')
@section('title', 'Page Title')
@section('head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('js/administer/article.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <h2>記事一覧</h2>
    <div class="card-body">
     @if (session('status'))
         <div class="alert alert-success" role="alert">
             {{ session('status') }}
         </div>
     @endif
     <div class="list_top_area">
        <form method="POST" action="{{route('article_list')}}" class="narrow_down">
        @csrf
            <div id="narrow_down">
                <div class="nd_course">
                    <select class="course" name="course">
                        <option value="">コース</option>
                        @foreach(Config::get('course') as $key => $course)
                            <option value="{{$key}}" @if(isset($selected_course) && $selected_course == $key) selected @endif>{{$course["name"]}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="nd_course">
                    <select class="classification"  name="classification" @if(isset($selected_classification) && $selected_classification == null) disabled @endif>
                        <option value="">分類</option>
                        @foreach(Config::get('course') as $key => $course)
                            @foreach($course["classification"] as $idx => $classification)
                                <option value="{{$idx}}" class="course_{{$key}}" @if(isset($selected_classification) && $selected_classification == $idx) selected @endif>{{$classification}}</option>
                            @endforeach    
                        @endforeach
                    </select>
                </div>
                <div class="nd_course">
                    <input type="submit" value="絞り込む">
                </div>
            </div>
        </form>
        <a href="{{route('article_regist_question')}}" class="regist_link">{{ __('新規作成') }}</a>
     </div>
    <form action="{{route('article_delete')}}" method="POST">
    @csrf
    @if(isset($articles) && count($articles) > 0)
    <table class="list" border="1">
        <tr>
            <th>id</th>
            <th>status</th>
            <th>course</th>
            <th class="classification">classification</th>
            <th>order</th>
            <th class="max">title</th>
            <th>delete</th>
        </tr>
         @foreach ($articles as $index => $article)
         <tr>
         <td><a href="editquestion/{{ $article -> id}}">{{$article -> id}}</a></td>
         <td><div class="status_{{$article -> status}}">{{$article -> str_status}}</div></td>
         <td>{{$article -> str_course}}</td>
         <td class="classification">{{$article -> str_classification}}</td>
         <td>{{$article -> order}}</td>
         <td class="title"><a href="editquestion/{{ $article -> id}}">{{$article -> title}}</a></td>
         <td><input type="checkbox" value="{{$article -> id}}" name="del_id[]"></td>
         </tr>
         @endforeach
     </table>
     <input type="submit" value="checkしたものを消す" id="delete">
     @else
     <p>
     記事が一つもありません！！！
     </p>
     @endif
    </form>
    <div id="pagenator">
        @isset($pagenator -> firstPageNum)
         <a href="{{route("article_list")}}/{{$baseurl}}{{$pagenator -> firstPageNum}}">最初</a>
         @endisset
         @isset($pagenator -> prePageNum)
         <a href="{{route("article_list")}}/{{$baseurl}}{{$pagenator -> prePageNum}}">前へ</a>
         @endisset
         @isset($pagenator -> firstPageNum)
         ...
         @endisset
         @isset($pagenator -> linkNum)
             @foreach($pagenator -> linkNum as $key => $Num)
             @if($page == $Num)
             <span style="background:#FF0;">{{$Num}}</span>
             @else
             <a href="{{route("article_list")}}/{{$baseurl}}{{$Num}}">{{$Num}}</a>
             @endif
             @endforeach
         @endisset
         @isset($pagenator -> lastPageNum)
         ...
         @endisset
         @isset($pagenator -> nextPageNum)
         <a href="{{route("article_list")}}/{{$baseurl}}{{$pagenator -> nextPageNum}}">次へ</a>
         @endisset
         @isset($pagenator -> lastPageNum)
         <a href="{{route("article_list")}}/{{$baseurl}}{{$pagenator -> lastPageNum}}">最後</a>
         @endisset
    </div>
</div>
@endsection