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

                 <table class="table table-striped table-responsive-sm">
            <thead>
                <tr>
                    <th>Name</th>

                    <th>Phone</th>
                    <th>Email</th>
                    

                    <th>Sent on</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($writer_requests ->count()>0)
        
            @foreach ( $writer_requests as $writer_request)
            <tr>
                <td>
                    {{$writer_request->user->name}}
                </td>
                <td>
                    {{$writer_request->phone}}
                </td>
                <td>
                    {{$writer_request->user->email}}
                </td>
                <td>
                    {{$writer_request->created_at}}
                </td>


                 <td>
                  
                    @if ($writer_request->user->is_writer)
<a href="{{route('admin.writer.ban', ['writer_user_id'=>$writer_request->user->id])}}" class="btn btn-info btn-sm btn-danger mr-1 ">
                                            <i class="fas fa-ban "> </i> Ban User</a>
                      
                    @else
                    <a href="{{route('admin.writer.request.approve', ['writer_user_id'=>$writer_request->user->id])}}" class="btn btn-info btn-sm btn-success mr-1 ">
                                            <i class="fas fa-edit text-success"> </i> Approve Request</a>
                      
                    @endif

                    <a href="{{route('admin.writer.request.delete', ['writer_request_id'=>$writer_request->id])}}" class="btn btn-danger btn-sm ">
                                            <i class="fas fa-trash"></i> Delete Access</a>
                    
                </td> 

                
               
            </tr>
            
        @endforeach
    
            
        @else
        <tr>
          <h2>No writer requests found currently</h2>
        </tr>
            
        @endif
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


  
@endsection