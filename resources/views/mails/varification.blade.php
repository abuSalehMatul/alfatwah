<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include('mails.header')
    <h1>Hello</h1>, 
    <p>We AlFatwah received an attempt for registration with your email address.</p>
     <h6>We would like to varify if it's really you</h6>
     <a href="{{route('user.verification', $token)}}" style="padding: 10px 50px; background:greenyellow;color:white;
     font-size:20px;font-weight:700">Verify</a>
     <br>
     <br>
     <p>This is a automatic email, please ignore this if that wasn't you and let us know <a href="{{url('/')}}"></a></p>
     @include('mails.officialSignature')
</body>
</html>