<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        {{-- @if (auth()->user()) --}}
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-profile-information-form')
                    {{-- <form action="{{route('admin.update.profile')}}" method="POST">
                        <x-slot name="title">
                            {{ __('Profile Information') }}
                        </x-slot>
                    
                        <x-slot name="description">
                            {{ __('Update your account\'s profile information and email address.') }}
                        </x-slot>
                    
                        <x-slot name="form">                    
                            <!-- Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
                                <x-jet-input-error for="name" class="mt-2" />
                            </div>
                    
                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
                                <x-jet-input-error for="email" class="mt-2" />
                            </div>
                        </x-slot>
                    
                        <x-slot name="actions">
                            <x-jet-action-message class="mr-3" on="saved">
                                {{ __('Saved.') }}
                            </x-jet-action-message>
                    
                            <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                                {{ __('Save') }}
                            </x-jet-button>
                        </x-slot>
                    </form> --}}
                    
                </div>
                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            {{-- @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif --}}

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif 
        </div>
        {{-- @endif --}}
        
    </div>
</x-app-layout>
