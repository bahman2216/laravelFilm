{{--/**
 * Created by PhpStorm.
 * User: Muhammad
 * Date: 9/20/2018
 * Time: 14:26
 */--}}
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($films as $film)
                    <a href="{{route('films.show', ['slug' => $film->slug])}}">{{$film->name}}</a>
                    <div>{{$film->description}}</div>
                    <div>{{$film->comments}}</div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                {{ $films->links() }}
            </div>
        </div>

    </div>


@endsection