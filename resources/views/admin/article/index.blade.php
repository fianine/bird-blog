@extends('admin.layouts.app')

@push('styles')
  <!-- Custom styles for this page -->
  <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Articles</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All Article</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Author</th>
                      <th>Title</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($articles as $item)
                      <tr>
                        <td>{{ $item->author }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                          <a href="{{ route('secret.editArticle', ['id' => $item->id]) }}" class="btn btn-warning">Edit</a>
                          <button class="btn btn-danger button-delete" onclick="deleteData({{ $item->id }})" type="submit">Delete</button>
                        </td>
                      </tr>  
                    @endforeach                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
      function deleteData(id) {
        swal({
          title: "Are you sure ?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yap, delete!",
          cancelButtonText: "Nope, don't delete!"
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "{{ url('/secret/delete-article') }}" + '/' + id,
              type: "POST",
              data: {
                '_method': 'DELETE',
                '_token': "{{ csrf_token() }}"
              },
              success: function(){
                Swal.fire(
                  'Deleted!',
                  'Deleted successfully !',
                  'success'
                ).then(function() {
                  location.reload();
                });
              },
              error: function() {             
                swal({
                  title: 'Opps...',
                  text: 'Error',
                  type: 'error'
                })
              }
            });
          } else {
            swal("Delete cancel !");
          }
        });
      }
    </script>

    <script>
      // Call the dataTables jQuery plugin
      $(document).ready(function() {
          $('#dataTable').DataTable();
      });
    </script>
@endsection