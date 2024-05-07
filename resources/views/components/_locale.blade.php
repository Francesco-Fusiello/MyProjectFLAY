<form action="{{ route('set_language_locale', $lang) }}" method="POST">
    @csrf
    <button type="submit" class="nav-link  text-uppercase" style="background-color: transparent; border: none; color:black;">
        <img src="{{asset('vendor/blade-flags/language-' . $lang . '.svg')}}" width="32" eight="32" alt="" />
        <span class="fi fi-{{ $nation }}"></span>
        {{$nation = sprintf(" %s", $nation)}}
    </button>
</form>
