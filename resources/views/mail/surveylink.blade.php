<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Selamat datang di Indihome Customer Experience.</h2>

<div>
    Hello {!! $data['nama'] !!}, <br/>

    Email : {!! $data['email'] !!} <br/>

    Silahkan isi survey <a href="{{config('app.url').'/s/'.$data['encryptedId']}}">disini</a>.
</div>

</body>
</html>