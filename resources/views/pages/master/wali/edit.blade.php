@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Data Wali Santri
    <small>Edit Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('wali.index') }}">Data Wali Santri</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Data Wali Santri</h3>
      <div class="box-tools">
        <a href="{{ route('wali.index') }}" class="btn btn-primary btn-sm">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="box-body">
      <form action="{{ route('wali.update', $wali->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="form-group col-md-6">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" value="{{ $wali->nama_lengkap }}" required>
          </div>
          <div class="form-group col-md-6">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
              <option value="Laki-laki" {{ $wali->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ $wali->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ $wali->nik }}" required>
          </div>
          <div class="form-group col-md-6">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $wali->tanggal_lahir }}" required>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>Wali Sebagai</label>
            <select name="wali_sebagai" class="form-control" required>
              <option value="ayah" {{ $wali->wali_sebagai == 'ayah' ? 'selected' : '' }}>Ayah</option>
              <option value="ibu" {{ $wali->wali_sebagai == 'ibu' ? 'selected' : '' }}>Ibu</option>
              <option value="wali" {{ $wali->wali_sebagai == 'wali' ? 'selected' : '' }}>Wali</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label>Santri</label>
            <select name="santri_id" class="form-control" required>
              @foreach($santri as $s)
                <option value="{{ $s->id }}" {{ $wali->santri_id == $s->id ? 'selected' : '' }}>{{ $s->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label>Alamat Lengkap</label>
            <textarea name="alamat_lengkap" class="form-control" rows="2" required>{{ $wali->alamat_lengkap }}</textarea>
          </div>
          <div class="form-group col-md-6">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $wali->no_hp }}" required>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-12">
            <label>Status Wali</label>
            <select name="status_wali" class="form-control" required>
              <option value="aktif" {{ $wali->status_wali == 'Aktif' ? 'selected' : '' }}>Aktif</option>
              <option value="tidak aktif" {{ $wali->status_wali == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
          </div>
        </div>

        <div class="form-group text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Data</button>
          <a href="{{ route('wali.index') }}" class="btn btn-default">Batal</a>
        </div>

      </form>
    </div>
  </div>
</section>

@endsection
