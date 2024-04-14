<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-md mx-auto">
                    <!-- Accordion Item 1 -->
                    <div x-data="{ open: false }"class="border rounded mb-2">
                        <!-- Accordion Header -->
                        <div class="border-b">
                        <button @click="open = !open" class="flex justify-between items-center w-full px-4 py-2 focus:outline-none">
                            <span>Tasks Today</span>
                            <svg x-show="!open" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="12" x2="6" y2="12"></line>
                            </svg>
                            <svg x-show="open" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="12" x2="6" y2="12"></line>
                            <line x1="12" y1="18" x2="12" y2="6"></line>
                            </svg>
                        </button>
                        </div>
                        <!-- Accordion Content (hidden by default) -->
                        <div x-show="open" class="p-4" x-data="{ tasks: {{ $today->toJson() }} }">
                            <ul>
                                <template x-for="(task, index) in tasks" :key="task.id">
                                <li>
                                    <input type="checkbox" x-model="task.completed" @click="markTaskDone(task.id)">
                                    <span x-text="task.title"></span>
                                </li>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <!-- Accordion Item 2 -->
                    <div x-data="{ open: false }" class="border rounded mb-2">
                        <!-- Accordion Header -->
                        <div class="border-b">
                        <button @click="open = !open" class="flex justify-between items-center w-full px-4 py-2 focus:outline-none">
                            <span>Tasks Tomorrow</span>
                            <svg x-show="!open" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="12" x2="6" y2="12"></line>
                            </svg>
                            <svg x-show="open" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="12" x2="6" y2="12"></line>
                            <line x1="12" y1="18" x2="12" y2="6"></line>
                            </svg>
                        </button>
                        </div>
                        <!-- Accordion Content (hidden by default) -->
                        <div x-show="open" class="p-4" x-data="{ tasks: {{ $tomorrow->toJson() }} }">
                            <ul>
                                <template x-for="(task, index) in tasks" :key="task.id">
                                <li>
                                    <input type="checkbox" x-model="task.completed" @click="markTaskDone(task.id)">
                                    <span x-text="task.title"></span>
                                </li>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <!-- Accordion Item 3 -->
                    <div x-data="{ open: false }" class="border rounded mb-2">
                        <!-- Accordion Header -->
                        <div class="border-b">
                        <button @click="open = !open" class="flex justify-between items-center w-full px-4 py-2 focus:outline-none">
                            <span>Tasks Next Week</span>
                            <svg x-show="!open" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="12" x2="6" y2="12"></line>
                            </svg>
                            <svg x-show="open" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="12" x2="6" y2="12"></line>
                            <line x1="12" y1="18" x2="12" y2="6"></line>
                            </svg>
                        </button>
                        </div>
                        <!-- Accordion Content (hidden by default) -->
                        <div x-show="open" class="p-4" x-data="{ tasks: {{ $nextWeek->toJson() }} }">
                            <ul>
                                <template x-for="(task, index) in tasks" :key="task.id">
                                <li>
                                    <input type="checkbox" x-model="task.completed" @click="markTaskDone(task.id)">
                                    <span x-text="task.title"></span>
                                </li>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <!-- Accordion Item 4 -->
                    <div x-data="{ open: false }" class="border rounded mb-2">
                        <!-- Accordion Header -->
                        <div class="border-b">
                        <button @click="open = !open" class="flex justify-between items-center w-full px-4 py-2 focus:outline-none">
                            <span>Tasks Near Future</span>
                            <svg x-show="!open" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="12" x2="6" y2="12"></line>
                            </svg>
                            <svg x-show="open" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="12" x2="6" y2="12"></line>
                            <line x1="12" y1="18" x2="12" y2="6"></line>
                            </svg>
                        </button>
                        </div>
                        <!-- Accordion Content (hidden by default) -->
                        <div x-show="open" class="p-4" x-data="{ tasks: {{ $nearFuture->toJson() }} }">
                            <ul>
                                <template x-for="(task, index) in tasks" :key="task.id">
                                <li>
                                    <input type="checkbox" x-model="task.completed" @click="markTaskDone(task.id)">
                                    <span x-text="task.title"></span>
                                </li>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <!-- Accordion Item 5 -->
                    <div x-data="{ open: false }" class="border rounded mb-2">
                        <!-- Accordion Header -->
                        <div class="border-b">
                        <button @click="open = !open" class="flex justify-between items-center w-full px-4 py-2 focus:outline-none">
                            <span>Tasks Far Future</span>
                            <svg x-show="!open" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="12" x2="6" y2="12"></line>
                            </svg>
                            <svg x-show="open" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="12" x2="6" y2="12"></line>
                            <line x1="12" y1="18" x2="12" y2="6"></line>
                            </svg>
                        </button>
                        </div>
                        <!-- Accordion Content (hidden by default) -->
                        <div x-show="open" class="p-4" x-data="{ tasks: {{ $farFuture->toJson() }} }">
                            <ul>
                                <template x-for="(task, index) in tasks" :key="task.id">
                                <li>
                                    <input type="checkbox" x-model="task.completed" @click="markTaskDone(task.id)">
                                    <span x-text="task.title"></span>
                                </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
