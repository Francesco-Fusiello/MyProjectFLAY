<x-layout>
            <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

<body>
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
            <div class="card-img-left d-none d-md-flex">
              <!-- Background image for card set in CSS! -->
            </div>
            <div class="card-body p-4 p-sm-5">
              <h5 class="card-title text-center mb-5 fw-light fs-5">{{__('ui.register')}}</h5>
              <form method="POST" action="/register">
                @csrf
  
                <div class="form-floating mb-3">
                  <input type="text" class="form-control @error('name') is-invalid @enderror"  name="name" id="floatingInputUsername"  value="{{ @old('name') }}" placeholder="myusername" required autofocus>
                  <label for="floatingInputUsername">{{__('ui.name')}}</label>
                  @error('name')
                      <span class="text-danger fst-italic"> {{ $message }} </span>
                  @enderror
                </div>


  
                <div class="form-floating mb-3">
                  <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="floatingInputEmail" value="{{ @old('email') }}" placeholder="name@example.com">
                  <label for="floatingInputEmail">E-mail</label>
                @error('email')
                    <span class="text-danger fst-italic"> {{ $message }} </span>
                @enderror
                </div>
  
                <hr>
  
                <div class="form-floating mb-3">
                  <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password">
                  <label for="floatingPassword">{{__('ui.password')}}</label>
                    @error('password')
                        <span class="text-danger fst-italic"> {{ $message }} </span>
                    @enderror
                </div>
  
                <div class="form-floating mb-3">
                  <input type="password"  name="password_confirmation" class="form-control" id="floatingPasswordConfirm" placeholder="Confirm Password">
                  <label for="floatingPasswordConfirm">{{__('ui.cPassword')}}</label>
                </div>
  
                <div class="d-grid mb-2">
                  <button class="btn btn-outline-primary btn-login fw-bold text-uppercase" type="submit">{{__('ui.reg')}}</button>
                </div>
                
                <p class="d-block text-center small">{{__('ui.account')}}<a class="d-block text-center small" href="/login">{{__('ui.accedi')}}</a></p>
  
                <hr class="my-4">
  
                
  
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>


</x-layout>