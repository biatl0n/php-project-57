<x-app-layout>
    <x-section>
            <div class="grid col-span-full">
                <h1 class="mb-5 dark:text-white text-5xl">{{ __('task-status.change-status') }}</h1>
                {{ html()->modelForm($taskStatus->name, 'PATCH', route('task_statuses.update', $taskStatus->id))->class('w-50')->open() }}
                <x-div class="flex flex-col">
                    <x-div>
                        <x-input-label for="name" :value="__('translations.name')" />
                    </x-div>
                    <x-div class="mt-2">
                        <x-text-input id="name" name="name" :value="old('name', $taskStatus->name)" autofocus />
                        <x-input-error :messages="$errors->get('name')" />
                    </x-div>
                    <x-div class="mt-2">
                        <x-primary-button>{{ __('translations.update') }}</x-primary-button>
                    </x-div>
                </x-div>
                {{ html()->closeModelForm() }}
            </div>
    </x-section>
</x-app-layout>