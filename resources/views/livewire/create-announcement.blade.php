<div>

    @if (session()->has('message'))
        <div class="alert alert-success mt-2" role="alert">
            {{ session('message') }}
        </div>
    @endif

    {{-- <section id="header" class="jumbotron text-center position-relative">
        <img src="\images\BannerMegafonoBlu.png" class="d-block w-100 h-25" alt="...">
        <h1 class="display-3 position-absolute top-50 start-50 translate-middle text-white">{{ __('ui.creaA') }}</h1>
    </section> --}}

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-7">
                {{-- <h2 class="text-center">{{ __('ui.creaA') }}</h2> --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }} {{ __('ui.success') }}
                    </div>
                @endif
                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">{{ __('ui.titolo') }}</label>
                        <input wire:model.change='title' type="text" class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('ui.descri') }}</label>
                        <input wire:model.change='body' type="text" class="form-control">
                        @error('body')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 mt-4 d-flex flex-nowrap">
                        <label class=" me-3 form-label color-primary">{{ __('ui.category') }}</label>
                        <select wire:model.change='category_id'
                            class="form-select w-50 @error('category_id') is-invalid @enderror">
                            <option value="">{{ __('ui.selCat')}}</option>
                            @foreach (App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ __('ui.' . $category->name) }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger fw-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4 d-flex flex-nowrap">
                        <label class="form-label me-3 ">{{ __('ui.value1') }}</label>
                        <input wire:model.change='price' type="number" class="form-control w-25 " min="1">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-4">
                        <input wire:model="temporary_images" type="file" name="images" multiple
                            class="form-control shadow @error('temporary_images.*') is-invalid @enderror"
                            placeholder="Img" />
                            @error('temporary_images.*')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class=" btn btn-primary w-100 shadow mt-5 ">{{ __('ui.crea') }}</button>
                    
                </form>
                
            </div>
            
            <div class="col-md-5">
                <img src="\images\ImmagineAnnuncio.png" class="img-fluid d-none d-sm-block" alt="Immagine Grande">
            </div>
        </div>
    </div>
    @if (!empty($images))
        <div class="row">
            <div class="div col-12">
                <div class=" d-flex flex-nowrap m-3">

                    <p>{{ __('ui.phoPrew') }}:</p>
                </div>
                <div class="row border border-4 border-info rounded shadow py-4">
                    @foreach ($images as $key => $image)
                    <div class="col my-3">
                        <div class="img-preview mx-auto shadow rounded"
                        style=" background-size: cover; background-position: center; background-image: url({{ $image->temporaryUrl() }});">
                    </div>
                    <button type="button"
                    class="btn btn-danger shadow d-block text-center mt-2 mx-auto"
                    wire:click="removeImage({{ $key }})">{{ __('ui.canc') }}</button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>