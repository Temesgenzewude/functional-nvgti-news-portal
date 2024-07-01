@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
          <div class="col-lg-3 col-6">
            <!-- Categories -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$categories->count()}}</h3>

                <p>Categories</p>
              </div>
              <div class="icon">
                <i class="fa fa-list-alt "></i>
              </div>
              @if (auth()->check() && auth()->user()->is_admin)
                              <a href="{{route('admin.category.getCategories')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

              @endif
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- Posts -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$posts->count()}}</h3>

                <p>Posts</p>
              </div>
              <div class="icon">
                <i class="fa fa-newspaper"></i>
              </div>
              <a href="{{route('admin.post.getPosts')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @if (auth()->check() && auth()->user()->is_admin)
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- Users -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$users->count()}}</h3>

                <p>Users</p>
              </div>

              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{route('admin.user.getUsers')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
            
          @endif
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- Events -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$events->count()}}</h3>

                <p>Events</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
              @if (auth()->check() && auth()->user()->is_admin)
                            <a href="{{route('admin.event.getEvents')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                
              @endif
            </div>
          </div>
          <!-- ./col -->



           <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- Videos -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$videos->count()}}</h3>

                <p>Videos</p>
              </div>
              <div class="icon">
                <i class="fa fa-play"></i>
              </div>
              <a href="{{route('admin.video.getVideos')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          @if (auth()->check() && auth()->user()->is_admin)
           <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- Writer Requests -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$writer_requests->count()}}</h3>

                <p>Writer Requests</p>
              </div>
              <div class="icon">
                <i class="fa fa-edit"></i>
              </div>
              <a href="{{route('admin.writer.requests')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

            <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- Writer -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{$writers->count()}}</h3>

                <p>Active Writers</p>
              </div>
              <div class="icon">
                <i class="fa fa-edit"></i>
              </div>
              <a href="{{route('admin.writer.requests')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
               <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- Advertiser Requests -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$advert_requests->count()}}</h3>

                <p>Advertiser Requests</p>
              </div>
              <div class="icon">
                <i class="fa fa-newspaper"></i>
              </div>
              <a href="{{route('admin.advert.requests')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

             <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- Advertisers -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{$advertisers->count()}}</h3>

                <p>Active Advertisers</p>
              </div>
              <div class="icon">
                <i class="fa fa-newspaper"></i>
              </div>
              <a href="{{route('admin.advert.requests')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
            
          @endif

          

          

          
        </div>
        @if (auth()->check() && auth()->user()->is_admin)

          <div class="row">
          <div class="col-lg-10  ">
            <!-- For latest users-->
          

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Latest Users</h3>
              </div>
              <!-- /.card-header -->
             <table class=" table table-bordered table-responsive-sm ">

              <thead>
                <tr>
                  <th>
                  Name
                </th>
                <th>
                  Email
                </th>
                
                <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @if ($latest_users->count()>0)
                @foreach ($latest_users as $latest_user )
                <tr>
                  <td>
                  {{$latest_user->name}}
                </td>
                <td>
                  {{$latest_user->email}}
                </td>
               
                  <td>
                    <a href="{{route('admin.user.update.form', ['user_id'=>$latest_user->id])}}" class="btn btn-info btn-sm  mr-1 ">
                                            <i class="fas fa-edit"> </i> View/Edit</a>

                    <a href="{{route('admin.user.delete', ['user_id'=>$latest_user->id])}}" class="btn btn-danger btn-sm ">
                                            <i class="fas fa-trash"></i> Delete</a>
                    
                </td>
                </tr>
                  
                @endforeach

                  
                @else
                <h2>
                  No Users found
                </h2>
                  
                @endif
              </tbody>
             </table>
            </div>
            
          </div>
         
       
        </div>
        @endif
        <!-- /.row -->
        <div class="row">
         
          <!-- for latest posts -->
          <div class="col-lg-10">
        

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  
                  Latest Posts
                </h3>

              </div>
               <table class=" table table-bordered table-responsive-sm ">

              <thead>
                <tr>
                  <th>
                  Title
                </th>
                <th>
                  Views
                </th>
                <th>
                  Category
                </th>
                
                <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @if ($latest_posts->count()>0)
                @foreach ($latest_posts as $latest_post )
                <tr>
                  <td>
                  {{$latest_post->title}}
                </td>
                <td>
                  {{$latest_post->views}}
                </td>
                 <td>
                  {{$latest_post->category->title}}
                </td>
               
                  <td>
                    <a href="{{route('admin.post.update.form', ['post_id'=>$latest_post->id])}}" class="btn btn-info btn-sm  mr-1 ">
                                            <i class="fas fa-edit"> </i> View/Edit</a>

                    <a href="{{route('admin.post.delete',['post_id'=>$latest_post->id])}}" class="btn btn-danger btn-sm ">
                                            <i class="fas fa-trash"></i> Delete</a>
                    
                </td>
                </tr>
                  
                @endforeach

                  
                @else
                <h2>
                  No latest posts found
                </h2>
                  
                @endif
              </tbody>
             </table>
              
                 
            
              
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
