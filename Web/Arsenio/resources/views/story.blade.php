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
    <div class="story-desc text-end">
        <a href="#">
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
    

</body>


@endsection
