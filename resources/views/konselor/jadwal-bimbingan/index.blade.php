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
                                    <th>Opsi</th>
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
                                        @if ($jb->status == 0)
                                        <a href="#" class="btn btn-success btn-sm approve-btn" data-id="{{ $jb->id }}">
                                            <i class="fa fa-check"></i> Approve
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm reject-btn" data-id="{{ $jb->id }}">
                                            <i class="fa fa-times"></i> Tolak
                                        </a>
                                        @elseif ($jb->status == 1)
                                        <a class="btn btn-secondary btn-sm" disabled>
                                            <i class="fa fa-check"></i> Approve
                                        </a>
                                        <a class="btn btn-secondary btn-sm" disabled>
                                            <i class="fa fa-times"></i> Tolak
                                        </a>
                                        <a href="#" class="btn btn-success btn-sm finish-btn" data-id="{{ $jb->id }}">
                                            <i class="fa fa-check"></i> selesai
                                        </a>
                                        @else
                                        <a class="btn btn-secondary btn-sm" disabled>
                                            <i class="fa fa-check"></i> Approve
                                        </a>
                                        <a class="btn btn-secondary btn-sm" disabled>
                                            <i class="fa fa-times"></i> Tolak
                                        </a>
                                        <a class="btn btn-secondary btn-sm" disabled>
                                            <i class="fa fa-check"></i> selesai
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
<!-- /.content -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Event listener untuk tombol Approve
        $(document).on('click', '.approve-btn', function(event) {
            event.preventDefault(); // Mencegah tindakan default dari tautan

            var id = $(this).data('id'); // Mendapatkan ID dari atribut data-id

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan menyetujui jadwal bimbingan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setuj!'
            }).then((result) => {
                if (result.isConfirmed) {
                    approveJadwal(id); // Panggil fungsi approveJadwal jika dikonfirmasi
                }
            });
        });

        // Event listener untuk tombol selesai
        $(document).on('click', '.finish-btn', function(event) {
            event.preventDefault(); // Mencegah tindakan default dari tautan

            var id = $(this).data('id'); // Mendapatkan ID dari atribut data-id

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Menyelsaikan Sesi Bimbingan ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tolak!'
            }).then((result) => {
                if (result.isConfirmed) {
                    finishJadwal(id); // Panggil fungsi rejectJadwal jika dikonfirmasi
                }
            });
        });

        // Event listener untuk tombol Tolak
        $(document).on('click', '.reject-btn', function(event) {
            event.preventDefault(); // Mencegah tindakan default dari tautan

            var id = $(this).data('id'); // Mendapatkan ID dari atribut data-id

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan menolak jadwal bimbingan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tolak!'
            }).then((result) => {
                if (result.isConfirmed) {
                    rejectJadwal(id); // Panggil fungsi rejectJadwal jika dikonfirmasi
                }
            });
        });

        // Fungsi AJAX untuk menyetujui jadwal bimbingan
        function approveJadwal(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('jadwal-bimbingan.approve', ':id') }}".replace(':id', id), // Sesuaikan dengan route yang Anda tentukan di Laravel
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Berhasil!',
                        'Jadwal bimbingan telah disetujui.',
                        'success'
                    ).then(() => {
                        location.reload(); // Refresh halaman setelah berhasil

                        // Mengirim notifikasi desktop (jika diizinkan)
                        if (Notification.permission === 'granted') {
                            const notification = new Notification('Jadwal Bimbingan Disetujui', {
                                body: 'Jadwal bimbingan telah disetujui.',
                                icon: '{{ asset("logo.png") }}' // Gunakan asset() untuk menghasilkan URL yang benar
                            });
                            notification.onclick = function(event) {
                                event.preventDefault();
                                window.open(`{{ route('siswa/jadwal-bimbingan') }}`); // Ganti dengan tautan yang diinginkan
                            };
                        } else if (Notification.permission !== 'denied') {
                            Notification.requestPermission().then(function(permission) {
                                if (permission === 'granted') {
                                    const notification = new Notification('Jadwal Bimbingan Disetujui', {
                                        body: 'Jadwal bimbingan telah disetujui.',
                                        icon: '{{ asset("logo.png") }}' // Gunakan asset() untuk menghasilkan URL yang benar
                                    });
                                    notification.onclick = function(event) {
                                        event.preventDefault();
                                        window.open(`{{ route('siswa/jadwal-bimbingan') }}`); // Ganti dengan tautan yang diinginkan
                                    };
                                }
                            });
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menyetujui jadwal bimbingan.',
                        'error'
                    );
                    console.error(xhr.responseText); // Tampilkan pesan error di console untuk debugging
                }
            });
        }


        // Fungsi AJAX untuk menyetujui jadwal bimbingan
        function finishJadwal(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('jadwal-bimbingan.finish', ':id') }}".replace(':id', id), // Sesuaikan dengan route yang Anda tentukan di Laravel
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Berhasil!',
                        'Jadwal bimbingan telah Selsai.',
                        'success'
                    ).then(() => {
                        location.reload(); // Refresh halaman setelah berhasil

                        // Mengirim notifikasi desktop (jika diizinkan)
                        if (Notification.permission === 'granted') {
                            const notification = new Notification('Jadwal Bimbingan Telah Selsai', {
                                body: 'Jadwal bimbingan telah Selesai.',
                                icon: '{{ asset("logo.png") }}' // Gunakan asset() untuk menghasilkan URL yang benar
                            });
                            notification.onclick = function(event) {
                                event.preventDefault();
                                window.open(`{{ route('siswa/jadwal-bimbingan') }}`); // Ganti dengan tautan yang diinginkan
                            };
                        } else if (Notification.permission !== 'denied') {
                            Notification.requestPermission().then(function(permission) {
                                if (permission === 'granted') {
                                    const notification = new Notification('Jadwal Bimbingan selesai', {
                                        body: 'Jadwal bimbingan telah selesai.',
                                        icon: '{{ asset("logo.png") }}' // Gunakan asset() untuk menghasilkan URL yang benar
                                    });
                                    notification.onclick = function(event) {
                                        event.preventDefault();
                                        window.open(`{{ route('siswa/jadwal-bimbingan') }}`); // Ganti dengan tautan yang diinginkan
                                    };
                                }
                            });
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menyetujui jadwal bimbingan.',
                        'error'
                    );
                    console.error(xhr.responseText); // Tampilkan pesan error di console untuk debugging
                }
            });
        }


        // Fungsi AJAX untuk menolak jadwal bimbingan
        function rejectJadwal(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('jadwal-bimbingan.reject', ':id') }}".replace(':id', id), // Sesuaikan dengan route yang Anda tentukan di Laravel
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Berhasil!',
                        'Jadwal bimbingan telah ditolak.',
                        'success'
                    ).then(() => {
                        location.reload(); // Refresh halaman setelah berhasil
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menolak jadwal bimbingan.',
                        'error'
                    );
                    console.error(xhr.responseText); // Tampilkan pesan error di console untuk debugging
                }
            });
        }
    });
</script>
@endsection