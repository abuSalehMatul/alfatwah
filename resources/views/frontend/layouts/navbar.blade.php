<div class="main-menu">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="MyNavbar">
        <div class="container">
            {{-- <a class="navbar-brand text-center" style="font-family: 'Arizonia';font-size: 29px;line-height: 46px;font-weight: bolder;" href="{{route('home')}}">{{__('Site_Name')}}<br /></a> --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('questions.create')}}">{{__('Send a New Question')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('new_answer_list')}}">{{__('New_Answers')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('all_article')}}">{{__('Articles')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about.us')}}">{{__('About')}}</a>
                    </li>
                    <div class="nav-item nav-auth">
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
                    </div>

                    <li>
                        <search-bar></search-bar>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="intro" style="text-align: center !important">
    {{__('Intro')}}
</div>
