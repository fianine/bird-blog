@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/vendor/summernote/summernote.css') }}">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Add New Article</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Write new article</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('secret.addArticle') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="Title..." />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="summernote" name="content"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="file" name="image" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="float-right">
                                    <button class="btn btn-warning" name="status" value="draft" type="submit">Draft</button>
                                    <button class="btn btn-primary" name="status" value="publish" type="submit">Publish</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('script')
    <script src="{{ asset('admin/vendor/summernote/summernote.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 500
            });
        });
    </script>
@endsection