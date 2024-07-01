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
                @if ($advert_requests ->count()>0)
        
            @foreach ( $advert_requests as $advert_request)
            <tr>
                <td>
                    {{$advert_request->user->name}}
                </td>
                <td>
                    {{$advert_request->phone}}
                </td>
                <td>
                    {{$advert_request->user->email}}
                </td>
                <td>
                    {{$advert_request->created_at}}
                </td>

                <td>
                  
                    @if ($advert_request->user->is_advertiser)
<a href="{{route('admin.advertiser.ban', ['advert_user_id'=>$advert_request->user->id])}}" class="btn btn-info btn-sm btn-danger mr-1 ">
                                            <i class="fas fa-ban "> </i> Ban User</a>
                      
                    @else
                    <a href="{{route('admin.advert.request.approve', ['advert_user_id'=>$advert_request->user->id])}}" class="btn btn-info btn-sm btn-success mr-1 ">
                                            <i class="fas fa-edit text-success"> </i> Approve Request</a>
                      
                    @endif

                    <a href="{{route('admin.advert.request.delete', ['advert_request_id'=>$advert_request->id])}}" class="btn btn-danger btn-sm ">
                                            <i class="fas fa-trash"></i> Delete Access</a>
                    
                </td> 
               
            </tr>
            
        @endforeach
    
            
        @else
        <tr>
          <h2>No advert requests found currently</h2>
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