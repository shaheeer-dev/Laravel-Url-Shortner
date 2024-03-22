@extends('layouts.app')

@section('content')
  <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    @if ($urls)
    <url :urls="{{$urls}}"></url>
    @else
      <div class="text-center">
        <p>Loading URLs...</p>
      </div>
    @endif
  </div>
@endsection

