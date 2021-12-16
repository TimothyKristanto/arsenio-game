@extends('template.mainPage')

@section('story', 'Arsenio: Story')

@section('mainContent')
<body 
    class="
    @if ($story->story_id == 1)
        story-bg1
    @else
        story-bg2
    @endif
    "
>
    @if(session()->has('storyDesc'))
        <div class="d-flex justify-content-end">
            <div class="alert alert-warning alert-dismissible fade show story-desc-alert" role="alert">
                {{ session('storyDesc') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        
    @endif

    <div class="story-desc text-end">
        <a href="/story/{{ $story->story_id }}/t">
            <i class="fas fa-book text-center story-icon">
                <br> <span class="story-text">Story</span> 
            </i> 
        </a>
        
    </div>

    <div class="container">
        <a href="{{ route('battle.index') }}" type="button" class="btn btn-primary">{{ $story->story_id }}-1</a>
        <a href="{{ route('battle.index') }}" type="button" class="btn btn-primary">{{ $story->story_id }}-2</a>
        <a href="{{ route('battle.index') }}" type="button" class="btn btn-primary">{{ $story->story_id }}-3</a>
        <a href="{{ route('battle.index') }}" type="button" class="btn btn-primary">{{ $story->story_id }}-4</a>
        <a href="{{ route('battle.index') }}" type="button" class="btn btn-primary">{{ $story->story_id }}-5</a>
    </div>

    @include('template.footer')
    
@include('template.footer')
</body>


@endsection
