@extends('templates.admin_layout')
@section('title', 'Edit Teacher')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Teacher</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Edit a New Teacher</h3>
                            </div>
                            @include('templates.errors')
                            <form role="form" action="{{ route('admin.teachers.update', $user->id) }}" method="post">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="card-body col-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" class="form-control"
                                               placeholder="Enter Teacher Name" name="name"
                                               value="{{$user->name}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" class="form-control"
                                               placeholder="Enter Teacher Email" name="email"
                                               value="{{$user->email}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Teacher Password</label>
                                        <input type="password" class="form-control" id="password"
                                               placeholder="Teacher Password" name="password"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="confirm_password">Re-enter Teacher Password</label>
                                        <input type="password" class="form-control" id="confirm_password"
                                               placeholder="Re-enter Teacher Password"
                                               name="password_confirmation" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="book_id">Book</label>
                                        <select name="book_id" id="book_id" class="form-control">
                                            <option value="">Select Book</option>
                                            @foreach($books as $book)
                                                @if($book->id == $user->book_id)
                                                    <option value="{{$book->id}}" selected>{{$book->name}}</option>
                                                    @continue
                                                @endif
                                                <option value="{{$book->id}}">{{$book->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success btn-block">Edit Teacher</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

