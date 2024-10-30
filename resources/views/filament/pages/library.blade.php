<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            User details
        </x-slot>

        <x-slot name="description">
            This is all the information we hold about the user.
        </x-slot>

        @livewire('list-media')
    </x-filament::section>
</x-filament-panels::page>
