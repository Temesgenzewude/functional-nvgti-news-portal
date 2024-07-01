@extends('layouts.client')

@section('content')


<div class="row">
    <div class="col-md 8 offset-md-2">
        <form method="POST" action="{{ route('client.advertise') }}">
                        @csrf

                       

                
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror"  name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <input  type="number" class="form-control "  name="user_id" value="{{ auth()->id()}}" hidden >

                        </div>

                       

                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Request to Become Advertizer') }}
                                </button>
                            </div>
                        </div>
                    </form>
        
    </div>
</div>


@endsection