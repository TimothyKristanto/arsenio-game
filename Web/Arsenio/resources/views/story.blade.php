@extends('template.mainPage')

@section('story', 'Arsenio: Story')

@section('mainContent')
<body 
    class="
    @if ($storyLevel[0]->story_id == 1)
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
        <a href="/story/{{ $storyLevel[0]->story_id }}/t">
            <i class="fas fa-book text-center story-icon">
                <br> <span class="story-text">Story</span> 
            </i> 
        </a>
        
    </div>

    <div class="container">
        @php
            $i = 1;
        @endphp

        @foreach ($storyLevel as $level)

            @if ($student->story_level_progress >= $level->level_id)
                <a href="{{ route('battle.show', $level->level_id) }}" type="button" class="btn btn-primary">{{ $storyLevel[0]->story_id }}-{{ $i }}</a>
            @else
                <span class="btn btn-primary disabled-link">{{ $storyLevel[0]->story_id }}-{{ $i }}</span>
            @endif

            @php
                $i++
            @endphp

        @endforeach
    </div>

    @include('template.footer')
    
@include('template.footer')
</body>


@endsection
