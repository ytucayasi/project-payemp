@props(['active'])

@php
$classes = ($active ?? false)
            ? 'sidebar-menu-item-link sidebar-menu-item-link-active'
            : 'sidebar-menu-item-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
