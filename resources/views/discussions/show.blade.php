@extends('layouts.app')

@section('content')


<div class="card">

		@include('partials.discussion-header')

        <div class="card-body">
            <div class="text-center">
                <strong>
                    {!! $discussion->title !!}
                </strong>
            </div>

            <hr>

            {!! $discussion->content !!}
            @if($discussion->bestReply)
                <div class="card bg-success my-5 text-white">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <img src="{{ Gravatar::src($discussion->bestReply->owner->email) }}" width="40" height="40" style="border-radius: 50%" class="mr-2">
                                <strong>
                                    {{ $discussion->bestReply->owner->name }}
                                </strong>
                            </div>
                            <div>
                                <strong>
                                    Best Reply
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $discussion->bestReply->content !!}
                    </div>
                </div>
            @endif
        </div>
</div>

@foreach($discussion->replies()->paginate(3) as $reply)
    <div class="card my-5">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <img src="{{ Gravatar::src($reply->owner->email) }}" width="40" height="40" style="border-radius: 50%">
                    <span>{{ $reply->owner->name }}</span>
                </div>
                <div>
                    @auth
                        @if(auth()->user()->id == $discussion->user_id)
                            <form action="{{ route('discussions.best-reply', ['discussion' => 
                            $discussion->slug, 'reply' => $reply->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Mark as Best Reply</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! $reply->content !!}
        </div>
    </div>

@endforeach

{{ $discussion->replies()->paginate(3)->links() }}


<div class="card my-5">
    <div class="card-header">
        Add Reply
    </div>
    <div class="card-body">
        @auth
            <form method="POST" action="{{ route('replies.store', $discussion->slug) }}">
                @csrf
                <input type="hidden" name="content" id="content">
                <trix-editor input="content"></trix-editor>

                <button type="submit" class="btn btn-success my-2">
                    Add Reply
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-info">Sign to add a reply</a>
        @endauth
    </div>
</div>
@endsection



@section('css')
    <link href="{{ asset('css/trix.css') }}" rel="stylesheet">
@endsection



@section('scripts')
    <script src="{{ asset('js/trix.js') }}"></script>
@endsection
