@props(['name', 'value' => null, 'placeholder' => null, 'rows' => 4])

<textarea
    name="{{ $name }}"
    id="{{ $name }}"
    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
    placeholder="{{ $placeholder }}"
    rows="{{ $rows }}"
    {{ $attributes }}
>{{ $value ?? old($name) }}</textarea>
