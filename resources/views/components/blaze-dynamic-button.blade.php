@props(['size' => 'xs'])

<div class="px-3 py-1.5 bg-zinc-600 hover:bg-zinc-700 text-white rounded text-{{ $size }} font-medium transition-colors cursor-pointer text-center">
    {{ $slot }}
</div>
