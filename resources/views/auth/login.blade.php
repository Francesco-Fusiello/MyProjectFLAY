<x-layout>

    <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card border-0 shadow rounded-3 my-5">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="card-title text-center mb-5 fw-light fs-5">{{ __('ui.login') }}</h5>
                            <form method="POST" action="/login">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" name="email"
                                        class="form-control  @error('email') is-invalid @enderror" id="floatingInput"
                                        value="{{ @old('email') }}" placeholder="name@example.com">
                                    <label for="floatingInput">E-mail</label>
                                    @error('email')
                                        <span class= "text-danger fst-italic"> {{ $message }} </span>
                                    @enderror

                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password"
                                        class="form-control  @error('password') is-invalid @enderror"
                                        id="floatingPassword" placeholder="Password">
                                    <label for="floatingPassword">{{ __('ui.password') }}</label>
                                    @error('password')
                                        <span class=" text-danger fst-italic"> {{ $message }} </span>
                                    @enderror
                                </div>

                                {{-- <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                      <label class="form-check-label" for="rememberPasswordCheck">
                        Remember password
                      </label>
                    </div> --}}
                                <div class="d-grid">
                                    <button class="btn btn-outline-primary btn-login fw-bold text-uppercase"
                                        type="submit">{{ __('ui.accedi') }}</button>
                                </div>
                                <hr class="my-4">
                                <div class="d-grid ">
                                    <div class="row d-flex justify-content-around">
                                        <div class="col-7 text-center small">
                                            <p>{{ __('ui.nReg') }}
                                                <a href="/register">{{ __('ui.reg') }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <hr class="m-1">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>










</x-layout>
