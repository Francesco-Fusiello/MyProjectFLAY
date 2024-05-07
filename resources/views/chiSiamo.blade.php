<x-layout>

    <header class="container-fluid p-3 text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h3 class="display-3">
                    {{ __('ui.chiS1') }}...
                </h3>
            </div>
        </div>
    </header>

    <div class="container justify-content-center fst-italic col-9 ">
        <h5 class="text-center fst-italic">{{ __('ui.chiS2') }}</h5> 
        <h6 class="d-flex justify-content-center fst-italic"> {{ __('ui.chiS3') }} <br>
            {{ __('ui.chiS4') }} <br>
            {{ __('ui.chiS5') }} <br>{{ __('ui.chiS6') }}.</h6> 
    </div>
        

    

    <div class="containerCard mt-5">
        <div class="box col-12 me-md-5">
            <div class="imgBoxCard">
                <img src="\images\io2.jpg"  alt="">
            </div>
            <div class="contentCard">
                <h2>Francesco Fusiello</br>
                <span>Full Stack Web Developer</span></h2>
            </div>
        </div>
        <div class="box col-12  me-md-5">
            <div class="imgBoxCard">
                <img src="\images\lu white 002_sm.jpg" alt="">
            </div>
            <div class="contentCard">
                <h2>Luana Canozzi</br>
                <span>Full Stack Web Developer</span></h2>
            </div>
        </div>
        <div class="box col-12  me-md-5">
            <div class="imgBoxCard">
                <img src="\images\AnthonyCV.jpg" alt="">
            </div>
            <div class="contentCard">
                <h2>Anthony Elia</br>
                <span>Full Stack Web Developer</span></h2>
            </div>            
        </div>
        <div class="box col-12 me-md-5">
            <div class="imgBoxCard">
                <img src="\images\Yvan_curriculum3.png" alt="">
            </div>
            <div class="contentCard">
                <h2>Yvan Saccotelli</br>
                <span>Full Stack Web Developer</span></h2>
            </div>            
        </div>
    </div>
</x-layout>