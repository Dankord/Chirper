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
            </div>
        </div>
    </div>
</x-layout>