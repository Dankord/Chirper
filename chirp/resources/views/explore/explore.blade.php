<x-layout>
    <x-slot:title>
        Explore
    </x-slot:title>
    <div class="hidden md:grid md:grid-cols-[1fr_2fr_1fr] gap-4">
        <aside class='p-4'>
            <div class='sticky top-20'>
                <x-leftSideBar />
            </div>
        </aside>
        <div class="max-w-3xl w-full mx-auto">
            <div class="flex justify-start pb-2">
                <a href="{{ route('home')}}" class="btn btn-ghost flex items-center p-0 gap-2 text-xs text-base-content/50 px-1"><x-lucide-move-left class="size-4" />Back to timeline</a>
            </div>
            <h3 class="text-md text-base-content/50">Discover something New</h3>
            <h1 class='text-3xl font-extrabold'>Explore</h1>
            <x-explore.searchBar />
            @if (request()->filled('search'))
                <x-searchResult />
            @else
                <x-explore.discover
                    :chirpsToday="$chirpsToday"
                    :trendingTopics="$trendingTopics"
                />
            @endif
        </div>
        <aside class='p-4'>
            <div class='sticky top-20'>
                <x-explore.exploreRightSidebar />
            </div>
        </aside>
    </div>
</x-layout>