<x-layout>

    @if (session()->has('access.denied'))
        <div class="alert alert-danger fst-italic" role="alert">
            {{ session('access.denied') }}
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success fst-italic" role="alert">
         {{ session('message') }}
        </div>
    @endif

    <x-barraricerca />

    <x-button_category />

    {{-- Banner  --}}

    <div class="container-fluid">
        <div class="row position-relative">
            <div class="col-12 d-flex justify-content-center  ">
                <a href="{{ route('categoryShow', 9) }}">
                    <img class="img-fluid banner rounded-5 shadow "  src="{{ __('ui.banner') }}" alt="">
                </a>
                <a href="{{ route('categoryShow', 9) }}">
                    <button class="button-1">{{ __('ui.scoprili') }}</button>
                </a>
            </div>
        </div>
    </div>



    {{-- Testo ultimi annunci --}}
    <section class="light">
        <div class="container py-1">
            <div class="h2 text-center text-dark raleway-Thin" id="pageHeaderTitle">{{ __('ui.allAnnouncements') }}
            </div>

            {{-- Carosello --}}
            <div id="carouselExampleFade" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                    @foreach ($announcements as $key => $announcement)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="postcard light red">
                                <div class="postcard__img_link">
                                    <img class="postcard__img"
                                        src="{{ !$announcement->images()->get()->isEmpty() ? $announcement->images()->first()->getUrl(256,256)
                                        // Storage::url($announcement->images()->first()->path) 
                                        : 'https://picsum.photos/200' }}"
                                        alt="Image Title" />
                                </div>
                                <div class="postcard__text t-dark">
                                    <h1 class="postcard__title red"><a
                                            href="{{ route('announcements.show', $announcement) }}">{{ $announcement->title }}</a>
                                    </h1>
                                    <div class="postcard__subtitle small">
                                            <i class="fas fa-calendar-alt mr-2"> {{ __('ui.pub') }}
                                                {{ $announcement->created_at->format('d/m/y') }}</i>
                                        </time>
                                    </div>
                                    <div class="postcard__bar"></div>
                                    <div class="postcard__preview-txt"> {{ $announcement->body }}</div>
                                    <ul class="postcard__tagbox">
                                        <li class="tag__item"><i class="fas fa-tag mr-2"></i>{{ __('ui.value') }}
                                            {{ $announcement->price }}</li>
                                        <li class="tag__cat play red ms-3">
                                            <a
                                                href="{{ route('categoryShow', ['category' => $announcement->category]) }}"><i
                                                    class="fas fa-play mr-2"></i> {{ __('ui.category') }}
                                                {{ __('ui.' . $announcement->category->name) }}</a>
                                        </li>
                                    </ul>
                                    <p class="card-text fs-6 fst-italic ">{{ __('ui.author') }}
                                        {{ $announcement->user->name }}</p>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
</x-layout>
