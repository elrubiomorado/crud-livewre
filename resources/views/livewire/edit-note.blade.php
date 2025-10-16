<div>
    <flux:modal name="edit-note" class="md:w-900">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update Note</flux:heading>
                <flux:text class="mt-2">Update your Note.</flux:text>
            </div>

            <flux:input label="Title" placeholder="Update the title" wire:model='title'/>
            <flux:textarea label="Content" placeholder="Enter Note Content" wire:model='content'/>

            

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click='update'>Update changes</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
