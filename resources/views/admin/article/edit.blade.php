@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/vendor/summernote/summernote.css') }}">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Edit Article</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit article</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('secret.editArticle', ['id' => $article->id]) }}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" name="title" class="form-control" placeholder="Title..." value="{{ $article->title }}" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="summernote" name="content">
                                    {{ $article->content }}
                                </textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="file" name="image" />
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                See Thumbnail
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thumbnail</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <img src="{{ asset('uploads/articles/thumbnail/'.$article->image) }}" class="img-fluid">
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
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