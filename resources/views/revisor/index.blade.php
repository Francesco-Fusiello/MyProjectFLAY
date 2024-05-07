<x-layout>
    @if (session()->has('message'))
        <div class="alert alert-success fst-italic" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="text-center">
        @if ($announcement_to_check->isEmpty())
            {{ __('ui.NonAnnunci') }}
        @else
            {{ __('ui.titRev') }}
        @endif
    </h2>



    @if (!$announcement_to_check->isEmpty())
        <!-- Script per aggiornare dinamicamente il contenuto della modal -->
        <script>
            $(document).ready(function() {
                $('.btn-view-article').click(function() {
                    var announcementId = $(this).data('announcement-id');
                    $('#myModal' + announcementId).modal('show');
                });
            });
        </script>

        <table id="example" class="col-12 table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    {{-- <th>{{ __('ui.acc') }}  Rifiutato</th> --}}
                    <th></th>
                    <th>{{ __('ui.titolo') }}: </th>
                    <th class="d-none d-sm-table-cell">{{ __('ui.descri') }}</th>
                    <th>{{ __('ui.value') }}</th>
                    <th class="d-none d-sm-table-cell">{{ __('ui.category') }}</th>
                    <th class="d-none d-sm-table-cell">{{ __('ui.pub') }}</th>
                    <th></th>
                    <th class="text-center ">{{ __('ui.acc') }}/{{ __('ui.rif') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($announcement_to_check as $ann_ck)
                    <tr>
                        <td>
                            <div class="d-flex justify-content-center ">
                                <div class="circle-img">
                                    <img src="{{ !$ann_ck->images()->get()->isEmpty()
                                        ? Storage::url($ann_ck->images()->first()->path)
                                        : //$ann_ck->images()->first()->getUrl(256,256)
                                        'https://picsum.photos/200' }}"
                                        alt="Immagine dell'articolo">
                                </div>
                            </div>
                        </td>
                        <td>{{ $ann_ck->title }}</td>
                        <td class="d-none d-sm-table-cell"> {{ $ann_ck->body }}</td>
                        <td>{{ $ann_ck->price }}</td>
                        <td class="d-none d-sm-table-cell"> {{ __('ui.' . $ann_ck->category->name) }}</td>
                        <td class="d-none d-sm-table-cell">{{ $ann_ck->created_at->format('d/m/y') }}</td>
                        <td>
                            <div class="d-flex col-12 justify-content-center">
                                <button type="button" class="btn btn-outline-primary btn-xs dt-edit"
                                    {{-- style="margin-right:16px;"  --}} data-bs-toggle="modal"
                                    data-bs-target="#myModal{{ $ann_ck->id }}" title="{{ __('ui.visua') }}">
                                    <i class="fa-regular fa-eye fa-sm"></i>
                                </button>
                        </td>
                        <td>
                            <div class="d-flex col-12 justify-content-evenly  ">
                                <form action="{{ route('revisor.accept_announcement', ['announcement' => $ann_ck]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline-success btn-xs dt-edit"
                                        title="{{ __('ui.acc') }} "><i class="fa-regular fa-square-check fa-sm"></i>
                                    </button>
                                </form>
                                <form action="{{ route('revisor.reject_announcement', ['announcement' => $ann_ck]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline-danger btn-xs dt-edit"
                                        title="{{ __('ui.rif') }}"><i class="fa-regular fa-thumbs-down fa-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        </div>
                    </tr>

                    <!-- Modal -->
                    <div id="myModal{{ $ann_ck->id }}" class="modal fade modal-lg col-12 " role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                    <div class="modal-header">
                                        {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                                        <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-12 col-md-9 col-lg-9">
                                                    @if ($ann_ck)
                                                        <div id="{{$ann_ck->id}}" class="carousel slide carousel-fade">
                                                            @if ($ann_ck && $ann_ck->images && $ann_ck->images->count() > 0)
                                                                        {{-- <div class="container d-flex"> --}}
                                                                <div class="carousel-inner">
                                                                        @foreach ($ann_ck->images as $image)
                                                                            {{-- @dd($ann_ck->images) --}}
                                                                            <div class="carousel-item d-flex @if ($loop->first) active @endif">
                                                                                <div class="col-12 col-md-6">                     
                                                                                    <img src="{{ $image->getUrl(256, 256) }} "
                                                                                        class="d-block w-100 h-100"
                                                                                        {{-- {{ $image->getUrl(256, 256) }} {{ Storage::url($image->path) }} --}}
                                                                                        alt="immagine dell'articolo">
                                                                                </div>
                                                                                {{-- tag per google Vision --}}
                                                                                <div class="col-12 col-md-3">
                                                                                    <h5 class="tc-accent mt-3 fs-6 ">
                                                                                        Tags</h5>
                                                                                    <div class="p-2 col-10 font-mini border border-primary">
                                                                                        @if ($image->labels)
                                                                                            @foreach ($image->labels as $label)
                                                                                                <p class="d-inline">
                                                                                                    {{ $label }},
                                                                                                </p>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-md-3">
                                                                                    <div class="col-12 card-body p-1 border border-primary">
                                                                                        <h6 class="tc-accent">
                                                                                            {{ __('ui.rev1') }}</h6>
                                                                                        <p class="font-mini">
                                                                                            {{ __('ui.rev2') }}: <span
                                                                                                class="{{ $image->adult }}"></span>
                                                                                        </p>
                                                                                        <p class="font-mini">
                                                                                            {{ __('ui.rev3') }}: <span
                                                                                                class="{{ $image->spoof }}"></span>
                                                                                        </p>
                                                                                        <p class="font-mini">
                                                                                            {{ __('ui.rev4') }}: <span
                                                                                                class="{{ $image->medical }}"></span>
                                                                                        </p>
                                                                                        <p class="font-mini">
                                                                                            {{ __('ui.rev5') }}: <span
                                                                                                class="{{ $image->violence }}"></span>
                                                                                        </p>
                                                                                        <p class="font-mini">
                                                                                            {{ __('ui.rev6') }}: <span
                                                                                                class="{{ $image->racy }}"></span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                </div>
                                                                {{-- </div> --}}
                                                            @else
                                                                <div class="carousel-inner">
                                                                    <div class="carousel-item active">
                                                                        <img src="https://picsum.photos/1200/400"
                                                                            class="img-fluid p-3 rounded" alt="...">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="https://picsum.photos/id/28/1200/400"
                                                                            class="img-fluid p-3 rounded" alt="...">
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="https://picsum.photos/id/43/1200/400"
                                                                            class="img-fluid p-3 rounded" alt="...">
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <button class="carousel-control-prev" type="button" data-bs-target="#{{$ann_ck->id}}" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon bg-primary" aria-hidden="true"></span>
                                                                <span class="visually-hidden ">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button" data-bs-target="#{{$ann_ck->id}}" data-bs-slide="next">
                                                                <span class="carousel-control-next-icon bg-primary " aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>
                                                        <div class="col-12 card shadow d-flex mt-3 " style='width: 100%;'>
                                                            <div class="card-body">
                                                                <h5 class="card-title">{{ __('ui.titolo') }}:
                                                                    {{ $ann_ck->title }}</h5>
                                                                <p class="card-text">{{ __('ui.descri') }}:
                                                                    {{ $ann_ck->body }}</p>
                                                                <p class="card-footer">{{ __('ui.pub') }}
                                                                    {{ $ann_ck->created_at->format('d/m/y') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-between ">
                                                            <div class="col-12 col-lg-6 text-center ">
                                                                <form
                                                                    action="{{ route('revisor.accept_announcement', ['announcement' => $ann_ck]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit"
                                                                        class="bn632-hover bn22">{{ __('ui.acc') }}</button>
                                                                </form>
                                                            </div>
                                                            <div class="col-12 col-lg-6 text-center">
                                                                <form
                                                                    action="{{ route('revisor.reject_announcement', ['announcement' => $ann_ck]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit" class="bn632-hover bn28">{{ __('ui.rif') }}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center ">
                                        {{-- <div class="row">
                                            <div class="col-12 text-center justify-content-center">
                                                <form method="GET"
                                                    action="{{ route('announcements.reset-last-accepted') }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bn632-hover yellow">{{ __('ui.annu') }}</button>
                                                </form>
                                            </div>
                                        </div> --}}
                                    </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

    @endif
    <div class="row">
        <div class="col-12 text-center justify-content-center">
            <form method="GET" action="{{ route('announcements.reset-last-accepted') }}">
                @csrf
                <button type="submit" class="bn632-hover yellow">{{ __('ui.annu') }}</button>
            </form>
        </div>
    </div>
</x-layout>
