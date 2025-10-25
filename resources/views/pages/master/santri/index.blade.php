@extends('layouts.main')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Master Data Santri
        <small>Data Santri</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Master Data Santri</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Santri</h3>
              <div class="box-tools">
                <a href="{{ route('santri.create') }}" class="btn btn-primary btn-sm">Tambah Santri</a>
              </div>
            </div>
            <div class="box-body table-responsive">
              
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              <table id="santri-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Nik</th>
                    <th>TGL Lahir</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Status Santri</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($santri as $index => $s)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $s->nama_lengkap }}</td>
                      <td>{{ $s->jenis_kelamin }}</td>
                      <td>{{ $s->nik }}</td>
                      <td>{{ $s->tanggal_lahir }}</td>
                      <td>{{ $s->alamat_lengkap }}</td>
                      <td>{{ $s->no_hp }}</td>
                      <td>{{ $s->status_santri }}</td>
                      <td>
                        <a href="{{ route('santri.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('santri.destroy', $s->id) }}" method="POST" style="display:inline;">
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