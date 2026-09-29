<x-layout>
    <x-slot:title>
        Homepage
    </x-slot:title>
    <div class="hidden md:grid md:grid-cols-[1fr_2fr_1fr] gap-4">
        <aside class="p-4 bg-blue-300">
            <div class="sticky top-20">
                <x-leftSidebar />
            </div>
        </aside>
        {{-- Timeline --}}
        <div class="max-w-3xl w-full mx-auto bg-red-300">
            <x-timeline :chirps="$chirps"/>
        </div>
        <aside class='p-4 bg-green-300'>
            <div class="sticky top-20">
                {{-- right-sidebar --}}
            </div>
        </aside>
    </div>
</x-layout>