@extends('templates.admin_layout')
@section('title', 'Edit  Magazine')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit  Magazine</h1>
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
                                <h3 class="card-title">Edit a New Magazine</h3>
                            </div>
                            @include('templates.errors')
                            <form role="form" action="{{ route('admin.magazines.update', $book->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="card-body col-6">
                                    <div class="form-group">
                                        <label for="name_en">Name</label>
                                        <input type="text" id="name_en" class="form-control"
                                               placeholder="Enter Magazine Name" name="name_en"
                                               value="{{ $book->name_en }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description_en">Description</label>
                                        <textarea id="description_en" class="form-control"
                                                  placeholder="Enter Magazine Email" name="description_en" required>
                                            {{ $book->description_en }}
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" id="price" class="form-control"
                                               placeholder="Enter Magazine Price" name="price"
                                               value="{{ $book->price }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" id="stock" class="form-control"
                                               placeholder="Enter Magazine Stock" name="stock"
                                               value="{{ $book->stock }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" id="image" class="form-control"
                                               name="image"
                                               value="{{ $book->image }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="library_id">Library</label>
                                        <select class="form-control" id="library_id"
                                                name="library_id"
                                                required>
                                            @foreach($libraries as $library)
                                                @if ($library->id == $book->library_id)
                                                    <option value="{{ $library->id }}" selected>{{ $library->name }}</option>
                                                    @continue
                                                @endif
                                                <option value="{{ $library->id }}">{{ $library->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success btn-block">Edit Magazine</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

