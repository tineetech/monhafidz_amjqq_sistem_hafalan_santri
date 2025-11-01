@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Pencatatan Ujian
    <small>Data Ujian</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pencatatan Ujian</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Ujian Santri</h3>
      <div class="box-tools">
        <a href="{{ route('pencatatan-ujian.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
      </div>
    </div>

    <div class="box-body table-responsive">

      @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Santri</th>
            <th>Ustadzah Penilai</th>
            <th>Tanggal</th>
            <th>Jenis Ujian</th>
            <th>Nilai</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($ujian as $index => $u)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $u->santri->nama_lengkap ?? '-' }}</td>
              <td>{{ $u->ustadzah->nama_lengkap ?? '-' }}</td>
              <td>{{ $u->tanggal }}</td>
              <td>{{ ucfirst($u->jenis_ujian) }}</td>
              <td>{{ $u->nilai_akhir ?? '-' }}</td>
              <td>{{ ucfirst($u->status_ujian) }}</td>
              <td>
                <a href="{{ route('pencatatan-ujian.edit', $u->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('pencatatan-ujian.destroy', $u->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
</section>

@endsection
