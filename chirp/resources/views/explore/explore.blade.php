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
            <x-explore.discover
                :chirpsToday="$chirpsToday"
                :trendingTopics="$trendingTopics"
            />
        </div>
        <aside class='p-4 bg-amber-400'>
            <div class='sticky top-20'>
                <x-explore.exploreRightSidebar />
            </div>
        </aside>
    </div>
</x-layout>