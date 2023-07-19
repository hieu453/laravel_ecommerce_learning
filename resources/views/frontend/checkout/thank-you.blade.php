@extends('layouts.app')

@section('title', 'Thank You')

@section('content')
    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4>Thank you for shopping</h4>
                    <a href="{{ url('/collections') }}" class="btn btn-warning">Shop now</a>
                </div>
            </div>
        </div>
    </div>
@endsection