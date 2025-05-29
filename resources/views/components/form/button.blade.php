@props([
    'type' => 'button',
    'text' => '',
])

<button
    type="{{ $type }}"
    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300"
>
  {{ $text }}
</button>
