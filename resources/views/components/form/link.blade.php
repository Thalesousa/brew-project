@props([
    'link' => '#',
    'text' => 'Clique aqui',
])

<div class="text-center mt-4">
    <a href="{{ $link }}" class="text-blue-600 hover:underline text-xs">{{ $text }}</a>
</div>
