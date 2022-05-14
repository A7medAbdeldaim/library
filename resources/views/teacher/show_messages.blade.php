@extends('templates.admin_layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Messages

                            <span class="float-right">
                                    <a class="btn btn-primary" href="{{ route('teacher.messages') }}">Return Back</a>
                                </span>
                        </h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Messages
                            </h3>
                        </div>

                        @foreach($message as $message_data)
                            <div class="card-body p-0">
                                <div class="mailbox-read-info" style="border: none">
                                    <h6>From: {{ $message_data->sender->name }}
                                        <span
                                            class="mailbox-read-time float-right">{{ $message_data->created_at }}</span>
                                    </h6>
                                </div>
                            </div>

                            <div class="mailbox-read-message" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                                <p>{{ $message_data->message }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </section>
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

@endsection
