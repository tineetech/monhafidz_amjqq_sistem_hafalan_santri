@extends('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Laporan Hafalan
    <small>Daftar semua catatan hafalan santri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Rekap Hafalan</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Rekap Hafalan Ziyadah</h3>
      <a href="{{ route('pencatatan-hafalan.create') }}" class="btn btn-primary btn-sm pull-right">
        <i class="fa fa-plus"></i> Tambah Data
      </a>
    </div>

    <div class="box-body table-responsive">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Santri</th>
            <th>Bulan</th>
            <th>Semester</th>
            <th>Hafalan Saat ini</th>
            <th>Target</th>
            <th>Persentase</th>
            <th>Nilai</th>
            <th>Status</th>
            <th width="120px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($data as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->nama_lengkap ?? '-' }}</td>
              <td>{{ $item->bulan ?? '-' }}</td>
              <td>{{ $item->semester->nama_semester ?? '-' }}</td>
              <td>{{ $item->total_juz_tercapai ?? '-' }}</td>
              <td>{{ '5 Juz' }}</td>
              {{-- <td>{{ $item->pencatatanHafalan->nilai_kelancaran ?? '-' }}</td> --}}
              <td>90%</td>
              <td>90%</td>
              <td>{{ ucfirst($item->status) }}</td>
              <td>
                <a href="{{ route('pencatatan-hafalan.edit', $item->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                <form action="{{ route('pencatatan-hafalan.destroy', $item->id) }}" method="POST" style="display:inline-block">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-xs" onclick="return confirm('Yakin hapus data ini?')"><i class="fa fa-trash"></i></button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="10" class="text-center">Belum ada data</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection
