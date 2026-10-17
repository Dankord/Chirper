<div class="pt-4">
    <form method="GET" action="{{ route('explore') }}>
        <div class="relative">
        <x-lucide-search class="absolute size-4 left-3 top-1/2 -translate-y-1/2 text-base-content/50" />
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search topics, people, or chirps"
            class="bg-base-100 border-none w-full rounded-xl pl-10 p-2 shadow text-sm"
        />
        </div>
    </form>
</div>