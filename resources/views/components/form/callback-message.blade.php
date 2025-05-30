@props([
    'message' => '',
    'type' => 'error'
])

<span @class([
        'text-sm', 'text-red-600' => $type === 'error',
        'text-green-600' => $type === 'success',
        'text-yellow-600' => $type === 'warning',
        'text-blue-600' => $type === 'info',
    ])>
    {{ $message }}
</span>
