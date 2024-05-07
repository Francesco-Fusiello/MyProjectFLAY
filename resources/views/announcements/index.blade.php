@php
    use Illuminate\Support\Str;
@endphp

<x-layout>
    <x-barraricerca />
    <x-button_category />

    @if (session()->has('success'))
        <div class="alert alert-success fst-italic" role="alert">
            {{ session('success') }}
        </div>
    @endif


    <div class="container py-5">
        <!-- For Demo Purpose-->
        <header class="text-center mb-5">
            {{-- <h1 class="display-4 font-weight-bold"> {{ __('ui.tuttiAnn') }}</h1> --}}
            @if (isset($searchTerm))
                <h1>{{ __('ui.risRic') }}: {{ $searchTerm }}</h1>
            @else
                <h1>{{ __('ui.tuttiAnn') }}</h1>
            @endif

        </header>

        <!-- First Row [Prosucts]-->

        <div class="row pb-5 mb-4">
            @forelse($announcements as $announcement)
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-4">
                    <!-- Card-->
                    <div class="card rounded shadow-sm border-0">
                        <div class="card-body p-4"> <img class="postcard__img img-fluid w-100 h-auto"
                                src="{{ !$announcement->images()->get()->isEmpty()
                                    ? $announcement->images()->first()->getUrl(256, 256)
                                    // ? Storage::url($announcement->images()->first()->path)
                                    :'https://picsum.photos/256' }}"
                                alt="Image Title" />
                            {{-- <img src="https://picsum.photos/200" alt="" class='img-fluid d-block mx-auto mb-3'> --}}

                            <h5 class="card-title mt-2 x" title='{{$announcement->title}}'>
                                <a class="titleAnn" href="{{ route('announcements.show', $announcement) }}">
                                {{ Str::limit($announcement->title, 20,'...') }}</a>
                            </h5>
                            <p class="card-text"title='{{$announcement->body}}'>{{ Str::limit($announcement->body, 25,'...') }}</p>
                            <p class="card-text">{{ __('ui.value') }} {{ $announcement->price }}</p>
                            {{-- <a href="{{ route('announcements.show', $announcement) }}"
                                class="btn btn-primary shadow w-50">{{ __('ui.visua') }}</a> --}}
            
                            <p>
                                <a href="{{ route('categoryShow', ['category' => $announcement->category]) }}"
                                    class="w-100 my-2 border-top pt-2 border-dark card-link shadow btn btn-outline-primary ">{{ __('ui.category') }}
                                    {{ __('ui.' . $announcement->category->name) }}</a>
                            </p>
                            <p class="card-footer">{{ __('ui.pub') }}
                                {{ $announcement->created_at->format('d/m/y') }}</p>
                            <p class="card-text fs-6 fst-italic ">{{ __('ui.author') }}
                                {{ $announcement->user->name }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning py-3 shadow">
                        <p class="lead">{{ __('ui.nessA') }}</p>
                    </div>
                </div>
            @endforelse
            <div class=" m-3">
                {{ $announcements->links() }}
            </div>
            
        </div>
    </div>
</x-layout>
