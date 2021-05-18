<!Doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog</title>

    <!-- Font Awesome -->
    <script 
    src="https://use.fontawesome.com/releases/v5.13.1/js/all.js" 
    integrity="sha384-heKROmDHlJdBb+n64p+i+wLplNYUZPaZmp2HZ4J6KCqzmd33FJ8QClrOV3IdHZm5" 
    crossorigin="anonymous"
    defer
    ></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/xtra.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/xtra.css') }}" rel="stylesheet">

    <!--Livewiew Styles-->
     {{-- @livewireStyles --}}
        @yield('css')
  <style>
      body{
      background-size: cover;
      background-color:  aliceblue;
    }
    btn, btn:active, btn:hover, btn-success, btn-primary, btn-danger, btn-secondary{
    outline: none;
    }
    text-green{
        color: #41B883;
    }
    bg-green{
        background: #41B883;
    }
  </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Blog
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                        @auth()
                         <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="dropdown-item py-1 px-4 dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 <span class="caret"></span> Menu
                                </a>
                        
                        
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('posts.create')}}">Create Post</a>

                                <a class="dropdown-item" href="{{route('posts.index')}}">Posts</a>

                                <a class="dropdown-item" href="{{route('category.create')}}">Create Category</a>
                                <!-- <hr> -->
                                
                                <!-- <hr> -->
                                <a class="dropdown-item" href="{{ route('users') }}">All Users</a>
                                </div>
                        </li>

                        <li class="nav-item">
                           <a class="dropdown-item" href="{{ route('nots')}}">
                             {{-- <unread ></unread> --}}
                             Notifications
                             @if(auth()->user()->unreadNotifications->count() > 0) 
                             <span 
                             {{-- class="text-white p-1 rounded bg-danger"  --}}
                             class="badge"
                             style="background: #FF0000; color: white;"
                             >
                                 <strong>
                                         {{auth()->user()->unreadNotifications->count()}}
                                        </strong>
                                    </span>
                            @endif 
                            </a>
                        </li>

                        <li class="nav-item">
                           <a class="dropdown-item" href="{{route('category.index')}}">Categories</a>
                        </li>
{{-- 
                         <li class="nav-item">
                           <a class="dropdown-item" href="{{route('subscription.index')}}">Subscriptions</a>
                        </li> --}}
                         
                        <li class="nav-item dropdown">
                                <a 
                                    id="navbarDropdown" 
                                    class="dropdown-item py-1 px-4 dropdown-toggle" 
                                    href="#" role="button" 
                                    data-toggle="dropdown" 
                                    aria-haspopup="true" 
                                    aria-expanded="false" 
                                    v-pre
                                >
                                 <span class="caret"></span> Feed
                                </a>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                               

                                    <a class="dropdown-item" href="{{route('followedPosts')}}">
                                        Followed Posts
                                    </a>

                                    <a class="dropdown-item" href="{{route('friendsPosts')}}">
                                        Friends Posts
                                    </a>
                                  
                                </div>
                        </li>

                         
                       
                        @endauth
                                                    

                      


                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item mr-4">
                            <form class="form pt-3" method="get" action="{{ route('search')}}">
                                
                            <div class="input-group">
                              <input type="text" name="q" class="form-control" placeholder="Search...">
                              <div class="input-group-append">
                                <input class="btn btn-success" type="submit" value="Go" >
                              </div>
                            </div>
                            </form>
                            </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a 
                                    id="navbarDropdown" 
                                    class="nav-link dropdown-toggle mt-2" 
                                    href="#" 
                                    role="button" 
                                    data-toggle="dropdown" 
                                    aria-haspopup="true" 
                                    aria-expanded="false" 
                                    v-pre
                                >
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.show', auth()->user()->slug ) }}" >
                                       {{ __('Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <div class="text-center bg-white py-2 footer" 
    style="position: relative;bottom: -23px;left: 0; width: 100%; ">
   
        <p>This is Blog. All right reserved!</p>
           

        <p>{{Date('Y')}}</p>
    </div>

    {{-- @livewireScripts --}}
</body>
@auth
<script>
</script>
@yield('js')
@endauth



</html>
