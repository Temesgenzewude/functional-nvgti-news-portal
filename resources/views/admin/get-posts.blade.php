@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$page}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/homr">Home</a></li>
              <li class="breadcrumb-item active">{{$page}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <table class="table table-striped table-bordered table-hover table-responsive-sm posts-table">
                    <thead>
                        <tr>
                            <th>
                                Title
                            </th>
                            <th>
                                Description
                            </th>
                           

                            <th>
                            Views
                            </th>

                            <th>
                                Created At
                            </th>

                            <th>
                                Actions
                            </th>

                           



                            
                        </tr>
                    </thead>

                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@section('additional_scripts')

<script type="text/javascript">
    $(document).ready(function(){
        $('.posts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('admin.post.getPosts')}}",
            columns: [
                {data: 'title', name: 'title'},
                {data: 'desc', name: 'desc'},
                
                {data: 'views', name: 'views'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action'},
                
            ]
        });
    });

</script>
  
@endsection