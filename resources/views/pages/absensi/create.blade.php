@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Data Absensi Santri
    <small>Tambah data santri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('absensi.index') }}">Data Absensi Santri</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<section class="content">
  <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title">Tambah Absensi Santri</h3>
           <div class="box-tools">
            <a href="{{ route('santri.index') }}" class="btn btn-primary btn-sm">
              <i class="fa fa-arrow-left"></i> Kembali
            </a>
          </div>
      </div>

      <form action="{{ route('absensi.store') }}" method="POST">
          @csrf
          <div class="box-body">
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Santri <span class="text-danger">*</span></label>
                        <select name="santri_id" id="santri_id" class="form-control" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach($santri as $s)
                                <option value="{{ $s->id }}" {{ old('santri_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Tanggal <span class="text-danger">*</span></label>
                          <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Status <span class="text-danger">*</span></label>
                          <select name="status" class="form-control" value="Hadir" required>
                              <option value="">-- Pilih Status --</option>
                              <option value="Hadir" {{ old('status') == 'Hadir' ? 'selected' : '' }} selected>Hadir</option>
                              <option value="Izin" {{ old('status') == 'Izin' ? 'selected' : '' }}>Izin</option>
                              <option value="Sakit" {{ old('status') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                              <option value="Alpa" {{ old('status') == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                          </select>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Pencatatan Hafalan</label>
                          <select name="pencatatan_hafalan_id" id="pencatatan_hafalan_id" disabled required class="form-control">
                              <option value="">-- Pilih Hafalan --</option>
                          </select>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Catatan</label>
                          <textarea name="catatan" class="form-control" rows="3" placeholder="Masukkan catatan...">{{ old('catatan') }}</textarea>
                      </div>
                  </div>
              </div>
          </div>

          <div class="box-footer text-right">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Tambah Data</button>
              <a href="{{ route('absensi.index') }}" class="btn btn-default">Batal</a>
          </div>
      </form>
  </div>
</section>

@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const hafalanSelect = $('#pencatatan_hafalan_id');

    // Awal: disable dropdown hafalan
    hafalanSelect.prop('disabled', true);

    $('#santri_id').on('change', function() {
        var santriId = $(this).val();
        hafalanSelect.empty(); // kosongkan dulu
        hafalanSelect.append('<option value="">-- Pilih Hafalan --</option>');

        if (santriId) {
            hafalanSelect.prop('disabled', false); // aktifkan dropdown
            $.ajax({
                url: '/get-hafalan/' + santriId,
                type: 'GET',
                success: function(data) {
                    if (data.length > 0) {
                        $.each(data, function(index, hafalan) {
                            hafalanSelect.append('<option value="' + hafalan.id + '">' + hafalan.jenis_hafalan + ' - ' + hafalan.surah_ayat + '</option>');
                        });
                    } else {
                        // hafalanSelect.append('<option value="">(Tidak ada hafalan)</option>');
                    }
                }
            });
        } else {
            // Kalau santri belum dipilih, disable lagi dropdown hafalan
            hafalanSelect.prop('disabled', true);
        }
    });
});
</script>
@endsection
