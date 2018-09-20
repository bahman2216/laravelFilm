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
            @if(Session::has('message'))
                <p class="alert {{ \Illuminate\Support\Facades\Session::get('alert-class', 'alert-info') }}">{{ \Illuminate\Support\Facades\Session::get('message') }}</p>
            @endif
                <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{__('film.create-film')}}</div>

                    <div class="card-body">
                        <form id="form-film" method="POST" action="{{ route('films.store') }}">
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
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                        </div>
                                        <input pattern="^\d+(?:\.\d{0,2})$" id="ticket_price" type="text"
                                               class="form-control{{ $errors->has('ticket_price') ? ' is-invalid' : '' }}"
                                               name="ticket_price" value="{{ old('ticket_price') }}" required>
                                        @if ($errors->has('ticket_price'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ticket_price') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="country_code"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                                <div class="col-md-6">
                                    <select id="country_code" class="form-control" name="country_code" required>
                                        <option value=""></option>
                                        @foreach(config('film.countries') as $key => $country)
                                            <option value="{{$key}}">{{$country}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('country_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="genre[]"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Genre') }}</label>

                                <div class="col-md-6">
                                    <select class="genre" id="genre" name="genre[]" multiple="multiple">
                                        @foreach(\App\Genre::all() as $genre)
                                            <option value="{{$genre->id}}">{{$genre->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('genre'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('genre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div data-preview="#photo"
                                     data-aspectRatio="1"
                                     data-crop="true"
                                     class="form-group col-md-12 image"
                                >
                                    <div>
                                        <label for="image"
                                               class="">{{ __('Photo') }}</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6" style="margin-bottom: 20px;">
                                            <img id="mainImage" src="{{ url( old('photo') ? old('photo') : '')  }}">
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="docs-preview clearfix">
                                                <div id="photo" class="img-preview preview-lg">
                                                    <img src=""
                                                         style="display: block; min-width: 0px !important; min-height: 0px !important; max-width: none !important; max-height: none !important; margin-left: -32.875px; margin-top: -18.4922px; transform: none;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        <label class="btn btn-primary btn-file">
                                            {{ __('Choose file') }} <input type="file" accept="image/*"
                                                                           id="uploadImage">
                                            <input type="hidden" id="hiddenImage" name="photo">
                                        </label>
                                    </div>

                                    @if ($errors->has('photo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif

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

    <script src="{{asset('/')}}js/select2.min.js"></script>
    <script src="{{asset('/')}}js/jquery.validate.min.js"></script>
    <script src="{{asset('/plugins/')}}/cropper/cropper.js"></script>

    <script>
        $(document).ready(function () {

            $("#form-film").validate({
                validClass: "text-success",
                errorClass: "text-danger",
            });

            $('#genre').select2();

            $('.image').each(function (index) {
                // Find DOM elements under this form-group element
                var $mainImage = $(this).find('#mainImage');
                var $uploadImage = $(this).find("#uploadImage");
                var $hiddenImage = $(this).find("#hiddenImage");
                var $rotateLeft = $(this).find("#rotateLeft")
                var $rotateRight = $(this).find("#rotateRight")
                var $zoomIn = $(this).find("#zoomIn")
                var $zoomOut = $(this).find("#zoomOut")
                var $reset = $(this).find("#reset")
                var $remove = $(this).find("#remove")
                // Options either global for all image type fields, or use 'data-*' elements for options passed in via the CRUD controller
                var options = {
                    viewMode: 2,
                    checkOrientation: false,
                    autoCropArea: 1,
                    responsive: true,
                    preview: $(this).attr('data-preview'),
                    aspectRatio: $(this).attr('data-aspectRatio')
                };
                var crop = $(this).attr('data-crop');

                // Hide 'Remove' button if there is no image saved
                if (!$mainImage.attr('src')) {
                    $remove.hide();
                }
                // Initialise hidden form input in case we submit with no change
                $hiddenImage.val($mainImage.attr('src'));


                // Only initialize cropper plugin if crop is set to true
                if (crop) {

                    $remove.click(function () {
                        $mainImage.cropper("destroy");
                        $mainImage.attr('src', '');
                        $hiddenImage.val('');
                        $rotateLeft.hide();
                        $rotateRight.hide();
                        $zoomIn.hide();
                        $zoomOut.hide();
                        $reset.hide();
                        $remove.hide();
                    });
                } else {

                    $(this).find("#remove").click(function () {
                        $mainImage.attr('src', '');
                        $hiddenImage.val('');
                        $remove.hide();
                    });
                }

                $uploadImage.change(function () {
                    var fileReader = new FileReader(),
                        files = this.files,
                        file;

                    if (!files.length) {
                        return;
                    }
                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $uploadImage.val("");
                            if (crop) {
                                $mainImage.cropper(options).cropper("reset", true).cropper("replace", this.result);
                                // Override form submit to copy canvas to hidden input before submitting
                                $('form').submit(function () {
                                    var imageURL = $mainImage.cropper('getCroppedCanvas').toDataURL(file.type);
                                    $hiddenImage.val(imageURL);
                                    return true; // return false to cancel form action
                                });
                                $rotateLeft.click(function () {
                                    $mainImage.cropper("rotate", 90);
                                });
                                $rotateRight.click(function () {
                                    $mainImage.cropper("rotate", -90);
                                });
                                $zoomIn.click(function () {
                                    $mainImage.cropper("zoom", 0.1);
                                });
                                $zoomOut.click(function () {
                                    $mainImage.cropper("zoom", -0.1);
                                });
                                $reset.click(function () {
                                    $mainImage.cropper("reset");
                                });
                                $rotateLeft.show();
                                $rotateRight.show();
                                $zoomIn.show();
                                $zoomOut.show();
                                $reset.show();
                                $remove.show();

                            } else {
                                $mainImage.attr('src', this.result);
                                $hiddenImage.val(this.result);
                                $remove.show();
                            }
                        };
                    } else {
                        alert("Please choose an image file.");
                    }
                });

            });

        });
    </script>
@endsection