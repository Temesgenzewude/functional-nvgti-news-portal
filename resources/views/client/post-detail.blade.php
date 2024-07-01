@extends('layouts.client')

@section('content')

<div class="row">
            <div class="col-sm-12">
              <div class="card" data-aos="fade-up">
                <div class="card-body">
                  <div class="aboutus-wrapper">
                    <h1 class="mt-5">
                      {{ $post->title }}
                    </h1>
                    {!!$post->desc!!}
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection
