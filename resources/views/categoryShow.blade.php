@php
    use Illuminate\Support\Str;
@endphp
<x-layout>
    <x-barraricerca />

    <x-button_category />

    <section id="header" class="jumbotron text-center position-relative">
        <img src="{{ $category->image }}" class="d-block w-100 h-25" alt="...">
        <h1 class="display-3 position-absolute top-50 start-50 translate-middle text-white">{{ __('ui.' . $category->name) }}</h1>
    </section>

    <section id="gallery">
        <div class="container mt-4">
            <div class="row justify-content-center">

                @forelse($ann_cat as $announcement)
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                        <div class="card shadow mb-3">
                            <img src="{{ !$announcement->images()->get()->isEmpty()
                                ? $announcement->images()->first()->getUrl(256, 256)
                                : //   Storage::url($announcement->images()->first()->path)
                                'https://picsum.photos/200' }}"
                                alt="" class="card-img-top">
                            <div class="card-body">
                                {{-- <h5 class="card-title text-primary" title='{{$announcement->title}}'>{{ Str::limit($announcement->title, 20,'...') }}</h5> --}}
                                <h5 class="card-title mt-2 x" title='{{$announcement->title}}'>
                                    <a class="titleAnn" href="{{ route('announcements.show', $announcement) }}">
                                    {{ Str::limit($announcement->title, 20,'...') }}</a>
                                </h5>
                                <p class="tag__item"><i class="fas fa-tag mr-2"> </i>{{ __('ui.value') }}
                                    {{ $announcement->price }}</p>
                                <p class="card-text fs-6 fst-italic ">{{ __('ui.author') }}
                                    {{ $announcement->user->name }}</p>
                                <a href="{{ route('announcements.show', $announcement) }}"
                                    class="col-6 btn btn-outline-primary btn-sm">{{ __('ui.visua') }}</a>
                                {{-- <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-heart"></i></a> --}}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="h1">{{ __('ui.noann') }}</p>
                        <p class="h2 mt-5">{{ __('ui.creaNav') }}: <a href="{{ route('announcements.create') }}"
                                class="btn btn-primary shadow">{{ __('ui.annuncio') }}</a> </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <div class=" m-3">
        {{ $ann_cat->links() }}
    </div>
    

</x-layout>
