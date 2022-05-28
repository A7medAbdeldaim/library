@extends('layouts.auth_layout')
@section('title', 'Login')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <!-- <div class="col-md-6 order-md-2">
                  <img src="images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
                </div> -->
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="form-block">
                                <div class="mb-4">
                                    <h3>Sign In to <strong>Library</strong></h3>
                                </div>
                                @include('layouts.errors')

                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group first">
                                        <label for="username">Email</label>
                                        <input type="email" class="form-control" id="username" name="email" value="{{ old('email') }}">

                                    </div>
                                    <div class="form-group last mb-4">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">

                                    </div>

                                    <input type="submit" value="Sign In"
                                           class="btn btn-pill text-white btn-block btn-primary">

                                    <hr>
                                    <div class="d-flex mb-5 align-items-center">
                                        <span class="ml-auto"><a href="{{ route('librarian.showLoginForm') }}" class="forgot-pass">Not a Student? Sign in as a Librarian</a></span>
                                        <span class="ml-auto"><a href="{{ route('teacher.showLoginForm') }}" class="forgot-pass">Not a Student? Sign in as a Teacher</a></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
