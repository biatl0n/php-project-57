<x-app-layout>
    <x-section>
        <div class="grid col-span-full">
            <h1 class="mb-5 dark:text-white text-5xl">{{ __('labels.create-label') }}</h1>
            {{ html()->modelForm($label->name, 'POST', route('labels.store'))->class('w-50')->open() }}
            <x-div class="flex flex-col">
                <x-div>
                    <x-input-label for="name" :value="__('translations.name')" />
                </x-div>
                <x-div class="mt-2">
                    <x-text-input id="name" name="name" :value="old('name', $label->name)" autofocus />
                    <x-input-error :messages="$errors->get('name')"/>
                </x-div>
                <x-div>
                    <x-input-label for="description" :value="__('translations.description')" />
                </x-div>
                <x-div class="mt-2">
                    <x-textarea name="description" id="description" :value="old('description', $label->description)" />
                </x-div>
                <x-div class="mt-2">
                    <x-primary-button>{{ __('labels.create') }}</x-primary-button>
                </x-div>
            </x-div>
        </div>
    </x-section>
</x-app-layout>