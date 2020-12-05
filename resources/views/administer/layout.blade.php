<html>
    <head>
        <title>サイト名 - @yield('title')</title>
        <link rel="stylesheet" href="{{ asset('css/administer/common.css') }}">
        @yield('head')
        @FilemanagerScript
    </head>
    <body>
        <header>
            all-engineers.net管理画面
        </header>

        <main>
            <div id=sidenavi class="content">
                <ol>
                <a href="{{route('article_list')}}"><li>Top</li></a>
                <a href="{{route('inquiry_list')}}"><li>Top</li></a>
                    <li>記事管理</li>
                    <li>問い合わせ管理</li>
                    <li>コラム管理</li>
                    <li>用語管理</li>
                    <li>よくある質問管理</li>
                    <li>ユーザー管理</li>
                </ol>
            </div>
            <div id="content" class="content">
                @yield('content')
            </div>
        </main>

        <footer>
            all-engineers.net管理画面
        </footer>
    </body>
</html>