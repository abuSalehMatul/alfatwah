<div class="top_nav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a href="{{route('home')}}">
                    <img src="{{asset('/logo.png')}}" class="logo">
                    </a>
                </li>
                <li class="nav-item active"> 
                    <a class="navbar-brand text-center brandtext pl-3" style="font-size: 29px;line-height: 46px;font-weight: bolder;" href="{{route('home')}}">{{__('Site_Name')}}<br /></a>
                </li>
            </ul>
            <li class="nav-item dropdown">
                @php
                    $thisUrl = url()->current().'/';
                @endphp
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownforlang" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-globe-americas"></i>
                    {{config("app_langs.".app()->getLocale())}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownforlang">
                    @foreach(config('app_langs') as $key => $lang)
                    @php
                        $newUrl  = str_replace(app()->getLocale(), $key, $thisUrl);
                    @endphp
                    <a class="dropdown-item" href="{{$newUrl}}">{{$lang}}</a>
                    @endforeach
                </div>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal"><i class="far fa-user-circle"></i> {{ __('Login')}}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a id="logout-btn" class="dropdown-item" href="{{route('profile', auth()->id())}}" >
                            {{ __('Profile') }}
                        </a>
                        <a id="logout-btn" class="dropdown-item" href="#" onclick="logout();">
                            {{ __('Logout') }}
                        </a>

                       

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </nav>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('login') }}">
            @csrf            
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Please login to continue')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>


                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">{{__('Password')}}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @if (Route::has('password.request'))
                    <div class="form-group">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                    @endif


                    <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>

                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-primary">{{ __('Login') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
