@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Jadwal Bimbingan</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="{{ route('konselor/jadwal-bimbingan/simpan') }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Jadwal Bimbingan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_konselor">Konselor</label>
                                        <select class="form-control @error('id_konselor') is-invalid @enderror" name="id_konselor" id="id_konselor">
                                            <option value="">Pilih Konselor</option>
                                            @foreach ($konselor as $konselors)
                                            <option value="{{ $konselors->id }}" {{ old('id_konselor') == $konselors->id ? 'selected' : '' }}>
                                                {{ $konselors->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_konselor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Tanggal Bimbingan</label>
                                        <input type="datetime-local" class="form-control @error('tgl_bimbingan') is-invalid @enderror" name="tgl_bimbingan" id="tgl_bimbingan" placeholder="Tanggal Bimbingan" value="{{ old('tgl_bimbingan') }}">
                                    </div>
                                    @error('tgl_bimbingan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="bimbingan">Opsi Bimbingan</label>
                                        <select class="form-control @error('bimbingan') is-invalid @enderror" name="bimbingan" id="bimbingan">
                                            <option value="">Pilih Opsi Bimbingan</option>
                                            <option value="1">
                                                Online
                                            </option>
                                            <option value="0">
                                                Offline
                                            </option>
                                        </select>
                                    </div>
                                    @error('id_konselor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary float-right"><i class="fas fa-save"></i>
                                Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection