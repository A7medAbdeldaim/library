@extends('templates.admin_layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Messages</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Inbox</h3>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                    @foreach($messages as $message_row)
                                        <tr>
                                            <td class="mailbox-name"><a href="{{ url('/teacher/show_message?con_id=' . $message_row->id) }}">{{ $message_row->user->name }}</a></td>
                                            <td class="mailbox-subject"><a href="{{ url('/teacher/show_message?con_id=' . $message_row->id) }}">{{ $message_row->user_last_message->message }}</a></td>
                                            <td class="mailbox-date"><a href="{{ url('/teacher/show_message?con_id=' . $message_row->id) }}">{{ $message_row->created_at }}</a></td>
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
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

@endsection
