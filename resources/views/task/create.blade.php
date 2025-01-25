<x-app-layout>
    <x-section>
            <div class="grid col-span-full">
                <h1 class="mb-5 dark:text-white text-5xl">{{ __('task.create-task') }}</h1>
                {{ html()->modelForm($task->name, 'POST', route('tasks.store'))->class('w-50')->open() }}
                    <x-div class="mt-2">
                        <x-input-label for="name" :value="__('translations.name')" />
                    </x-div>
                    <x-div>
                        <x-text-input id="name" name="name" type="text" :value="old('name', $task->name)" autofocus />
                        <x-input-error :messages="$errors->get('name')" />
                    </x-div>

                    <x-div class="mt-2">
                        <x-input-label for="description" :value="__('translations.description')" />
                    </x-div>
                    <x-div>
                        <x-textarea name="description" id="description" :value="old('description', $task->description)" />
                    </x-div>

                    <x-div>
                        <x-input-label for="status_id" :value="__('translations.status')" />
                    </x-div>
                    <x-div>
                        <x-select id="status_id" name="status_id" :items="$taskStatuses" :value="old('status_id', $task->status_id)" />
                        <x-input-error :messages="$errors->get('status_id')" />
                    </x-div>

                    <x-div class="mt-2">
                        <x-input-label for="assigned_to_id" :value="__('translations.executor')" />
                    </x-div>
                    <x-div>
                        <x-select id="assigned_to_id" name="assigned_to_id" :items="$taskExecutors" :value="old('assigned_to_id', $task->assigned_to_id)" />
                        <x-input-error :messages="$errors->get('assigned_to_id')" />
                    </x-div>

                    <x-div class="mt-4">
                        <x-primary-button>
                            {{ __('translations.create') }}
                        </x-primary-button>
                    </x-div>
                {{ html()->closeModelForm() }}
            </div>
    </x-section>
</x-app-layout>