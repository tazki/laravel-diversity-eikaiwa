@extends('layouts.error')

@section('content')
<div class="wrapper">
    <div class="empty-state">
        <div class="empty-state-container">
            <div class="state-figure"></div>
            @if(isset($row['message']) && !empty($row['message']))
            <h3 class="state-header">{{ $row['message'] }}</h3>
            @else
            <h3 class="state-header"> {{ __('Page Not found!') }} </h3>
            <p class="state-description lead text-muted">
                {{ __('Sorry, we\'ve misplaced that URL or it\'s pointing to something that doesn\'t exist.') }} </p>
            <div class="state-action">
                <a href="/" class="btn btn-lg btn-light"><i class="fa fa-angle-right"></i> {{ __('Go Back') }}</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
