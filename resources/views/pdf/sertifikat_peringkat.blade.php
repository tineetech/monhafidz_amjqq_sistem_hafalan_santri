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
        @font-face {
            font-family: 'BauhausRegular';
            src: url("{{ public_path('fonts/BauhausRegular.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'BauhausBold';
            src: url("{{ public_path('fonts/BauhausBold.ttf') }}") format('truetype');
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
            background-image: url("{{ public_path('images/sertif-top3.jpeg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            z-index: -1;
        }

        .nama {
            position: absolute;
            top: 340px;
            width: 100%;
            text-align: center;
            font-size: 50px;
            font-family: 'Forte';
            color: #e26b08;
            
        }

        .keterangan {
            position: absolute;
            top: 460px;        /* sesuaikan */
            width: 100%;
            text-align: center;
            font-size: 30px;
            font-family: 'BauhausBold';
            /* font-weight: 800; */
        }

        .tanggal {
            position: absolute;
            bottom: 200px;    /* sesuaikan */
            right: 300px;     /* sesuaikan */
            background: white;
            width: auto;
            font-family: 'BauhausBold';
            padding-block: 20px;
            height: 20px;
            font-size: 20px;
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

<div class="keterangan">Sebagai juara Ke-{{ $pencatatanUjian->rank }} ({{ucfirst($jenis)}})</div>

<div class="tanggal">
    {{ $semester }}, Tasikmalaya, {{ $tanggal }}
</div>

<div class="ustad">
    {{-- {{ $namaUstad }} --}}
</div>

</body>
</html>
