<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alfatawa-alhanafia</title>
</head>
<body>
    <p style="font-weight: 800">Dear,</p>
    <p style="text-align:center">You are receiving this email because we received a password reset request for your account.</p><br>
    <div style="width: 100%">
    <a role="button" 
    style="margin:auto;color:white;background:black;padding:5px;text-decoration:none;position:relative;left:45%;border-radius:5px" 
    target="blank" href="{{url('/password-reset-form/'.$string)}}">Reset Password</a>
    </div>
    <p style="text-align:center">This is a automatic email, please ignore this if that wasn't you and let us know <a href="{{url('/')}}"></a></p>
    @include('mails.officialSignature')
</body>
</html>