<html>
    <head>
        <title>サイト名 - @yield('title')</title>
        <link rel="stylesheet" href="{{ asset('css/member/common.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{ asset('js/member/common.js') }}"></script>
        @yield('head')
    </head>
    <body>
        <main>
            <div id="side_navi">
                <div class="logo_area">
                    <a>all-engineers.net</a>
                </div>
                <ul>
                    <li><a href="{{route('member_top')}}">Top Page</a></li>
                    <li><a href="{{route('article_list')}}">Lesson</a></li>
                    <li><a href="{{route('article_list')}}" class="disable">Column</a></li>
                    <li><a href="{{route('member_inquiry')}}">Inquiry</a></li>
                    <li><a href="{{route('article_list')}}" class="disable">FAQ</a></li>
                    <li><a href="{{route('article_list')}}" class="disable">Glossary</a></li>
                    <li><a href="{{route('article_list')}}" class="disable">Search Jobs</a></li>
                </ul>
            </div>
            <div id ="main_area">
                <div id="head_area" class="content">
                    <div class="pan_area">
                        <div class="pan_link">パンくずリスト-リンク</div>
                        <div class="pan_arrow">></div>
                        <div class="pan_current">このページ</div>
                    </div>
                    <div class="personal_area">
                        <div class="name_area">
                            <div class="">{{$member->name}}さん<img src="http://all-engineers.net/images/opener.png" class="prof_open"></div>
                        </div>
                        <div class="prof_area">
                            <a class="prof_link prof_inner" href="{{route('my_page_settings')}}"><img src="http://all-engineers.net/images/pen.png">Settings</a>
                            <a class="log_out prof_inner" href="{{route('member_logout')}}"><img src="http://all-engineers.net/images/logout.png">Log out</a>
                        </div>
                    </div>
                </div>
                <div id="content" class="content">
                    @yield('content')
                </div>
            </div>
        </main>

        <footer>
            copy right all-engineers.net
        </footer>
    </body>
</html>