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
              <li class="breadcrumb-item"><a href="/">Home</a></li>
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
            <div class="col-md-6 offset-md-3">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">{{$page}}</h3>
                  </div>
                  <!-- /.card-header -->
           
                
         
      <!-- form start -->
                  <form role="form" method="POST" action="{{route('admin.video.update', ['video_id'=>$video->id])}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                      
                      
                      
                      
                    <div class="form-group">
                        <label for="title">Video Title</label>
                        <input type="text" name="title" class="form-control" id="title" autocomplete="off" value="{{$video->title}}" >
                                      
                      </div>

                    <div class="form-group">
                        <label for="url">Video URL </label>
                        <input type="text" name="url" class="form-control"  value="{{$video->url}}" id="url" autocomplete="off" >
                                      
                      </div>

                      <div class="form-group">
                        <label for="category_id">Video Category </label>
                        <select name="category_id" id="category_id" class=" form-control ">
                           <option value="{{$video->category->id}}" selected>{{$video->category->title}}</option>
                          @if ( $categories->count() > 0)
                          @foreach ($categories as  $category)
                          <option value="{{$category->id}}">{{$category->title}}</option>
                            
                          @endforeach
                            
                          @else
                          
                            
                          @endif
                        </select>
                                      
                      </div>

                      <div class="form-group">
                        <label for="image">Video Thumbnail </label>
                        <input type="file" name="image" class="form-control" id="image" autocomplete="off">
                                      
                      </div>

                  
                    </div> 
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Update Video</button>
                    </div>
                  </form>

                
         
                </div>

            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection