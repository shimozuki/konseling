@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Jadwal Bimbingan</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('success') }}
        </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Jadwal</h3>
                        <div class="card-tools">
                            <a name="" id="" class="btn btn-sm btn-primary" href="{{ route('konselor/jadwal-bimbingan/tambah') }}" role="button"><i class="fas fa-plus"></i>
                                Tambah</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama konselor</th>
                                    <th>Tanggal Bimbingan</th>
                                    <th>Nama Peserta</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalBimbingan as $jb)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jb->konselor->nama }}</td>
                                    <td>{{ $jb->tgl_bimbingan }}</td>
                                    <td>{{ $jb->dataUser->nama }}</td>
                                    <td>
                                        @if ($jb->status == 0)
                                        <p class="text-info">Belum ditanggapi</p>
                                        @elseif ($jb->status == 1)
                                        <p class="text-success">Disetujui</p>
                                        @elseif ($jb->status == 3)
                                        <p class="text-success">Selesai</p>
                                        @elseif ($jb->status == 4)
                                        <p class="text-success">Sesi Selesai</p>
                                        @else
                                        <p class="text-danger">Ditolak</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($jb->status == 3)
                                        <a href="#" class="btn btn-success btn-sm approve-btn" data-id="{{ $jb->konselor->id }}" data-jadwal-id="{{ $jb->id }}" data-toggle="modal" data-target="#nilaiModal{{ $jb->konselor->id }}">
                                            <i class="fa fa-check"></i> Nilai Konselor
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- Modal -->
<div class="modal fade" id="nilaiModal{{ $jb->konselor->id }}" tabindex="-1" role="dialog" aria-labelledby="nilaiModalLabel{{ $jb->konselor->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nilaiModalLabel{{ $jb->konselor->id }}">Masukkan Nilai Konselor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formInsertNilai">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="konselor_id" value="{{ $jb->konselor->id }}">
                    <input type="hidden" name="jadwal_id" value="{{ $jb->id }}"> <!-- Tambahkan input untuk jadwal_id -->
                    <div class="form-group">
                        <label for="namaKonselor">Nama Konselor</label>
                        <input type="text" class="form-control" id="namaKonselor" name="nama_konselor" value="{{ $jb->konselor->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <input type="number" class="form-control" id="nilai" name="nilai" placeholder="Masukkan nilai konselor 10 - 100">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#formInsertNilai').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: `{{ route("simpan.nilai") }}`, // Replace with your route for saving nilai
                data: formData,
                success: function(response) {
                    // Show SweetAlert success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Nilai konselor berhasil disimpan!',
                    }).then(() => {
                        $('#nilaiModal{{ $jb->konselor->id }}').modal('hide');
                        location.reload(); // Refresh halaman setelah berhasil
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Show SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menyimpan nilai konselor.',
                    });
                }
            });
        });
    });
</script>

<!-- /.content -->
@endsection