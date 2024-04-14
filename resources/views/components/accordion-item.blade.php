<div x-data="{ open: false }" class="border rounded mb-2">
    <!-- Accordion Header -->
    <div class="border-b">
        <button @click="open = !open" class="flex justify-between items-center w-full px-4 py-2 focus:outline-none">
            <span>{{ $title }}</span>
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
    <div x-show="open" class="p-4" x-data="{ tasks: {{ $tasks->toJson() }} }">
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
