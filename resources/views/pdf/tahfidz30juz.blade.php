<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
            margin: 0;
        }
        

        @font-face {
            font-family: 'Forte';
            src: url("{{ public_path('fonts/forte.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'AgencyFB';
            src: url("{{ public_path('fonts/AgencyFB.ttf') }}") format('truetype');
        }

        body {
            margin: 0;
            width: 100%;
            padding: 0;
            font-family: 'Times New Roman';
        }

        .bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ public_path('images/sertif-tahfidz30juz.jpeg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            z-index: -1;
        }

        .nama {
            position: absolute;
            top: 320px;
            width: 100%;
            text-align: center;
            font-size: 50px;
            font-family: 'Forte';
            color: #e26b08;
            
        }

        .keterangan {
            position: absolute;
            top: 410px;        /* sesuaikan */
            width: 100%;
            text-align: center;
            font-size: 20px;
            padding: 0 120px;
        }

        .tanggal {
            position: absolute;
            bottom: 170px;    /* sesuaikan */
            right: 300px;     /* sesuaikan */
            font-weight: bold;
            background: white;
            width: 300px;
            padding-block: 20px;
            height: 20px;
            font-size: 18px;
        }

        .ustad {
            position: absolute;
            bottom: 60px;
            left: 180px;
            background: white;
            width: 300px;
            font-size: 24px;
            font-family: 'AgencyFB';
        }
    </style>
</head>

<body>

<div class="bg"></div>

<div class="nama">{{ $namaSantri }}</div>


<div class="tanggal">
    Tasikmalaya, {{ $tanggal }}
</div>

<div class="ustad">
    {{ $namaUstad }}
</div>

</body>
</html>
