<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
  <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          


          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="https://sumura80.github.io/muraoka-introduction/aboutme.html">About Me</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="/service">Service</a>
            </li> --}}
            <!-- ナビゲーションバー -->
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  哺乳類
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  @foreach($categories as $category)
                    <a class="dropdown-item" href="#">{{$category->name}}</a>
                   @endforeach
                  <a class="dropdown-item" href="#">メニュー1</a>
                  <a class="dropdown-item" href="#">メニュー2</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">その他</a>
                </div>
              </li>

              <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  両生類
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  @foreach($category->posts as $post)
                    <a class="dropdown-item" href="#">{{$post->title}}</a>
                   @endforeach
                  <a class="dropdown-item" href="#">メニュー1</a>
                </div>
              </li> --}}



              @foreach($categories as $category)
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{-- カテゴリ名 --}}
                {{ $category->name }}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                {{-- カテゴリにリレーションされているPOST一覧取得 --}}
                @foreach($category->posts as $post)
                  <a class="dropdown-item" href="/posts/{{$post->slug}}">{{$post->title}}</a>
                @endforeach
                {{-- <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">その他</a> --}}
              </div>
            </li>
            @endforeach
          </ul>
          

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <form class="form-inline my-2 my-lg-0" action="/search" method="GET">
                @csrf
                <input class="form-control mr-sm-2" name='keyword'  type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
              </form>
              <!-- Authentication Links -->
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
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a href="{{route('posts.index')}}"class="dropdown-item">Posts</a>
                          <!-- Auth のみCategoriesを表示する-->
                          @if(Auth::user()->role === 'administrator')
                            <a href="{{route('categories.index')}} "class="dropdown-item">Categories</a>
                          @endif

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