@props(['user', 'profile'])

<dialog id="edit_profile_modal" class="modal">
    <div class="modal-box max-w-xl p-0">
    {{-- Header --}}
    <div class="flex items-center justify-between p-5">
        <h2 class="text-lg font-bold">Edit Profile</h2>
        <form method="dialog">
            <button class="btn btn-ghost btn-sm btn-circle">
                <x-lucide-x class="size-5"/>
            </button>
        </form>
    </div>
        <div class="border-b mx-5 border-gray-300"></div>
{{--        Form--}}
        <form
            method="POST"
{{--            action="{{ route('profile.update'), $user }}"--}}>
            @csrf
            @method('PATCH')

            <div class="p-5 space-y-4 max-h-[65vh] overflow-y-auto">
{{--                Bio --}}
                <div>
                    <label class="label text-xs font-bold" for="bio">Bio</label>
                    <textarea
                        id="bio"
                        name="bio"
                        class="textarea textarea-bordered w-full"
                        placeholder="Bio..."
                        maxlength="255"
                    >{{ old('bio', $profile->bio) }}</textarea>
                    @error('bio')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror
                </div>
{{--                Occupation--}}
                <div>
                    <label class="label text-xs font-bold" for="occupation">Occupation</label>
                    <input
                        id="occupation"
                        name="occupation"
                        type="text"
                        class="input input-bordered w-full"
                        placeholder="What is my job..."
                        value="{{ old('occupation', $profile->occupation) }}"
                    />
                    @error('occupation')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror
                </div>
{{--                Address--}}
                <div>
                    <label class="label text-xs font-bold" for="address">Location</label>
                    <input
                        id="address"
                        name="address"
                        type="text"
                        placeholder="ABC 123 street..."
                        class="input input-bordered w-full"
                        value="{{ old('address', $profile->address) }}"
                    />
                    @error('address')
                        <p class="text-error text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="border-b mx-5 border-gray-300"></div>
            <div class="flex justify-end gap-2 p-5">
                <button
                    type="button"
                    class="btn btn-ghost rounded-xl"
                    onclick="edit_profile_modal.close()">Cancel</button>
                <button
                    type="submit"
                    class="btn btn-primary rounded-xl hover:bg-black/70">Save Changes</button>
            </div>
        </form>
    </div>

    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
