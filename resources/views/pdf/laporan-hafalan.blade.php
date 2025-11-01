<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background: #f2f2f2; }
        .title { text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 10px }
    </style>
</head>
<body>

<div class="title">LAPORAN PERKEMBANGAN HAFALAN</div>

<p><strong>Nama Santri:</strong> {{ $santri->nama_lengkap }}</p>
<p><strong>Jenis Hafalan:</strong> {{ $jenis_hafalan }}</p>
<p><strong>Semester:</strong> {{ $semester->nama_semester }} ({{ $semester->periode_mulai }} - {{ $semester->periode_selesai }})</p>
<p><strong>Pembimbing:</strong> {{ $pembimbing }}</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Bulan</th>
            <th>Surah/Juz</th>
            <th>Jumlah Juz</th>
            <th>Target</th>
            <th>Persentase</th>
            <th>Nilai</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $i => $row)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $row['bulan'] }}</td>
            <td>{{ $row['surah_juz'] }}</td>
            <td>{{ $row['jumlah_juz'] }} Juz</td>
            <td>{{ $jenis_hafalan === 'Ziyadah' ? "5 juz" : '10 juz' }}</td>
            <td>{{ $row['persentase'] }}%</td>
            <td>{{ $row['nilai'] }}</td>
            <td>{{ $i == 0 ? ($row['persentase_all'] < 90 ? 'Belum Tercapai' : 'Tercapai') : '' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
