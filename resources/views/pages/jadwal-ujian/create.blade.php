@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>Tambah Jadwal Ujian</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('jadwal-ujian.index') }}">Jadwal Ujian</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Jadwal Ujian</h3>
      <div class="box-tools">
        <a href="{{ route('jadwal-ujian.index') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="box-body">
      <form action="{{ route('jadwal-ujian.store') }}" method="POST">
        @csrf

        <div class="row">
          <div class="col-md-6 form-group">
            <label>Santri</label>
            <select name="santri_id" class="form-control" required>
              <option value="">-- Pilih Santri --</option>
              @foreach($santri as $s)
                <option value="{{ $s->id }}">{{ $s->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6 form-group">
            <label>Tanggal Ujian</label>
            <input type="date" name="tanggal" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 form-group">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" required>
          </div>

          <div class="col-md-6 form-group">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" required>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 form-group">
            <label>Pembimbing Putra</label>
            <select name="pembimbing_putra_id" class="form-control">
              <option value="">-- Tidak Ada --</option>
              @foreach ($ustadzah as $u)
                <option value="{{ $u->id }}">{{ $u->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6 form-group">
            <label>Pembimbing Putri</label>
            <select name="pembimbing_putri_id" class="form-control">
              <option value="">-- Tidak Ada --</option>
              @foreach ($ustadzah as $u)
                <option value="{{ $u->id }}">{{ $u->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label>Jenis Ujian</label>
          <select name="jenis_ujian" class="form-control" required>
            <option value="tasmi" selected>Tasmi'</option>
            <option value="ujian_akhir">Ujian Akhir</option>
          </select>
        </div>

        <div class="text-right">
          <button class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
          <a href="{{ route('jadwal-ujian.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
