<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FLAY</title>

    <style>
             .bn5 {
        padding: 0.6em 2em;
        border-style: outset;
        outline: none;
        color: rgb(255, 255, 255);
        background: #13044d;
        border: white;
        cursor: pointer;
        position: relative;
        z-index: 0;
        border-radius: 10px;
      }
      
      .bn5:before {
        content: "";
        background: linear-gradient(
          45deg,
          #ff0000,
          #ff7300,
          #fffb00,
          #48ff00,
          #00ffd5,
          #002bff,
          #7a00ff,
          #ff00c8,
          #ff0000
        );
        position: absolute;
        top: -2px;
        left: -2px;
        background-size: 400%;
        z-index: -1;
        filter: blur(5px);
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        animation: glowingbn5 20s linear infinite;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        border-radius: 10px;
      }
      
      @keyframes glowingbn5 {
        0% {
          background-position: 0 0;
        }
        50% {
          background-position: 400% 0;
        }
        100% {
          background-position: 0 0;
        }
      }
      
      .bn5:active {
        color: #000;
      }
      
      .bn5:active:after {
        background: transparent;
      }
      
      .bn5:hover:before {
        opacity: 1;
      }
      
      .bn5:after {
        z-index: -1;
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: #191919;
        left: 0;
        top: 0;
        border-radius: 10px;
      }
    </style>



</head>
<body style="text-align: center">
    <div>
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('logo.png') }}" style="width:300px; "
            alt="Logo del sito"></a>
    </div>
    <div style="font-family: 'Raleway', sans-serif;
    font-optical-sizing: auto;
    font-weight: 500;
    font-style: normal;">
        <h1>{{__('ui.titMail')}}</h1>
        <h2>{{__('ui.mail2')}}:</h2>
        <span>{{__('ui.name')}}: </span><span style="color: #127DC5">{{$user->name}}</span><br>
        <span>E-mail: </span><span style="color: #127DC5">{{$user->email}}</span>
        <p style="margin-bottom: 50px">{{__('ui.mail3')}}</p>
        <a class="bn5"href="{{route('make.revisor',compact('user'))}}">{{__('ui.mail4')}}</a>
    </div>
</body>
</html>