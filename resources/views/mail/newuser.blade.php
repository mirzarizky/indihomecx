<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Selamat datang di Indihome Customer Experience!</h2>

<div>
    Hello {!! $data['nama'] !!}, <br>

    Email : {!! $data['email'] !!} <br>
    NIK : {!! $data['nik'] !!} <br>
    Password : {!! $data['password'] !!} <br>

    Silahkan login <a href="{{route('login')}}">disini</a>. Kemudian ubah password anda.
</div>

</body>
</html>