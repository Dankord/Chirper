<x-layout>
    <x:slot:title>
        Profile
    </x:slot:title>
    <div class="max-w-4xl mx-auto">
        <div class=" flex justify-start pb-2">
            <a href="{{ route('home') }}" class="btn btn-ghost flex items-center text-xs text-base-content/60"><x-lucide-move-left class="size-4"/>Back to timeline</a>
        </div>
        <div class="relative">
            <div class="h-48 bg-black rounded-t-2xl -bottom-16">
                {{-- Img banner --}}
            </div>
            <div class="absolute left-8 -bottom-16">
                <img
                    src="https://avatars.laravel.cloud/{{ urlencode(Auth::user()->email) }}"
                    alt="{{ Auth::user()->name }}"
                    class="w-32 h-32 rounded-full border-4 border-base-100 object-cover"
                />
            </div>
        </div>
        {{-- Information --}}
        <div class="pt-18 px-8 pb-6 text-start bg-base-100">
            <div class="">
                <h1 class="font-bold text-2xl leading-none">{{ Auth::user()->name }}</h1>
                <span class="pt-0 text-xs text-base-content/50">{{ Auth::user() ? '@' . explode('@', Auth::user()->email)[0] : "@Anon"}}</span>
                {{-- Add some informaiton here would you --}}
            </div>
        </div>

        {{-- Chirpers --}}
        <div class="mt-8 space-y-4">
            @forelse($chirps as $chirp)
            <x-Chirp
                :chirp="$chirp"
                :liked-chirp-ids="$likedChirpIds"
            />
            @empty
                <div class="hero p-y-12">
                    <div class="hero-content text-center">
                        <div>
                            <svg class="mx-auto h-12 w-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="mt-4 text-base-content/60">No chirps yet. Be the first to chirp!</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>