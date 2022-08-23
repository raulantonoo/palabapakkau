<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{url('assets/style.css')}}">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Cnmh0bzvnBU6QNms"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
</head>

<body>
    <form action="/payment" method="GET">
        <h1>Data Diri</h1>
        <div class="formcontainer">
            <hr />
            <div class="container">
                <label for="uname"><strong>Nama</strong></label>
                <input type="text" placeholder="Masukan nama" name="uname" required>
                <label for="psw"><strong>Email</strong></label>
                <input type="text" placeholder="Masukan Email" name="email" required>
                <label for="psw"><strong>Nomor</strong></label>
                <input type="text" placeholder="Masukan Nomor" name="number" required>
            </div>
            <button type="submit">Lanjut</button>
    </form>
    @if(session('alert-success'))
    <script>
        alert("{{session('alert-success')}}")
    </script>
    @elseif(session('alert-failed'))
    <script>
        alert("{{session('alert-failed')}}")
    </script>
    @endif
</body>

</html>