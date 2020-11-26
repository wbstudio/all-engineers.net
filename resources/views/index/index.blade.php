<html>
<head>
</head>
<body>
    <form method="POST" action="{{route('index')}}" class="first_regist">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif
        <div>
            <input type="text" name="name">
        </div>
        <div>
            <input type="text" name="email">
        </div>
        <div>
            <input type="password" name="password">
        </div>
        <div>
            <select name="course">
                <option value="">ご希望のコース</option>
                @foreach(Config::get('course') as $key => $course)
                <option value="{{$key}}">{{$course["name"]}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <select name="prefecture">
                <option value="">お住いの都道府県</option>
                @foreach(Config::get('prefecture') as $rural)
                <optgroup label="{{$rural['name']}}">
                    @foreach($rural['prefecture'] as $prefecture)
                    <option value="{{$prefecture['key']}}">{{$prefecture['name']}}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <input type="submit" value="登録する">
    </form>
    <form method="POST" action="{{route('index')}}" class="scond_regist">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif
        <div>
            <input type="text" name="name">
        </div>
        <div>
            <input type="text" name="email">
        </div>
        <div>
            <input type="password" name="password">
        </div>
        <div>
            <select name="course">
                <option value="">ご希望のコース</option>
                @foreach(Config::get('course') as $key => $course)
                <option value="{{$key}}">{{$course["name"]}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <select name="prefecture">
                <option value="">お住いの都道府県</option>
                @foreach(Config::get('prefecture') as $rural)
                <optgroup label="{{$rural['name']}}">
                    @foreach($rural['prefecture'] as $prefecture)
                    <option value="{{$prefecture['key']}}">{{$prefecture['name']}}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <input type="submit" value="登録する">
    </form>
</body>
</html>