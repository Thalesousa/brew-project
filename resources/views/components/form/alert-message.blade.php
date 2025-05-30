@props(['message'])

<div class="p-4 bg-green-100 text-green-800 rounded-lg mt-4 flex items-center justify-between">
    <span class="font-semibold">{{ $message }}</span>
    <svg {{ $attributes->merge(['xmlns' => 'http://www.w3.org/2000/svg', 'fill' => 'none', 'viewBox' => '0 0 24 24', 'stroke-width' => '1.5', 'stroke' => 'currentColor', 'class' => 'size-6 cursor-pointer']) }}>
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
    </svg>
</div>
