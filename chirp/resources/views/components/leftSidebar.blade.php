@php
    $navigations = [
        ['title' => 'Home', 'icon' => 'house', 'route' => 'home'],
        ['title' => 'Explore', 'icon' => 'compass', 'route' => 'explore'],
        ['title' => 'Notifications', 'icon' => 'bell', 'route' => 'notifications'],
        ['title' => 'Bookmarks', 'icon' => 'bookmark', 'route' => 'bookmarks'],
    ];

    if(auth()->check()) {
        $navigations[] = [
            'title' => 'Profile',
            'icon' => 'user-round',
            'route' => 'profile',
            'params' => ['user' => auth()->user()]
        ];
    } else {
        $navigations[] = [
            'title' => 'Profile',
            'icon' => 'user-round',
            'route' => 'login',
            'params' => [],
        ];
    }
@endphp

<div class="flex justify-center mt-5">
    <div class="flex w-60 flex-col gap-2">
        @foreach($navigations as $item)
            @php
                $isActive = request()->routeIs($item['route']);
            @endphp
            <a href="{{ route($item['route'], $item['params'] ?? []) }}"
                class="btn rounded-xl border-0 justify-start gap-5 {{ $isActive ? 'bg-black text-white' : 'btn-ghost hover:bg-black hover:text-white'}}">
                <x-dynamic-component :component="'lucide-' . $item['icon']" class="size-5"/>
                <span>{{ $item['title'] }}</span>
            </a>
        @endforeach
        <div class="mt-5">
            <a class="btn btn-primary rounded-xl w-full bg-amber-300 hover:bg-amber-500 text-black border-0 gap-2">
                <x-dynamic-component component="lucide-pencil" class="size-4"/>
                <span>Chirp</span>
            </a>
        </div>
        <div class="card bg-base-100 shadow mt-5">
            <div class="card-body">
                <h3 class="font-bold text-md">Make your feed yours!</h3>
                <p class="text-xs text-base-content/80">Follow people and topics you care about to personalize your timeline.</p>
            </div>
        </div>
    </div>
</div>