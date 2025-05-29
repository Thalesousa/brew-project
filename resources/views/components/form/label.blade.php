@props([
    'text' => 'Label',
    'for' => '',
])

<label for="{{ $for }}" class="block text-gray-700 font-medium mb-1">
  {{ $text }}
</label>
