@props([
    'type' => 'text',
    'name' => '',
    'id' => '',
    'required' => false,
    'placeholder' => '',
])

<input
    type="{{ $type }}"
    placeholder="{{ $placeholder }}"
    id="{{ $id }}"
    name="{{ $name }}"
    @required($required)
    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
>
