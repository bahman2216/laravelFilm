{{--/**
 * Created by PhpStorm.
 * User: Muhammad
 * Date: 9/20/2018
 * Time: 13:46
 */--}}

@extends('layouts.app')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('plugins/')}}/cropper/cropper.css">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('film.create-film')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('films.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('film.Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea rows="5" cols="10" id="description"
                                              class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                              name="description" required>{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="release_date"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Release Date') }}</label>

                                <div class="col-md-6">
                                    <input id="release_date" type="date"
                                           class="form-control{{ $errors->has('release_date') ? ' is-invalid' : '' }}"
                                           name="release_date" required>

                                    @if ($errors->has('release_date'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('release_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="rating"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Rating') }}</label>

                                <div class="col-md-6">
                                    <select id="rating" class="form-control" name="rating" required>
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ticket_price"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Ticket Price') }}</label>

                                <div class="col-md-6">
                                    <input id="ticket_price" type="text"
                                           class="form-control{{ $errors->has('ticket_price') ? ' is-invalid' : '' }}"
                                           name="ticket_price" value="{{ old('ticket_price') }}" required>

                                    @if ($errors->has('ticket_price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ticket_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="country"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                                <div class="col-md-6">
                                    <select id="country" class="form-control" name="country" required>
                                        <option value=""></option>
                                        @foreach(config('film.countries') as $key => $country)
                                            <option value="{{$key}}">{{$country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="genre[]"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Genre') }}</label>

                                <div class="col-md-6">
                                    <select class="js-example-basic-multiple" name="genre[]" multiple="multiple">
                                        @foreach(\App\Genre::all() as $key => $genre)
                                            <option value="{{$key}}">{{$genre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="photo"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                                <div class="col-md-6">
                                    <img class="cropper" id="photo">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{asset('/plugins/')}}/cropper/cropper.js"></script>

    <script>

        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();

            $('#photo').cropper({});

        });
    </script>
@endsection