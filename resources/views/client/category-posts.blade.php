@extends('layouts.client')

@section('content')

 <div class="col-sm-12">
              <div class="card" data-aos="fade-up">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <h1 class="font-weight-600 mb-4">
                        {{ $category->title }}
                      </h1>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-8">
                     @if ($category !=null && $all_posts !=null && $all_posts->count() > 0)
                        @foreach ($all_posts as $post)

                        <a href="{{route('client.posts.post-detail', ['post_id'=>$post->id])}}" class="text-dark">
                             <div class="row">
                        <div class="col-sm-4 grid-margin">
                          <div class="rotate-img">
                            <img
                              src="{{ asset('storage/posts/'.$post->image) }}"
                              alt="banner"
                              class="img-fluid"
                            />
                          </div>
                        </div>
                        <div class="col-sm-8 grid-margin">
                          <h2 class="font-weight-600 mb-2">
                            {{ $post->title }}
                          </h2>
                          <p class="fs-13 text-muted mb-0">
                            <span class="mr-2">Posted </span>{{ $post->created_at->diffForHumans() }}
                          </p>
                          <p class="fs-15">
                            {!! $post->desc !!}
                          </p>
                        </div>
                      </div>

                        </a>

                        @endforeach
                         
                     @else
                            <p>No posts found in this category</p>
                         
                     @endif
                     
                     
                     
                   
                     
                    </div>
                    <div class="col-lg-4">
                      <h2 class="mb-4 text-primary font-weight-600">
                        Latest news
                      </h2>
                      @if ($latest_posts !=null && $latest_posts->count() > 0)
                          @foreach ($latest_posts as $latest_post)

                        <a href="{{route('client.posts.post-detail', ['post_id'=>$latest_post->id])}}" class="text-dark">
                              <div class="row">
                        <div class="col-sm-12">
                          <div class="border-bottom pb-4 pt-4">
                            <div class="row">
                              <div class="col-sm-8">
                                <h5 class="font-weight-600 mb-1">
                                  {{ $latest_post->title }}
                                </h5>
                                <p class="fs-13 text-muted mb-0">
                                  <span class="mr-2">Posted </span>{{ $latest_post->created_at->diffForHumans() }}
                                </p>
                              </div>
                              <div class="col-sm-4">
                                <div class="rotate-img">
                                  <img
                                    src="{{ asset('storage/posts/'.$latest_post->image) }}"
                                    alt="banner"
                                    class="img-fluid"
                                  />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        </a>
                              
                          @endforeach
                          
                      @else
                            <h2>No posts found</h2>
                          
                      @endif



                     
                      
                      <div class="trending">
                        <h2 class="mb-4 text-primary font-weight-600">
                          Trending Posts
                        </h2>
                        @if ($trending_posts->count()>0)
                        @foreach ($trending_posts as $trending_post )
                         <a href="{{route('client.posts.post-detail', ['post_id'=>$trending_post->id])}}" class="text-dark">
                          <div class="mb-4">
                          <div class="rotate-img">
                            <img
                              src="{{ asset('storage/posts/'.$trending_post->image) }}"
                              alt="banner"
                              class="img-fluid"
                            />
                          </div>
                          <h3 class="mt-3 font-weight-600">
                            {{ $trending_post->title }}
                          
                          </h3>
                          <p class="fs-13 text-muted mb-0">
                            <span class="mr-2">Posted: </span>{{ $trending_post->created_at->diffForHumans() }}
                            <span class=" ml-4 mr-2 ">Views: </span> {{ $trending_post->views}}
                          </p>
                        </div>
                         </a>
                          
                        @endforeach
                          
                        @else
                            <h2>No trending posts found</h2>
                          
                        @endif
                       
                       
                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection