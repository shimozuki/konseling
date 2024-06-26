@extends('layouts.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">History Konselor</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5><strong>Nama Konselor: {{ $konselor->nama }}</h5></strong>
                        <p><strong>Rata-rata Nilai: {{ number_format($nilai, 0) }}</p></strong>
                        <form action="{{ route('admin/konselor/hapus', $konselor->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ url('/admin/konselor') }}" class="btn btn-sm btn-info" role="button">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin akan menghapus data ini?')"><i class="fas fa-trash-alt"></i>
                                Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jadwal Bimbingan</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Bimbingan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalBimbingan as $jb)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jb->tgl_bimbingan }}</td>
                                    <td>
                                        @if ($jb->status == 0)
                                        <p class="text-info">Belum ditanggapi</p>
                                        @elseif ($jb->status == 1)
                                        <p class="text-success">Disetujui</p>
                                        @elseif ($jb->status == 3)
                                        <p class="text-success">Selesai</p>
                                        @elseif ($jb->status == 4)
                                        <p class="text-success">Sesi Telah Selesai</p>
                                        @else
                                        <p class="text-danger">Ditolak</p>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection