<x-layout>
  {{-- @if (!Auth::check())
    @include('partials._hero')
  @endif --}}

  @include('partials._search')
  @include('partials._hero')


  <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">


    @foreach($items as $item)
    <x-item-card :item="$item" />
    @endforeach 

  </div>
  <div class="mt-6 p-4">
    {{$items->links()}}
  </div>
  
</x-layout>
