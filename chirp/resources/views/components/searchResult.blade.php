@props(['search', 'chirps', 'users','likedChirpsIds'])

<div class="py-5">
    <h1 class="text-3xl font-semibold ">Search Results</h1>
    <p class="text-sm text-base-content/60">
        Search result for "{{ $search }}"
    </p>
</div>

<div class="card bg-base-100 shadow rounded-xl mb-5">
    <div class="card-body">
        <h2 class="font-bold text-xl">People</h2>
        @forelse($users as $user)
            <div class="flex items-center justify-between gap-2" wire-key="suggested-user-{{$user->id}}">
                <div class="flex pt-2">
                    <div class="avatar placeholder">
                        <div class="size-10 rounded full">
                            <img src="https://avatars.laravel.cloud/{{ urlencode( $user->email ) }}"
                                alt="{{ $user->name }} profile picture"
                                class="rounded-full"
                            />
                        </div>
                    </div>
                    <div class="ml-2 min-w-0">
                        <a href="{{ route('profile', $user) }}" class="font-bold text-sm truncate black hover:underline">{{ $user->name }}</a>
                        <p class="text-xs text-base-content/60 truncate">{{ $user->email ? '@' . explode('@', $user->email)[0] : '@anon' }}</p>
                    </div>
                </div>
                @php
                    $isFollowing = auth()->check()
                                && auth()->user()->following()
                                   ->whereKey($user->id)
                                   ->exists();
                @endphp
                <form method="POST" action="{{ route('users.follow', $user) }}" class="follow-form shrink-0">
                    @csrf
                    <button type="submit" class="follow-button btn btn-sm rounded-3xl {{ $isFollowing ? 'btn-ghost hover:bg-base-200' : 'btn-primary hover:bg-black/70'}}" aria-pressed="{{ $isFollowing ? 'true' : 'false'}}">
                        <span class="follow-label">{{ $isFollowing ? 'Following' : 'Follow'}}</span>
                    </button>
                </form>
            </div>
        @empty
            <p class="text-sm text-base-content/60">
                No matching people found.
            </p>
        @endforelse
    </div>
</div>

<div class="space-y-4 pt-5">
    @forelse($chirps as $chirp)
        <x-chirp
            :chirp="$chirp"
            :likedChirpsIds="$likedChirpsIds"
        />
    @empty
    <div class="hero py-12">
        <div class="hero-content text-center">
            <h2 class="text-3xl text-base-content/50">No similar Chirp has been said!</h2>
        </div>
    </div>
    @endforelse
</div>
