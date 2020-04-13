@extends('layouts.app')

@section('content')
<main class="text-gray-800 md:w-2/3 lg:w-3/5 xl:w-1/2 sm:w-full mx-auto">
  
    <div class="text-left pb-4 mt-4">
      <a class="text-sm leading-5 text-gray-700 hover:underline" href="{{ url()->previous() }}">Back to blog</a>
    </div>

    <h1 class="text-5xl text-center ">{{$article->title}}</h1>
    <p class="text-sm text-center leading-5 text-gray-700 mt-3">Posted {{\Carbon\Carbon::parse($article->updated_at)->format('d/m/Y')}}</p>
    <article class="markdown-body">
      {!! $article->body_html !!}
    </article>
</main>
@endsection
