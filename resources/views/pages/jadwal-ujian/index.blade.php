@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Jadwal Ujian
    <small>Data Jadwal Ujian</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Jadwal Ujian</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Jadwal Ujian</h3>
          <div class="box-tools">
            <a href="{{ route('jadwal-ujian.create') }}" class="btn btn-primary btn-sm">Tambah Jadwal</a>
          </div>
        </div>

        <div class="box-body table-responsive">

          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Santri</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Pembimbing Putra</th>
                <th>Pembimbing Putri</th>
                <th>Jenis Ujian</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($jadwal as $i => $j)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $j->santri->nama_lengkap }}</td>
                <td>{{ $j->tanggal }}</td>
                <td>{{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }}</td>
                <td>{{ $j->pembimbingPutra->nama_lengkap ?? '-' }}</td>
                <td>{{ $j->pembimbingPutri->nama_lengkap ?? '-' }}</td>
                <td>{{ ucfirst($j->jenis_ujian) }}</td>
                <td>
                    <a href="{{ route('jadwal-ujian.edit', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('jadwal-ujian.destroy', $j->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
              </tr>
              @endforeach
            </tbody>

          </table>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection
