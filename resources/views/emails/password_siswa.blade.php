<!DOCTYPE html>
<html>
<head>
    <title>Akun Belajar</title>
</head>
<body>
    <h2>Halo, {{ $siswa->name }}</h2>
    <p>Akun belajar Anda telah dibuat. Berikut adalah detailnya:</p>

    <ul>
        <li>Email: <strong>{{ $siswa->email }}</strong></li>
        <li>Password: <strong>{{ $password }}</strong></li>
    </ul>

    <p>Silakan login ke sistem dan segera ubah password Anda untuk keamanan.</p>

    <p>Terima kasih.</p>
</body>
</html>
