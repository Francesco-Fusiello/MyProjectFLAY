<nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container-fluid ">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- <nav class="navbar bg-body-tertiary">
        </nav> --}}
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('logo.png') }}" style="width:120px;"
                alt="Logo del sito"></a>



        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mb-2 mb-lg-0">
                {{-- home --}}
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}"><i class="fa-solid fa-house fs-lg" style="color: #127DC5; border: 1px,   color: white;"></i></a>
                </li>


                {{-- bandiere --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold fst-italic" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-earth-americas " style="color: #127DC5;"></i>
                    {{-- {{ __('ui.ling') }} --}}
                    </a>


                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><x-_locale lang='it' nation='it' /></a></li>
                        <li><a class="dropdown-item" href="#"><x-_locale lang='en' nation='gb' /></a></li>
                        <li><a class="dropdown-item" href="#"><x-_locale lang='fr' nation='fr' /></a></li>
                    </ul>
                </li>
                





                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                        href="{{ route('announcements.index') }}"><i class="fa-solid fa-bag-shopping me-2 " style="color: #127DC5;"></i>{{ __('ui.nav_ann') }}</a>
                </li>

                {{-- DropDown categorie --}}
                {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{__('ui.cat')}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item"
                                        href="{{ route('categoryShow', compact('category')) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li> --}}
            </ul>



            <ul class="navbar-nav ms-auto montserrat-regular fs-6 me-4">
                {{-- <li class="d-flex "> --}}
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('ui.login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"> {{ __('ui.register') }}</a>
                    </li>
                @else
                    <li>
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('announcements.create') }}"><i class="fa-solid fa-bullhorn" style="color: #127DC5;"></i> {{ __('ui.creaNav') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold fst-italic" style="color: #127DC5;" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" id="tab-login" data-mdb-pill-init href="#" role="tab"
                                    aria-controls="pills-logout" aria-selected="true"
                                    onclick="
                                    event.preventDefault();
                                    getElementById('form-logout').submit();
                                    ">Logout</a>
                                <form action="/logout" method="POST" id="form-logout">@csrf</form>
                            </li>
                        </ul>
                    </li>

                    @if (Auth::user()->is_revisor)
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-info btn-sm position-relative" aria-current="page"
                                href="{{ route('revisor.index') }}">
                                {{ __('ui.areaRev') }}
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ App\Models\Announcement::toBeRevisionedCount() }}
                                    <span class="visually-hidden"> {{ __('ui.messN') }}</span>
                                </span>
                            </a>
                        </li>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>




{{-- <li> --}}
{{-- <div class=" justify-content-end ">
                        <form action="{{ route('announcement.search') }}" method="GET" class="d-flex">
                            <input type="search" name="searched" class="form-control me-2" style="width: 100%"
                                placeholder='Cosa stai cercando?' aria-label='Search'>
                            <button class="btn btn-outline-success" type='submit'>Cerca</button>
                        </form>
                    </div> --}}
{{-- 
        </li> --}}
