@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-800 text-white border border-green-500 shadow-md shadow-green-500/20 font-semibold transition duration-200'
    : 'inline-flex items-center gap-2 px-4 py-2 rounded-xl text-gray-300 hover:text-white hover:bg-gray-800 hover:shadow hover:shadow-green-500/10 transition duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
