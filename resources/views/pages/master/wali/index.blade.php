@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Master Data Wali Santri
    <small>Data Wali Santri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Master Data Wali Santri</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Wali Santri</h3>
          <div class="box-tools">
            <a href="{{ route('wali.create') }}" class="btn btn-primary btn-sm">
              <i class="fa fa-plus"></i> Tambah Wali
            </a>
          </div>
        </div>

        <div class="box-body table-responsive">
              
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif
          <table id="wali-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>NIK</th>
                <th>Tgl Lahir</th>
                <th>Wali Sebagai</th>
                <th>Wali Santri</th>
                <th>No HP</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($wali as $index => $w)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $w->nama_lengkap }}</td>
                  <td>{{ $w->jenis_kelamin }}</td>
                  <td>{{ $w->nik }}</td>
                  <td>{{ $w->tanggal_lahir }}</td>
                  <td>{{ ucfirst($w->wali_sebagai) }}</td>
                  <td>{{ $w->santri?->nama_lengkap ?? '-' }}</td>
                  <td>{{ $w->no_hp }}</td>
                  <td>{{ ucfirst($w->status_wali) }}</td>
                  <td>
                    <a href="{{ route('wali.edit', $w->id) }}" class="btn btn-warning btn-sm">
                      <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('wali.destroy', $w->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="fa fa-trash"></i>
                      </button>
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
