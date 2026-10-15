<h3 class="text-md text-base-content/50">Discover something New</h3>
<h1 class='text-3xl font-extrabold'>Explore</h1>

{{-- Search function --}}
<div class="pt-5">
    <form method="POST" action="/search">
        @csrf
        <div class="relative">
        <x-lucide-search class="absolute size-4 left-3 top-1/2 -translate-y-1/2 text-base-content/50" />
        <input
            type="text"
            name="search"
            placeholder="Search topics, people, or chirps"
            class="bg-base-100 border-none w-full rounded-xl pl-10 p-2 shadow text-sm"
        />
        </div>
    </form>
</div>
{{-- Statistics --}}
<div class="card pt-5">
    <div class="card-body shadow gap-0 p-0 border rounded-xl">
        <div class="bg-amber-300 px-5 py-4 rounded-t-xl">
            <h3 class="text-sm font-mono">TODAY ON CHIRPER</h3>
            <h1 class="text-xl font-bold font-mono">The Conversation people are joining</h1>
        </div>
        <div class="flex justify-between px-10 py-4">
            <div>
                <h1 class="font-bold text-2xl">3.8k</h1>
                <h3 class="text-xs text-base-content/60">New Chirps today</h3>
            </div>
            <div>
                <h1 class="font-bold text-2xl">4,106</h1>
                <h3 class="text-xs text-base-content/60">Active Community</h3>
            </div>
            <div>
                <h1 class="font-bold text-2xl">92%</h1>
                <h3 class="text-xs text-base-content/60">Kind conversation</h3>
            </div>
        </div>
    </div>
</div>
{{-- Topic card --}}
<div class="card pt-5">
    <div class="card-body shadow gap-0">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-base-content/50 text-xs">POPULAR RIGHT NOW</h3>
                <h1 class="font-extrabold text-2xl">Trending Topics</h1>
            </div>
            <div>
            <a href="#" class="font-bold hover:underline">Refresh</a>
            </div>
        </div>
        <div class="grid grid-cols-2 pt-4 gap-4">
            <x-statCard
                number="01"
                title="Formula1"
                value="12.3k"
            />
            <x-statCard
                number="02"
                title="Laravel"
                value="4,485"
            />
            <x-statCard
                number="03"
                title="GRIPPI"
                value="12.5k"
            />
            <x-statCard
                number="04"
                title="BOMBACLAT"
                value="1,459"
            />
        </div>
    </div>
</div>