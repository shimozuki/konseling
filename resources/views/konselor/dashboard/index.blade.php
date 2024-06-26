@extends('layouts.main')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $siswa }}</h3>

                        <p>User</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (Notification.permission === 'default') {
            Notification.requestPermission().then(permission => {
                if (permission === 'granted') {
                    new Notification('Notifications enabled!', {
                        body: 'You will now receive notifications.',
                        icon: '{{ asset("public/logo.png") }}'
                    });
                }
            });
        } else if (Notification.permission === 'granted') {
            new Notification('Welcome back!', {
                body: 'You have notifications enabled.',
                icon: '{{ asset("public/logo.png") }}'
            });
        } else {
            alert('Notifications are blocked. Please enable them in your browser settings.');
        }
    });
</script>
@endsection