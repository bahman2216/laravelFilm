{{--/**
 * Created by PhpStorm.
 * User: Muhammad
 * Date: 9/20/2018
 * Time: 14:26
 */--}}
@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="card">
            @foreach($films as $film)
                <div class="card-header">
                    <a href="{{route('films.show', ['slug' => $film->slug])}}">{{$film->name}}</a>
                </div>
                <div class="card-body">
                    <div>{{$film->description}}</div>

                    <hr>

                    @if(\Illuminate\Support\Facades\Auth::check())
                        <form name="send-comment" id="send-comment" method="POST"
                              action="{{ route('films.comment.store') }}">
                            @csrf

                            <input name="fid" id="fid" type="hidden" value="{{$film->id}}">
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
                                <label for="comment"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

                                <div class="col-md-6">
                                    <textarea rows="5" cols="10" id="comment"
                                              class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}"
                                              name="comment" required>{{ old('comment') }}</textarea>

                                    @if ($errors->has('comment'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input value="{{ __('Send') }}" id="send-comment" type="submit"
                                           class="btn btn-primary">
                                </div>
                                <div id="result"></div>
                            </div>
                        </form>
                    @endif
                    <h3 class="text-muted">Comments</h3>
                    <div class="comment-area">
                        @foreach($film->comments as $comment)
                            <div class="name text-info">{{$comment->name}}</div>
                            <div class="comment text-muted">{{$comment->comment}}</div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">

                {{ $films->links() }}
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function () {
            $("#send-comment").submit(function (event) {

                event.preventDefault();

                var $form = $(this),
                    token = $form.find("input[name='_token']").val(),
                    fid = $form.find("input[name='fid']").val(),
                    name = $form.find("input[name='name']").val(),
                    comment = $form.find("textarea[name='comment']").val(),
                    url = $form.attr("action");

                var post = $.post(url, {"_token": "{{ csrf_token() }}", fid: fid, name: name, comment: comment});

                post.done(function (data) {
                    $("#result").empty().append(data.message);
                    $(".comment-area").prepend('<div class="name text-info">'+ name +'</div>');
                    $(".comment-area").prepend('<div class="comment text-muted">'+ comment +'</div>');
                });
            });
        });

    </script>

@endsection