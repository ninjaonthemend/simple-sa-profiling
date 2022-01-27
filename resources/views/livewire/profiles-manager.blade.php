<div wire:init="$set('load', true)">
    <div class="flex justify-between py-2">
        <div class="w-1/4">
            <x-jet-input type="search" id="search" wire:model="search" placeholder="Type to search ..." />
        </div>
        <div class="flex items-center justify-end sm:rounded-bl-md sm:rounded-br-md">
            <x-jet-action-message class="mr-3 text-green-600" on="created">
                {{ __('New profile added.') }}
            </x-jet-action-message>
            <x-jet-action-message class="mr-3 text-green-600" on="updated">
                {{ __('Profile updated.') }}
            </x-jet-action-message>
            <x-jet-action-message class="mr-3 text-green-600" on="deleted">
                {{ __('Profile deleted.') }}
            </x-jet-action-message>
            @can('create', App\Models\Profile::class)
                <x-jet-button wire:click="create">{{ __('Add New') }} Profile</x-jet-button>
            @endcan
        </div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mobile Number
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email Address
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Birth Date
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($profiles as $profile)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $profile->full_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            ID: <span class="font-semibold">{{ $profile->south_african_id_number }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $profile->mobile }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $profile->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ optional($profile->birth_date)->toDateString() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center space-x-4 text-sm">
                                            @can('update', $profile)
                                                <a href="#0" wire:click="edit({{ $profile->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            @endcan
                                            @can('delete', $profile)
                                                <a href="#0" wire:click="delete({{ $profile->id }})" class="text-rose-600 hover:text-rose-900">Delete</a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-center" colspan="5">
                                        <span wire:loading>Loading Records...</span>
                                        <span wire:loading.remove>No Records Found</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if (optional($profiles)->hasPages())
                            <tfoot class="bg-white">
                                <tr>
                                    <td class="px-6 py-3 whitespace-nowrap text-center" colspan="5">
                                        {{ optional($profiles)->links() }}
                                    </td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Create form -->
    <x-jet-dialog-modal wire:model="showForm">
        <x-slot name="title">
            {{ $mode === 'create' ? 'Add New Profile' : 'Edit Profile' }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="state.name" />
                    <x-jet-input-error for="state.name" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="surname" value="{{ __('Surname') }}" />
                    <x-jet-input id="surname" type="text" class="mt-1 block w-full" wire:model.lazy="state.surname" />
                    <x-jet-input-error for="state.surname" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="south_african_id_number" value="{{ __('South African ID Number') }}" />
                    <x-jet-input id="south_african_id_number" type="text" class="mt-1 block w-full" wire:model.lazy="state.south_african_id_number" />
                    <x-jet-input-error for="state.south_african_id_number" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="birth_date" value="{{ __('Birth Date') }}" />
                    <x-jet-input id="birth_date" type="date" class="mt-1 block w-full" wire:model.lazy="birthdate" />
                    <x-jet-input-error for="birthdate" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="mobile" value="{{ __('Mobile Number') }}" />
                    <x-jet-input id="mobile" type="text" class="mt-1 block w-full" wire:model.lazy="state.mobile" />
                    <x-jet-input-error for="state.mobile" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="email" value="{{ __('Email Address') }}" />
                    <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.lazy="state.email" />
                    <x-jet-input-error for="state.email" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <x-jet-label for="language" value="{{ __('Language') }}" />
                    <select wire:model="state.language_id" id="language" class="mt-1 block w-full form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value=""></option>
                        @foreach ($languages as $language)
                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="state.language_id" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <x-jet-label for="interests" value="{{ __('Interests') }}" />
                    <x-input-tags id="tags" class="mt-1 block w-full" wire:model="interests" />
                    <x-jet-input-error for="interests" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showForm', false)">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="submit" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    <!-- Delete confirmation pop up -->
    <x-jet-dialog-modal wire:model="showConfirmDeleteForm">
        <x-slot name="title">
            Delete Profile
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this profile?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showConfirmDeleteForm', false)">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="destroy" wire:loading.attr="disabled">
                Delete
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
