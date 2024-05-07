    
    <div class="container mt-2 justify-content-center mb-3">
        <div class="row ">

            <form action="{{ route('announcement.search') }}" method="GET" class="d-flex">
                <input type="search" name="searched" class="form-control me-2" style="width: 100%"
                    placeholder='{{__('ui.searchart')}}' aria-label='Search'>
                <button class="btn btn-outline-primary w-25" type='submit'>{{__('ui.search')}}</button>
            </form>
        </div>
    </div>