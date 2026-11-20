@section('page-title', 'Lessons')

<div>
    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">Lessons</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage lessons from YouTube</p>
        </div>
        <button wire:click="openCreate"
            class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-500/20 transition-all hover:bg-indigo-700 hover:shadow-lg active:scale-[0.98]">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            New Lesson
        </button>
    </div>

    {{-- Search --}}
    <div class="mb-6">
        <div class="relative max-w-sm">
            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search lessons..."
                class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder-slate-500" />
        </div>
    </div>

    {{-- Lessons Table --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-3.5 font-semibold text-slate-700 dark:text-slate-300">Lesson</th>
                        <th class="px-6 py-3.5 font-semibold text-slate-700 dark:text-slate-300">Category</th>
                        <th class="px-6 py-3.5 font-semibold text-slate-700 dark:text-slate-300">Playlist</th>
                        <th class="px-6 py-3.5 font-semibold text-slate-700 dark:text-slate-300">Tags</th>
                        <th class="px-6 py-3.5 font-semibold text-slate-700 dark:text-slate-300">Status</th>
                        <th class="px-6 py-3.5 text-right font-semibold text-slate-700 dark:text-slate-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($lessons as $lesson)
                        <tr wire:key="lesson-{{ $lesson->id }}" class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($lesson->image_url)
                                        <img src="{{ $lesson->image_url }}" alt="{{ $lesson->title }}"
                                            class="h-12 w-20 shrink-0 rounded-lg object-cover shadow-sm" />
                                    @else
                                        <div class="flex h-12 w-20 shrink-0 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800">
                                            <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0020.25 4.5H3.75A2.25 2.25 0 001.5 6.75v11.5A2.25 2.25 0 003.75 21z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="truncate font-medium text-slate-900 dark:text-white" title="{{ $lesson->title }}">{{ Str::limit($lesson->title, 40) }}</div>
                                        <div class="mt-0.5 flex items-center gap-2 text-xs text-slate-400">
                                            @if($lesson->youtube_url)
                                                <svg class="h-3.5 w-3.5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M23.5 6.2a3 3 0 0 0-2.1-2.2C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.2c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.2A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8Z"/>
                                                    <path fill="white" d="M9.5 15.6V8.4L15.8 12l-6.3 3.6Z"/>
                                                </svg>
                                            @endif
                                            @if($lesson->audio_url)
                                                <svg class="h-3.5 w-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                                                </svg>
                                            @endif
                                            @if($lesson->body)
                                                <svg class="h-3.5 w-3.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($lesson->category)
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                        {{ $lesson->category->name }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($lesson->playlist)
                                    <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-400">
                                        {{ $lesson->playlist->name }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($lesson->tags->take(3) as $tag)
                                        <span class="inline-flex items-center rounded-full bg-violet-50 px-2 py-0.5 text-[11px] font-medium text-violet-700 dark:bg-violet-500/10 dark:text-violet-400">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                    @if($lesson->tags->count() > 3)
                                        <span class="text-[11px] text-slate-400">+{{ $lesson->tags->count() - 3 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($lesson->is_public)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Public
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span> Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($confirmingDelete === $lesson->id)
                                    <div class="inline-flex items-center gap-2">
                                        <span class="text-xs text-red-600 dark:text-red-400">Delete?</span>
                                        <button wire:click="delete({{ $lesson->id }})"
                                            class="rounded-lg bg-red-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-red-700">Yes</button>
                                        <button wire:click="cancelDelete"
                                            class="rounded-lg bg-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-300 dark:bg-slate-700 dark:text-slate-300">No</button>
                                    </div>
                                @else
                                    <button wire:click="openEdit({{ $lesson->id }})"
                                        class="mr-2 rounded-lg p-2 text-slate-400 transition-colors hover:bg-slate-100 hover:text-indigo-600 dark:hover:bg-slate-800 dark:hover:text-indigo-400" title="Edit">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $lesson->id }})"
                                        class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-500/10 dark:hover:text-red-400" title="Delete">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                                <svg class="mx-auto mb-3 h-10 w-10 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                </svg>
                                No lessons found. Click "New Lesson" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($lessons->hasPages())
            <div class="border-t border-slate-200 px-6 py-4 dark:border-slate-800">
                {{ $lessons->links() }}
            </div>
        @endif
    </div>

    {{-- Full-screen Modal --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto bg-black/50 p-4 backdrop-blur-sm" x-transition>
            <div class="relative my-8 w-full max-w-4xl rounded-2xl border border-slate-200 bg-white shadow-2xl dark:border-slate-700 dark:bg-slate-900" @click.outside="$wire.set('showModal', false)">
                {{-- Modal Header --}}
                <div class="sticky top-0 z-10 flex items-center justify-between rounded-t-2xl border-b border-slate-200 bg-white/95 px-6 py-4 backdrop-blur-lg dark:border-slate-700 dark:bg-slate-900/95">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                        {{ $editingId ? 'Edit Lesson' : 'New Lesson' }}
                    </h3>
                    <button wire:click="$set('showModal', false)"
                        class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-slate-100 dark:hover:bg-slate-800">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit="save" class="p-6">
                    {{-- YouTube Fetch Section --}}
                    <div class="mb-6 rounded-xl border border-red-100 bg-red-50/50 p-4 dark:border-red-500/20 dark:bg-red-500/5">
                        <label class="mb-2 flex items-center gap-2 text-sm font-semibold text-red-700 dark:text-red-400">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.5 6.2a3 3 0 0 0-2.1-2.2C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.2c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.2A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8Z"/>
                                <path fill="white" d="M9.5 15.6V8.4L15.8 12l-6.3 3.6Z"/>
                            </svg>
                            Fetch from YouTube
                        </label>
                        <div class="flex gap-2">
                            <input wire:model="youtubeInput" type="text" placeholder="Paste YouTube URL or Video ID..."
                                class="flex-1 rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-400/20 dark:border-red-500/30 dark:bg-slate-800 dark:text-white" />
                            <button type="button" wire:click="fetchYoutube"
                                class="inline-flex items-center gap-2 rounded-xl bg-red-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition-all hover:bg-red-700 active:scale-[0.98]">
                                <span wire:loading.remove wire:target="fetchYoutube">Fetch</span>
                                <span wire:loading wire:target="fetchYoutube" class="inline-flex items-center gap-2">
                                    <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                    </svg>
                                    Fetching...
                                </span>
                            </button>
                        </div>
                        @if($youtubeError)
                            <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $youtubeError }}</p>
                        @endif
                    </div>

                    {{-- Tabs --}}
                    <div class="mb-6 flex gap-1 rounded-xl bg-slate-100 p-1 dark:bg-slate-800">
                        <button type="button" wire:click="$set('activeTab', 'info')"
                            class="flex-1 rounded-lg px-4 py-2 text-sm font-medium transition-colors {{ $activeTab === 'info' ? 'bg-white text-slate-900 shadow-sm dark:bg-slate-700 dark:text-white' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400' }}">
                            Info & Relations
                        </button>
                        <button type="button" wire:click="$set('activeTab', 'media')"
                            class="flex-1 rounded-lg px-4 py-2 text-sm font-medium transition-colors {{ $activeTab === 'media' ? 'bg-white text-slate-900 shadow-sm dark:bg-slate-700 dark:text-white' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400' }}">
                            Audio & File
                        </button>
                        <button type="button" wire:click="$set('activeTab', 'body')"
                            class="flex-1 rounded-lg px-4 py-2 text-sm font-medium transition-colors {{ $activeTab === 'body' ? 'bg-white text-slate-900 shadow-sm dark:bg-slate-700 dark:text-white' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400' }}">
                            Body (Lines)
                            @if(count($bodyLines))
                                <span class="ml-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-indigo-100 text-[10px] font-bold text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-400">{{ count($bodyLines) }}</span>
                            @endif
                        </button>
                    </div>

                    {{-- Tab: Info --}}
                    <div class="{{ $activeTab !== 'info' ? 'hidden' : '' }}">
                        <div class="grid gap-4 lg:grid-cols-2">
                            {{-- Left Column --}}
                            <div class="space-y-4">
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Title *</label>
                                    <input wire:model.live="title" type="text"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white" />
                                    @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Slug</label>
                                    <input wire:model="slug" type="text"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white" />
                                    @error('slug') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Description</label>
                                    <textarea wire:model="description" rows="4"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white"></textarea>
                                    @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Image URL</label>
                                    <input wire:model="image_url" type="url"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white" />
                                    @if($image_url)
                                        <img src="{{ $image_url }}" alt="Preview" class="mt-2 h-24 rounded-lg object-cover shadow-sm" />
                                    @endif
                                </div>
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">YouTube URL</label>
                                    <input wire:model="youtube_url" type="url"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white" />
                                </div>
                            </div>

                            {{-- Right Column: Relations --}}
                            <div class="space-y-4">
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Category</label>
                                    <select wire:model="category_id"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                                        <option value="">— No Category —</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Playlist</label>
                                    <select wire:model="playlist_id"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                                        <option value="">— No Playlist —</option>
                                        @foreach($playlists as $pl)
                                            <option value="{{ $pl->id }}">{{ $pl->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">Tags</label>
                                    <div class="max-h-48 space-y-2 overflow-y-auto rounded-xl border border-slate-200 bg-white p-3 dark:border-slate-700 dark:bg-slate-800">
                                        @forelse($tags as $tag)
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="checkbox" wire:model="selectedTags" value="{{ $tag->id }}"
                                                    class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 dark:border-slate-600 dark:bg-slate-700" />
                                                <span class="text-sm text-slate-700 dark:text-slate-300">{{ $tag->name }}</span>
                                            </label>
                                        @empty
                                            <p class="text-xs text-slate-400">No tags available. Create some first.</p>
                                        @endforelse
                                    </div>
                                </div>
                                <div>
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" wire:model="is_public"
                                            class="h-5 w-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 dark:border-slate-600 dark:bg-slate-700" />
                                        <div>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Public</span>
                                            <p class="text-xs text-slate-400">Make this lesson visible to users</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tab: Media --}}
                    <div class="{{ $activeTab !== 'media' ? 'hidden' : '' }}">
                        <div class="grid gap-6 lg:grid-cols-2">
                            {{-- Audio Upload --}}
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5 dark:border-slate-700 dark:bg-slate-800/50">
                                <h4 class="mb-3 flex items-center gap-2 text-sm font-semibold text-slate-900 dark:text-white">
                                    <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                                    </svg>
                                    Audio File
                                </h4>
                                @if($existingAudioUrl)
                                    <div class="mb-3 flex items-center gap-2 rounded-lg bg-emerald-50 px-3 py-2 text-xs text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Current: {{ basename($existingAudioUrl) }}</span>
                                    </div>
                                @endif
                                <input wire:model="audioFile" type="file" accept=".mp3,.wav,.ogg,.m4a"
                                    class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 dark:text-slate-400 dark:file:bg-indigo-500/10 dark:file:text-indigo-400" />
                                @error('audioFile') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                <div wire:loading wire:target="audioFile" class="mt-2 text-xs text-indigo-600">Uploading audio...</div>
                                <p class="mt-2 text-xs text-slate-400">Accepted: MP3, WAV, OGG, M4A (max 50MB)</p>
                            </div>

                            {{-- Text/Subtitle File Upload --}}
                            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5 dark:border-slate-700 dark:bg-slate-800/50">
                                <h4 class="mb-3 flex items-center gap-2 text-sm font-semibold text-slate-900 dark:text-white">
                                    <svg class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                    Text / Subtitle File
                                </h4>
                                @if($existingFileUrl)
                                    <div class="mb-3 flex items-center gap-2 rounded-lg bg-blue-50 px-3 py-2 text-xs text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">
                                        <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Current: {{ basename($existingFileUrl) }}</span>
                                    </div>
                                @endif
                                <input wire:model="textFile" type="file" accept=".txt,.srt,.vtt"
                                    class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 dark:text-slate-400 dark:file:bg-indigo-500/10 dark:file:text-indigo-400" />
                                @error('textFile') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                <div wire:loading wire:target="textFile" class="mt-2 text-xs text-indigo-600">Processing file...</div>
                                <p class="mt-2 text-xs text-slate-400">Accepted: TXT, SRT, VTT (max 5MB). Uploading will auto-generate body lines.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Tab: Body Lines --}}
                    <div class="{{ $activeTab !== 'body' ? 'hidden' : '' }}">
                        <div class="mb-4 flex items-center justify-between">
                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                Each line synced with timing from the audio. Upload an SRT/VTT file to auto-populate.
                            </p>
                            <button type="button" wire:click="addBodyLine"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700 transition-colors hover:bg-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-400 dark:hover:bg-indigo-500/20">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Add Line
                            </button>
                        </div>

                        @if(count($bodyLines) > 0)
                            <div class="space-y-3">
                                @foreach($bodyLines as $index => $line)
                                    <div wire:key="body-line-{{ $index }}" class="group flex items-start gap-3 rounded-xl border border-slate-200 bg-white p-3 transition-all hover:border-indigo-200 dark:border-slate-700 dark:bg-slate-800 dark:hover:border-indigo-500/30">
                                        <span class="mt-2 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-slate-100 text-[10px] font-bold text-slate-500 dark:bg-slate-700 dark:text-slate-400">
                                            {{ $index + 1 }}
                                        </span>
                                        <div class="flex flex-1 flex-wrap gap-2">
                                            <input wire:model="bodyLines.{{ $index }}.start" type="text" placeholder="Start (00:00:01.000)"
                                                class="w-36 rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 font-mono text-xs shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500/20 dark:border-slate-600 dark:bg-slate-700 dark:text-white" />
                                            <input wire:model="bodyLines.{{ $index }}.end" type="text" placeholder="End (00:00:05.000)"
                                                class="w-36 rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 font-mono text-xs shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500/20 dark:border-slate-600 dark:bg-slate-700 dark:text-white" />
                                            <input wire:model="bodyLines.{{ $index }}.text" type="text" placeholder="Text content..."
                                                class="min-w-0 flex-1 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500/20 dark:border-slate-600 dark:bg-slate-700 dark:text-white" />
                                        </div>
                                        <button type="button" wire:click="removeBodyLine({{ $index }})"
                                            class="mt-1 shrink-0 rounded-lg p-1.5 text-slate-400 opacity-0 transition-all hover:bg-red-50 hover:text-red-600 group-hover:opacity-100 dark:hover:bg-red-500/10 dark:hover:text-red-400">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="rounded-xl border border-dashed border-slate-300 p-8 text-center dark:border-slate-700">
                                <svg class="mx-auto mb-3 h-10 w-10 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                                <p class="text-sm text-slate-400">No body lines yet. Upload an SRT/VTT file or add lines manually.</p>
                            </div>
                        @endif
                    </div>

                    {{-- Submit --}}
                    <div class="mt-6 flex justify-end gap-3 border-t border-slate-200 pt-4 dark:border-slate-700">
                        <button type="button" wire:click="$set('showModal', false)"
                            class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-medium text-slate-700 transition-colors hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                            Cancel
                        </button>
                        <button type="submit"
                            class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-500/20 transition-all hover:bg-indigo-700 active:scale-[0.98]">
                            <span wire:loading.remove wire:target="save">{{ $editingId ? 'Update Lesson' : 'Create Lesson' }}</span>
                            <span wire:loading wire:target="save" class="inline-flex items-center gap-2">
                                <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                Saving...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
