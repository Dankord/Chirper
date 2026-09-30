<div class="flex justify-center mt-5">
    <div class="flex flex-col gap-3 w-80">
        <div class="">
            <form method="POST" action="/search">
                @csrf
                <div class="relative">
                    <x-lucide-search class="absolute left-3 top-1/2 size-5 -translate-y-1/2 text-gray-400" />
                    <input type="text"
                       name="search"
                       placeholder="Search Chirper..."
                       class="bg-base-100 border-0 w-full rounded-xl p-2 pl-10"
                    />
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-body gap-0 bg-amber-200 rounded-xl">
                <div class="flex justify-between items-center">
                    <h2 class="font-bold text-[16px]">Trending now</h2>
                    <span><x-lucide-sparkles class="size-4" /></span>
                </div>
                <p class="font-bold mt-3 m-0">#Formula1</p>
                <p class="text-xs text-base-content/60 m-0">12.4k chirps</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body bg-base-100 rounded-xl">
                <div class="flex font-bold gap-2 items-center">
                    <span><x-lucide-users class="size-4" /></span>
                    <h2 class="text-[16px]">Who to follow</h2>
                    {{-- Make the follow avatar, img, name email and follow button --}}
                </div>
            </div>
        </div>
    </div>
</div>