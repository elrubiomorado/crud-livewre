<div class="relative mb-6 w-full">

    {{-- create-note heading --}}
    <flux:heading size="xl" level="1">{{ __('Notes') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage your notes') }}</flux:subheading>
    <flux:separator variant="subtle" />

    {{-- create-note button --}}
    <flux:modal.trigger name="create-note">
        <flux:button class="mt-4">Create Note</flux:button>
    </flux:modal.trigger>

    {{-- session message --}}
    @session('success')
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false }, 3000)"
            class="fixed top-5 right-5 bg-green-600 text-white text-sm p-4 rounded-lg shadow-lg z-50" role="alert">
            <p>
                {{ $value }}
            </p>
        </div>
    @endsession
    {{-- create-note modal Component --}}
    <livewire:create-note />
    {{-- edit-note modal Component --}}
    <livewire:edit-note />


    {{-- notes table here --}}
    <table class="table-auto w-full bg-slate-800 shadow-md rounded-md mt-5 overflow-hidden">
        <thead class="bg-slate-900 text-slate-100">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-sm font-semibold tracking-wider">Content</th>
                <th class="px-6 py-3 text-center text-sm font-semibold tracking-wider">Edit/Delete</th>
            </tr>
        </thead>
        <tbody>
            {{-- for to array --}}
            @forelse ($notes as $note)
                <tr class="border-t border-slate-700 hover:bg-slate-700/30 transition-colors">
                    <td class="px-6 py-4 text-slate-100">{{ $note->title }}</td>
                    <td class="px-6 py-4 text-slate-100">{{ $note->content }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <flux:button wire:click="edit({{ $note->id }})">Edit</flux:button>
                        <flux:button variant="danger" wire:click="delete({{ $note->id }})">Delete</flux:button>
                    </td>
                </tr>
                {{-- if array empty --}}
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-slate-400 italic">
                        No notes yet!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{-- Links to array --}}
    <div class="mt-4">
        {{ $notes->links() }}
    </div>

    {{-- delete --}}
    <flux:modal name="delete-note" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Note?</flux:heading>

                <flux:text class="mt-2">
                    You're about to delete this Note.<br>
                    This action cannot be reversed.
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="deleteNote()">Delete Note</flux:button>
            </div>
        </div>
    </flux:modal>

</div>
