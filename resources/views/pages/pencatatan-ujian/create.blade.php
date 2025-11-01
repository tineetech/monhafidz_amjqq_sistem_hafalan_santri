@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>Pencatatan Ujian <small>Tambah Data</small></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('pencatatan-ujian.index') }}">Pencatatan Ujian</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Data Ujian</h3>
    </div>
    <div class="box-body">
      <form action="{{ route('pencatatan-ujian.store') }}" method="POST">
        @csrf

        <div class="row">
          <div class="form-group col-md-6">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
          </div>

          <div class="form-group col-md-6">
            <label>Santri</label>
            <select name="santri_id" class="form-control" required>
              <option value="">Pilih Santri</option>
              @foreach ($santri as $s)
                <option value="{{ $s->id }}">{{ $s->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>Ustadzah Penilai</label>
            <select name="ustadzah_id" class="form-control">
              <option value="">Tidak Ada</option>
              @foreach ($ustadzah as $u)
                <option value="{{ $u->id }}">{{ $u->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-md-6">
            <label>Jenis Ujian</label>
            <select name="jenis_ujian" class="form-control" required>
              <option value="tasmi">Tasmi'</option>
              <option value="ujian_akhir">Ujian Akhir</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>Nilai Akhir</label>
            <input type="number" name="nilai_akhir" class="form-control" min="0" max="100" step="0.01">
          </div>

          <div class="form-group col-md-6">
            <label>Status Ujian</label>
            <select name="status_ujian" class="form-control">
              <option value="belum_diuji">Belum Diuji</option>
              <option value="lulus">Lulus</option>
              <option value="remidi">Remidi</option>
            </select>
          </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
          <a href="{{ route('pencatatan-ujian.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
