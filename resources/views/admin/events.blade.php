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
                    <th>Event Title</th>

                    <th>Event Description</th>
                    <th>Event Date</th>
                    

                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($events ->count()>0)
        
            @foreach ( $events as $event)
            <tr>
                <td>
                    {{$event->title}}
                </td>
                <td>
                    {!!$event->desc!!}
                </td>
                <td>
                    {{$event->date}}
                </td>
                <td>
                    {{$event->created_at}}
                </td>

                <td>
                    <a href="{{route('admin.event.update.form', ['event_id'=>$event->id])}}" class="btn btn-info btn-sm  mr-1 ">
                                            <i class="fas fa-edit"> </i> View/Edit</a>

                    <a href="{{route('admin.event.delete', ['event_id'=>$event->id])}}" class="btn btn-danger btn-sm ">
                                            <i class="fas fa-trash"></i> Delete</a>
                    
                </td>
               
            </tr>
            
        @endforeach
    
            
        @else
        <tr>
          <h2>No events found currently</h2>
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