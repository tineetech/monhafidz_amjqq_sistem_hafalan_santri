@extends('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Manajemen Akun
    <small>Edit Akun</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('manage-akun.index') }}">Manajemen Akun</a></li>
    <li class="active">Edit</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Akun</h3>
    </div>

    <form action="{{ route('manage-akun.update', $user->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="box-body table-responsive">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama Lengkap <span class="text-danger">*</span></label>
              <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Username <span class="text-danger">*</span></label>
              <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Email <span class="text-danger">*</span></label>
              <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Role <span class="text-danger">*</span></label>
              <select name="role" class="form-control" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="santri" {{ $user->role == 'santri' ? 'selected' : '' }}>Santri</option>
                <option value="ustad" {{ $user->role == 'ustad' ? 'selected' : '' }}>Ustad</option>
                <option value="walisantri" {{ $user->role == 'walisantri' ? 'selected' : '' }}>Wali santri</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Status <span class="text-danger">*</span></label>
              <select name="status" class="form-control" required>
                <option value="aktif" {{ $user->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $user->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Password Baru (opsional)</label>
              <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Konfirmasi Password Baru</label>
              <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
            </div>
          </div>
        </div>
      </div>

      <div class="box-footer text-right">
        <a href="{{ route('manage-akun.index') }}" class="btn btn-default">Batal</a>
        <button type="submit" class="btn btn-primary">Perbarui</button>
      </div>
    </form>
  </div>
</section>
@endsection