@props(['chirpsToday', 'trendingTopics'])

<div class="card pt-5">
    <div class="card-body shadow gap-0 p-0 border rounded-xl">
        <div class="bg-amber-300 px-5 py-4 rounded-t-xl">
            <h3 class="text-sm font-mono">TODAY ON CHIRPER</h3>
            <h1 class="text-xl font-bold font-mono">The Conversation people are joining</h1>
        </div>
        <div class="flex justify-between px-10 py-4">
            <div>
                <h1 class="font-bold text-2xl">{{ $chirpsToday }}</h1>
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
    <div class="card-body shadow gap-0 bg-base-100 rounded-xl">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-base-content/50 text-xs">POPULAR RIGHT NOW</h3>
                <h1 class="font-extrabold text-2xl">Trending Topics</h1>
            </div>
            <div>
            <a href="{{ url()->current() }}" class="font-bold hover:underline">Refresh</a>
            </div>
        </div>
        <div class="grid grid-cols-2 pt-4 gap-4">
        @forelse($trendingTopics as $topic)
            <x-statCard
                :number="sprintf('%02d', $loop->iteration)"
                :title="$topic['title']"
                :value="$topic['value']"
            />
        @empty
            <div class="flex text-center justify-center">
                <h1 class="text-sm text-base-content/60">No trending topics yet.</h1>
            </div>
        @endforelse
        </div>
    </div>
</div>