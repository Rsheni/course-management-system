<!DOCTYPE html>
<html>

<head>
    <title>Laravel RBAC Example</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <nav>
        <ul>
            @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
            @endguest

            @auth
            <li><a href="{{ route('home') }}">Home</a></li>

            @if(Auth::user()->role->name === 'admin')
            <li><a href="{{ route('admin.createUserForm') }}">Create User</a></li>
            @endif

            @if(Auth::user()->role->name === 'instructor')
            <li><a href="{{ route('courses.create') }}">Create Course</a></li>
            @endif

            @if(Auth::user()->role->name === 'student')
            <li><a href="{{ route('courses.myCourses') }}">My Courses</a></li>
            @endif

            <li><a href="{{ route('courses.index') }}">All Courses</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
            @endauth
        </ul>
    </nav>

    <div class="container">
        @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @yield('content')
    </div>
</body>

</html>