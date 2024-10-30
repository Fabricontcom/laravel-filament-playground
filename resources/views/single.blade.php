@extends('layouts.entry')

@section('content')
    <div class="max-w-4xl m-auto text-slate-300">
        <p>This is my body content. {{$post->title}}</p>
        @if($post->flexiblecontent)
            @foreach ($post->flexiblecontent as $block)
                <div class="">
                    @if($block['type'] == 'paragraph')
                        {{ $block['data']['content'] }}
                    @elseif ($block['type'] == 'heading')
                        <h2 class="text-3xl font-bold text-yellow-400">{{ $block['data']['content'] }}</h2>
                    @elseif ($block['type'] == 'image')
                        <img src="{{ $block['data']['url'] }}" />
                    @endif
                </div>
            @endforeach
        @endif
    </div>
@endsection
