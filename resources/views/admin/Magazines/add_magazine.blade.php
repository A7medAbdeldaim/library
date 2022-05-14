@extends('templates.admin_layout')
@section('title', 'Add  Magazine')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Magazine</h1>
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
                                <h3 class="card-title">Add a New Magazine</h3>
                            </div>
                            @include('templates.errors')
                            <form role="form" action="{{ route('admin.magazines.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body col-6">
                                    <div class="form-group">
                                        <label for="name_en">Name</label>
                                        <input type="text" id="name_en" class="form-control"
                                               placeholder="Enter Magazine Name" name="name_en"
                                               value="{{old('name_en')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description_en">Description</label>
                                        <textarea id="description_en" class="form-control"
                                                  placeholder="Enter Magazine Email" name="description_en" required>
                                            {{old('description_en')}}
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" id="price" class="form-control"
                                               placeholder="Enter Magazine Price" name="price"
                                               value="{{old('price')}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" id="stock" class="form-control"
                                               placeholder="Enter Magazine Stock" name="stock"
                                               value="{{old('stock')}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" id="image" class="form-control"
                                               name="image"
                                               value="{{old('image')}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="library_id">Library</label>
                                        <select class="form-control" id="library_id"
                                                name="library_id"
                                                required>
                                            @foreach($libraries as $library)
                                                <option value="{{ $library->id }}">{{ $library->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success btn-block">Add Magazine</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

