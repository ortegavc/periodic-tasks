<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Task Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Fill out the task information.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('tasks.store') }}" class="mt-6 space-y-6" x-data="{ period: 'once' }">
                            @csrf

                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" required autofocus autocomplete="description" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div class="flex gap-4">
                                <div class="w-full">
                                    <x-input-label for="group" :value="__('Group')" />
                                    <select x-model="group" name="group_id" id="group" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="">No group</option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('group')" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="period" :value="__('Repeat')" />
                                    <select x-model="period" name="period" id="period" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        @foreach ($periods as $value => $text)
                                            <option value="{{ $value }}">{{ $text }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('period')" />
                                </div>
                            </div>

                            <template x-if="period == 'once'">
                                <div>
                                    <x-input-label for="due_date" :value="__('Due date')" />
                                    <x-date-input id="due_date" name="due_date" type="text" class="mt-1 block w-full" :value="old('due_date')" autofocus autocomplete="due_date" />
                                    <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
                                </div>
                            </template>

                            <template x-if="period != 'once'">
                                <div class="flex gap-4">
                                    <div class="w-full">
                                        <x-input-label for="start_date" :value="__('Start date')" />
                                        <x-date-input id="start_date" name="start_date" type="text" class="mt-1 block w-full" :value="old('start_date')" autofocus autocomplete="start_date" />
                                        <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="end_date" :value="__('End date')" />
                                        <x-date-input id="end_date" name="end_date" type="text" class="mt-1 block w-full" :value="old('end_date')" autofocus autocomplete="end_date" />
                                        <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                                    </div>
                                </div>
                            </template>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
