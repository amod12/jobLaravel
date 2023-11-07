@props (['item'])
{{-- @php dd($item[tag]) @endphp --}}

<x-card> 
  <div class="flex">
    <img class="hidden w-48 mr-6 md:block"
    {{-- @php dd($item->logo) @endphp --}}
      src="{{$item->logo ? asset('storage/' .$item->logo) : asset('/images/no-image.png')}}" alt="" />
    <div>
      <h3 class="text-2xl">
        <a href="/item/{{$item->id}}">{{$item->title}}</a>
      </h3>
      <div class="text-xl font-bold mb-4">{{$item->company}}</div>
      <x-item-tag :itemTags="$item->tags" />
      <div class="text-lg mt-4">
        <i class="fa-solid fa-location-dot"></i> {{$item->location}}
      </div>
    </div>
  </div>
</x-card>
