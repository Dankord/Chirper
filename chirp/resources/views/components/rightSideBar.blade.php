@props(['suggestedUsers'])

<div class="flex justify-center mt-5">
    <div class="flex flex-col gap-3 w-80">
        <div class="shadow">
            <form method="POST" action="{{ route('home') }}">
                @csrf
                <div class="relative">
                    <x-lucide-search class="absolute left-3 top-1/2 size-5 -translate-y-1/2 text-gray-400" />
                    <input type="text"
                       name="search"
                       value='{{ request('search') }}'
                       placeholder="Search Chirper..."
                       class="bg-base-100 border-0 w-full rounded-xl p-2 pl-10"
                    />
                </div>
            </form>
        </div>
        <div class="card pt-5">
            <div class="card-body gap-0 bg-amber-200 rounded-xl shadow">
                <div class="flex justify-between items-center">
                    <h2 class="font-bold text-[16px]">Trending now</h2>
                    <span><x-lucide-sparkles class="size-4" /></span>
                </div>
                <p class="font-bold mt-3 m-0">#Formula1</p>
                <p class="text-xs text-base-content/60 m-0">12.4k chirps</p>
            </div>
        </div>
        {{-- Follow list --}}
        <div class="card pt-5">
            <div class="card-body bg-base-100 rounded-xl shadow">
                <div class="flex font-bold gap-2 items-center">
                    <span><x-lucide-users class="size-4" /></span>
                    <h2 class="text-[16px]">Who to follow</h2>
                </div>

                <div class="flex flex-col gap-4 mt-3">
                    @forelse($suggestedUsers as $suggestedUser)
                        <div class="flex items-center justify-between gap-2" wire:key="suggested-user-{{$suggestedUser->id}}">
                            <div class="flex pt-2">
                                <div class="avatar placeholder">
                                    <div class="size-10 rounded-full">
                                        <img src="https://avatars.laravel.cloud/{{ urlencode( $suggestedUser->email ) }}"
                                             alt="{{ $suggestedUser->name }} profile picture"
                                             class="rounded-full"
                                        />
                                    </div>
                                </div>
                                <div class="ml-2 min-w-0">
                                    <a href="{{ route('profile', $suggestedUser)}}" class="font-bold text-sm truncate block hover:underline">{{ $suggestedUser->name }}</a>
                                    <p class="text-xs text-base-content/60 truncate">{{ $suggestedUser->email ? '@' . explode('@', $suggestedUser->email)[0] : '@anon' }}</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route( 'users.follow', $suggestedUser ) }}" class="follow-form shrink-0">
                                @csrf
                                <button type="submit" class="follow-button btn btn-primary btn-sm rounded-3xl hover:bg-black/70" aria-pressed="false">
                                    <span class="follow-label">Follow</span>
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-sm text-base-content/70 py-2">
                            No new people to follow right now.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer footer-center pt-10 text-xs">
    <div>
        <p>@ {{date('Y')}} Chirper - Built with Laravel</p>
    </div>
</footer>