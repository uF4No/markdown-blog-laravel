@extends('layouts.app')

@section('content')
<section class="w-full">

  <h3 class="text-center text-3xl font-semibold">New Article</h3>
  
  <form class="w-full px-6"  action="{{route('articles.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-4/5 px-3 mb-6 md:mb-0">
        <label class="label" for="title">
          Title
        </label>
        <input class="input" id="title" name="title" type="text" >
        <p class="text-red-500 text-xs italic">Please fill out this field.</p>
      </div>
      <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
        <label class="label" for="online">
          Online?
        </label>
        <div class="relative">
          <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight " id="online" name="online">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="label" for="grid-password">
          Article body
        </label>
        <p class="text-gray-600 text-xs italic mb-2">This is actual article body</p>
        <textarea class="input " name="body" id="body">{{ old('body') }}</textarea>
      </div>
    </div>
		
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="label" for="grid-password">
          Summary
        </label>
        <p class="text-gray-600 text-xs italic mb-2">This is the text that will appear in the blog index page</p>
        <textarea class="input " name="summary" id="summary">{{ old('summary') }}</textarea>
      </div>
    </div>

    <div class="w-full text-right pa-3 mb-6">
      <input class="btn btn-green my-4" type="submit" value="Save article">
    </div>
  </form>

</section>

  {{-- Import CSS and JS for SimpleMDE editor --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
  <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

  <script>
		// Initialise editors
    var bodyEditor = new SimpleMDE({ element: document.getElementById("body") });
    var summaryEditor = new SimpleMDE({ element: document.getElementById("summary") });
  </script>
	
@endsection
