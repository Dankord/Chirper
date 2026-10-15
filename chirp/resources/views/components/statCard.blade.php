@props([
    'number' => null,
    'title',
    'value',
    'color' => null,
])

@php
    $colors = [
        'bg-rose-100',
        'bg-orange-100',
        'bg-amber-100',
        'bg-lime-100',
        'bg-emerald-100',
        'bg-indigo-100',
        'bg-pink-100',
        'bg-sky-100'
    ];

    $backgroundColor = $color ?? $colors[array_rand($colors)];
@endphp

<div class="card">
    <div class="card-body {{ $backgroundColor }} rounded-xl">
        <p class="text-xs text-base-content/60">{{ $number }}</p>
        <h1 class="font-bold text-xl">#{{ $title }}</h1>
        <h3 class="text-xs text-base-content/60">{{ $value }} chirps</h3>
    </div>
</div>