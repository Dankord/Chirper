@props(['user', 'profile'])

<dialog id="edit_profile_modal" class="modal">
    <div class="modal-box max-w-xl p-0">
    {{-- Header --}}
    <div class="flex items-center justify-between p-5 border-b">
        <h2 class="text-lg font-bold">Edit Profile</h2>
        <form method="dialog">
            <button class="btn btn-ghost btn-sm btn-circle"><x-lucide-x class="size-5"/></button>
        </form>
    </div>
    </div>
</dialog>