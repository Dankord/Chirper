@php
    $navigations = [
        ['title' => 'Home', 'icon' => 'house', 'url' => '/'],
        ['title' => 'Explore', 'icon' => 'compass', 'url' => '/explore'],
        ['title' => 'Notifications', 'icon' => 'bell', 'url' => '/notif'],
        ['title' => 'Bookmarks', 'icon' => 'bookmark', 'url' => '/bookmark'],
        ['title' => 'Profile', 'icon' => 'user-round', 'url' => '/profile']
    ];
@endphp

<div class="flex justify-end">
    <div class="flex w-60 flex-col gap-2">
        @foreach($navigations as $item)
            <a href="{{ $item['url'] }}"
                class="btn btn-ghost rounded-xl border-0 hover:text-white hover:bg-black justify-start gap-5">
                <x-dynamic-component :component="'lucide-' . $item['icon']" class="size-5"/>
                <span>{{ $item['title'] }}</span>
            </a>
        @endforeach
    </div>
</div>