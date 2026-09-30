<x-layout>
    <x-slot:title>
        Homepage
    </x-slot:title>
    <div class="hidden md:grid md:grid-cols-[1fr_2fr_1fr] gap-4">
        <aside class="p-4">
            <div class="sticky top-20">
                <x-leftSidebar />
            </div>
        </aside>
        {{-- Timeline --}}
        <div class="max-w-3xl w-full mx-auto">
            <x-timeline :chirps="$chirps"/>
        </div>
        <aside class='p-4 bg-green-300'>
            <div class="sticky top-20">
                <x-rightSideBar />
            </div>
        </aside>
    </div>
</x-layout>