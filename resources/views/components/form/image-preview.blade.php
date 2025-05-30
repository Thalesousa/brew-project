@props([
  'image',
  'alt' => 'Image preview',
  'width' => '100', // px
  'height' => '100',
  'iconErrorSize' => '10',
])

@if(!$image)
    <div class="bg-gray-100 flex items-center justify-center rounded-lg" style="width: {{ $width }}px; height: {{ $height }}px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.5" stroke="currentColor" class="size-{{ $iconErrorSize }}">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5
                     1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18
                     3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0
                     0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5
                     0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375
                     0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
        </svg>
    </div>
@else
    <a href="{{ $image }}" target="_blank" rel="noopener noreferrer">
        <img src="{{ $image }}"
             alt="{{ $alt }}"
             class="object-cover rounded-lg shadow"
             style="width: {{ $width }}px; height: {{ $height }}px;">
    </a>
@endif
