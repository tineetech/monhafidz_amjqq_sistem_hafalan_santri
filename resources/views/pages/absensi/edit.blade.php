@extends('layouts.main')
@section('content')

<section class="content-header">
  <h1>
    Data Absensi Santri
    <small>Edit data santri</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('absensi.index') }}">Data Absensi Santri</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
  <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title">Edit Absensi Santri</h3>
          <div class="box-tools">
              <a href="{{ route('absensi.index') }}" class="btn btn-primary btn-sm">
                  <i class="fa fa-arrow-left"></i> Kembali
              </a>
          </div>
      </div>

      <form action="{{ route('absensi.update', $absensi->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="box-body">
              <div class="row">

                  <!-- Nama Santri -->
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Nama Santri <span class="text-danger">*</span></label>
                          <select name="santri_id" id="santri_id" class="form-control" required>
                              <option value="">-- Pilih Santri --</option>
                              @foreach($santri as $s)
                                  <option value="{{ $s->id }}" 
                                      {{ old('santri_id', $absensi->santri_id) == $s->id ? 'selected' : '' }}>
                                      {{ $s->nama_lengkap }}
                                  </option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <!-- Tanggal -->
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Tanggal <span class="text-danger">*</span></label>
                          <input type="date" name="tanggal" class="form-control"
                                 value="{{ old('tanggal', $absensi->tanggal->format('Y-m-d')) }}" required>
                      </div>
                  </div>

                  <!-- Status -->
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Status <span class="text-danger">*</span></label>
                          <select name="status" class="form-control" required>
                              <option value="">-- Pilih Status --</option>
                              <option value="Hadir" {{ old('status', $absensi->status) == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                              <option value="Izin" {{ old('status', $absensi->status) == 'Izin' ? 'selected' : '' }}>Izin</option>
                              <option value="Sakit" {{ old('status', $absensi->status) == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                              <option value="Alpa" {{ old('status', $absensi->status) == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                          </select>
                      </div>
                  </div>

                  <!-- Pencatatan Hafalan -->
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Pencatatan Hafalan</label>
                          <select name="pencatatan_hafalan_id" id="pencatatan_hafalan_id" class="form-control" required>
                              <option value="">-- Pilih Hafalan --</option>
                              {{-- Hafalan akan dimuat otomatis lewat AJAX --}}
                          </select>
                      </div>
                  </div>

                  <!-- Catatan -->
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Catatan</label>
                          <textarea name="catatan" class="form-control" rows="3" placeholder="Masukkan catatan...">{{ old('catatan', $absensi->catatan) }}</textarea>
                      </div>
                  </div>

              </div>
          </div>

          <div class="box-footer text-right">
              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
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
    const santriSelect = $('#santri_id');
    const selectedHafalanId = "{{ old('pencatatan_hafalan_id', $absensi->pencatatan_hafalan_id) }}";

    function loadHafalan(santriId, selectedId = null) {
        hafalanSelect.empty().append('<option value="">-- Pilih Hafalan --</option>');

        if (santriId) {
            $.ajax({
                url: '/get-hafalan/' + santriId,
                type: 'GET',
                success: function(data) {
                    if (data.length > 0) {
                        $.each(data, function(index, hafalan) {
                            const selected = selectedId == hafalan.id ? 'selected' : '';
                            hafalanSelect.append('<option value="' + hafalan.id + '" ' + selected + '>' +
                                hafalan.jenis_hafalan + ' - ' + hafalan.surah_ayat + '</option>');
                        });
                    } else {
                        // hafalanSelect.append('<option value="">(Tidak ada hafalan)</option>');
                    }
                }
            });
        }
    }

    // Saat halaman pertama kali load, tampilkan hafalan sesuai santri yang sudah ada
    const initialSantri = santriSelect.val();
    if (initialSantri) {
        loadHafalan(initialSantri, selectedHafalanId);
    }

    // Jika santri diganti, muat ulang hafalan
    santriSelect.on('change', function() {
        loadHafalan($(this).val());
    });
});
</script>
@endsection
