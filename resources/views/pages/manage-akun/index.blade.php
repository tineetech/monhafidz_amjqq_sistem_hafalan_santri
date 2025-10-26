@extends('layouts.main')

@section('content')
<section class="content-header">
  <h1>
    Manajemen Akun
    <small>Daftar semua akun pengguna</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Manajemen Akun</li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Akun</h3>
      <a href="{{ route('manage-akun.create') }}" class="btn btn-primary btn-sm pull-right">
        <i class="fa fa-plus"></i> Tambah Akun
      </a>
    </div>

    <div class="box-body table-responsive">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th width="120px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ ucfirst($user->role) }}</td>
              <td>
                @if($user->status == 'aktif')
                  <span class="label label-success">Aktif</span>
                @else
                  <span class="label label-default">Nonaktif</span>
                @endif
              </td>
              <td>
                <a href="{{ route('manage-akun.edit', $user->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                <form action="{{ route('manage-akun.destroy', $user->id) }}" method="POST" style="display:inline-block">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus akun ini?')">
                    <i class="fa fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">Belum ada data akun</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</section>
@endsection