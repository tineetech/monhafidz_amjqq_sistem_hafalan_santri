@extends('layouts.main')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Absensi
      <small>Rekap Kehadiran Santri</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Absensi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Absensi Santri</h3>
            <div class="box-tools">
              <a href="{{ route('absensi.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Absensi
              </a>
            </div>
          </div>

          <div class="box-body table-responsive">
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table id="absensi-table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Santri</th>
                  <th>Tanggal</th>
                  <th>Pencatatan Hafalan</th>
                  <th>Catatan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($absensi as $index => $a)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $a->santri->nama_lengkap ?? '-' }}</td>
                    <td>{{ $a->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $a->pencatatanHafalan->jenis_hafalan . ' - ' . $a->pencatatanHafalan->surah_ayat ?? '-' }}</td>
                    <td>{{ $a->catatan ?? '-' }}</td>
                    <td>
                      @php
                        $labelClass = match($a->status) {
                          'Hadir' => 'label-success',
                          'Izin' => 'label-info',
                          'Sakit' => 'label-warning',
                          'Alpa' => 'label-danger',
                          default => 'label-default',
                        };
                      @endphp
                      <span class="label {{ $labelClass }}">{{ $a->status }}</span>
                    </td>
                    <td>
                      <a href="{{ route('absensi.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      <form action="{{ route('absensi.destroy', $a->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
