@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>Pencatatan Ujian <small>Edit Data</small></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('pencatatan-ujian.index') }}">Pencatatan Ujian</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Data Ujian</h3>
    </div>
    <div class="box-body">
      <form action="{{ route('pencatatan-ujian.update', $ujian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="form-group col-md-6">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control"
                   value="{{ old('tanggal', $ujian->tanggal) }}" required>
          </div>

          <div class="form-group col-md-6">
            <label>Santri</label>
            <select name="santri_id" class="form-control" required>
              @foreach ($santri as $s)
                <option value="{{ $s->id }}" {{ $ujian->santri_id == $s->id ? 'selected' : '' }}>
                  {{ $s->nama_lengkap }}
                </option>
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
                <option value="{{ $u->id }}" {{ $ujian->ustadzah_id == $u->id ? 'selected' : '' }}>
                  {{ $u->nama_lengkap }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-md-6">
            <label>Jenis Ujian</label>
            <select name="jenis_ujian" class="form-control" required>
              <option value="tasmi" {{ $ujian->jenis_ujian == 'tasmi' ? 'selected' : '' }}>Tasmi'</option>
              <option value="ujian_akhir" {{ $ujian->jenis_ujian == 'ujian_akhir' ? 'selected' : '' }}>Ujian Akhir</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>Nilai Akhir</label>
            <input type="number" name="nilai_akhir" class="form-control"
                   value="{{ round($ujian->nilai_akhir, 2) }}"
                   min="0" max="100" step="0.01">
          </div>

          <div class="form-group col-md-6">
            <label>Status Ujian</label>
            <select name="status_ujian" class="form-control">
              <option value="belum_diuji" {{ $ujian->status_ujian == 'belum_diuji' ? 'selected' : '' }}>Belum Diuji</option>
              <option value="lulus" {{ $ujian->status_ujian == 'lulus' ? 'selected' : '' }}>Lulus</option>
              <option value="remidi" {{ $ujian->status_ujian == 'remidi' ? 'selected' : '' }}>Remidi</option>
            </select>
          </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
          <a href="{{ route('pencatatan-ujian.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
