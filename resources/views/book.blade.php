@extends('layouts.app')
@section('title', 'Show Book')

@section('content')

    <!-- ======= About Section ======= -->
    <div class="container" style="margin-top: 150px; margin-bottom: 150px">

        <div class="section-title" data-aos="zoom-out">
            <h2>{{ $book->library->name ?? '' }}</h2>
            <p>{{ $book->name }}</p>
        </div>

        <div class="row">
            <div class="col-4">
                <img src="{{ $book->image }}" width="100%">
                <hr>
                <p><b>Library: </b>{{ $book->library->name }}</p>
                @if ($book->stock >= 1)
                    <a data-target="#rent_book" data-toggle="modal" class="btn btn-success btn-block">Borrow</a>
                    <a data-target="#buy_book" data-toggle="modal" class="btn btn-success btn-block">Buy</a>
                @else
                    <a data-target="#request_book" data-toggle="modal" class="btn btn-danger btn-block">Out of Stock (Request Book)</a>
                @endif
                @if (auth('users')->check())
                    @if ($teacher)
                        <a data-target="#message_teacher" data-toggle="modal" class="btn btn-success btn-block">Message Teacher</a>
                    @else
                        <a class="btn btn-danger btn-block" onclick="alert('This book does not have a teacher')">Message Teacher</a>
                    @endif
                @else
                    <a class="btn btn-danger btn-block" onclick="alert('Please Login First')">Message Teacher</a>
                @endif

            </div>
            <div class="col-8">
                <p><b>Description:</b></p>
                <p>{{ $book->description_en }}</p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rent_book">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title align-items-end">Borrow Book
                        </h3>
                    </div>
                    <!-- form start -->
                    <form role="form"
                          action="{{ route('books.rent_book', $book->id) }}"
                          method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="borrow_from">Borrow From</label>
                                <input type="date" id="borrow_from"
                                       placeholder="Enter Borrow From Date"
                                       class="form-control" name="borrow_from" required>
                            </div>

                            <div class="form-group">
                                <label for="borrow_to">Borrow To</label>
                                <input type="date" id="borrow_to"
                                       placeholder="Enter Borrow To Date"
                                       class="form-control" name="borrow_to" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success col-md-12">Borrow</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="buy_book">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title align-items-end">Buy Book
                        </h3>
                    </div>
                    <!-- form start -->
                    <form role="form"
                          action="{{ route('books.buy_book', $book->id) }}"
                          method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="card_name">Card Holder Name</label>
                                <input type="text" id="card_name"
                                       placeholder="Enter Card Holder Name"
                                       class="form-control" name="card_name" required>
                            </div>

                            <div class="form-group">
                                <label for="card">Card Number</label>
                                <input type="text" id="card"
                                       placeholder="Enter Card Number"
                                       class="form-control" name="card" required>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="exp">Expiration Date</label>
                                    <input type="text" id="exp"
                                           placeholder="Enter Expiration Date"
                                           class="form-control" name="exp" required>
                                </div>

                                <div class="form-group col-6">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv"
                                           placeholder="Enter CVV"
                                           class="form-control" name="card" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="from">Date From</label>
                                <input type="date" id="from"
                                       class="form-control" name="from" required>
                            </div>

                            <div class="form-group">
                                <label for="date_to">Date To</label>
                                <input type="date" id="date_to"
                                       class="form-control" name="date_to" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success col-md-12">Buy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="request_book">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title align-items-end">Request Book
                        </h3>
                    </div>
                    <!-- form start -->
                    <form role="form"
                          action="{{ route('books.request_book', $book->id) }}"
                          method="post">
                        @csrf
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success col-md-12">Request Book</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="message_teacher">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title align-items-end">Message Teacher</h3>
                    </div>
                    <div class="card-body">
                    <!-- form start -->
                        <form role="form"
                              action="{{ route('books.send_message', $teacher->id ?? 0) }}"
                              method="post">
                            @csrf

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" type="text" id="message" name="message" required></textarea>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success col-md-12">Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
