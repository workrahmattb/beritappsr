<div class="space-y-6">

    {{-- Flash Messages --}}
    @if (session('message'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 shadow-sm dark:border-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
            {{ session('message') }}
        </div>
    @endif

    {{-- Page Header --}}
    <div class="rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4 shadow-lg">
        <h1 class="text-xl font-bold text-white">{{ __('Kelola Artikel Berita') }}</h1>
        <p class="mt-1 text-sm text-emerald-100">Buat, edit, dan kelola semua artikel dengan rich text editor</p>
    </div>

    {{-- Search & Filter --}}
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[200px]">
            <flux:input
                wire:model.live.debounce.300ms="search"
                icon="magnifying-glass"
                placeholder="Cari artikel..."
            />
        </div>
        <flux:select wire:model.live="statusFilter" class="w-48">
            <flux:select.option value="all">Semua</flux:select.option>
            <flux:select.option value="draft">Draft</flux:select.option>
            <flux:select.option value="published">Published</flux:select.option>
            <flux:select.option value="archived">Archived</flux:select.option>
        </flux:select>
    </div>

    {{-- Form --}}
    @if ($showForm || $editingId)
        <div x-data="richEditor(@js($content))" wire:key="editor-{{ $editingId ?? 'new' }}" class="rounded-2xl bg-white p-6 shadow-lg dark:bg-neutral-900 space-y-4">

            {{-- Hidden textarea for Livewire sync (must be outside wire:ignore) --}}
            <textarea id="editor-content-hidden" wire:model.defer="content" class="hidden"></textarea>

            {{-- Form Header --}}
            <div class="flex items-center justify-between">
                <flux:heading size="lg" class="text-emerald-700 dark:text-emerald-400">
                    {{ $editingId ? 'Edit Berita' : $pageTitle }}
                </flux:heading>
                <flux:button variant="ghost" wire:click="resetForm">Batal</flux:button>
            </div>

            {{-- Section: Basic Info --}}
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-700">
                <button type="button" wire:click="toggleSection('showBasic')"
                        class="w-full flex items-center gap-2 px-4 py-3 text-sm font-semibold text-emerald-700 dark:text-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10 transition-colors">
                    <svg class="w-4 h-4 transition-transform {{ $showBasic ? 'rotate-90' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    {{ __('Info Dasar') }}
                </button>
                @if ($showBasic)
                    <div class="px-4 pb-4 space-y-4">
                        <flux:input
                            wire:model.defer="title"
                            wire:blur="generateSlug"
                            label="Judul *"
                            placeholder="Masukkan judul artikel"
                        />

                        <flux:input
                            wire:model.defer="slug"
                            label="Slug *"
                            placeholder="otomatis-dari-judul"
                        />

                        <flux:textarea
                            wire:model.defer="summary"
                            label="Ringkasan (opsional)"
                            placeholder="Ringkasan singkat artikel"
                            :rows="3"
                        />

                    </div>
                @endif
            </div>

            {{-- Section: Content Editor --}}
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden" wire:ignore>
                <div class="px-4 py-3 text-sm font-semibold text-emerald-700 dark:text-emerald-400 flex items-center gap-2 bg-emerald-50 dark:bg-emerald-900/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    {{ __('Konten Artikel') }} <span class="text-red-500">*</span>
                </div>

                {{-- Editor Toolbar --}}
                <div class="flex flex-wrap items-center gap-1 px-3 py-2 bg-zinc-50 dark:bg-zinc-800 border-t border-b border-zinc-200 dark:border-zinc-700">
                    <button type="button" x-on:click="toggleBold()" x-bind:class="{ 'bg-emerald-200 dark:bg-emerald-800': isActive('bold') }" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors" title="Bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12h8a4 4 0 000-8H6z"/></svg>
                    </button>
                    <button type="button" x-on:click="toggleItalic()" x-bind:class="{ 'bg-emerald-200 dark:bg-emerald-800': isActive('italic') }" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors" title="Italic">
                        <svg class="w-4 h-4 italic" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="14" y1="4" x2="10" y2="20" stroke-linecap="round"/></svg>
                    </button>
                    <button type="button" x-on:click="toggleUnderline()" x-bind:class="{ 'bg-emerald-200 dark:bg-emerald-800': isActive('underline') }" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors" title="Underline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 3v7a6 6 0 006 6 6 6 0 006-6V3 m-1 19H13" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <button type="button" x-on:click="toggleStrike()" x-bind:class="{ 'bg-emerald-200 dark:bg-emerald-800': isActive('strike') }" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors" title="Strikethrough">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7H9" stroke-linecap="round"/><line x1="4" y1="12" x2="20" y2="12" stroke-linecap="round"/></svg>
                    </button>
                    <div class="w-px h-5 bg-zinc-300 dark:bg-zinc-600 mx-1"></div>
                    <button type="button" x-on:click="setHeading(1)" x-bind:class="{ 'bg-emerald-200 dark:bg-emerald-800': isActive('heading', { level: 1 }) }" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors text-xs font-bold" title="Heading 1">H1</button>
                    <button type="button" x-on:click="setHeading(2)" x-bind:class="{ 'bg-emerald-200 dark:bg-emerald-800': isActive('heading', { level: 2 }) }" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors text-xs font-bold" title="Heading 2">H2</button>
                    <button type="button" x-on:click="setHeading(3)" x-bind:class="{ 'bg-emerald-200 dark:bg-emerald-800': isActive('heading', { level: 3 }) }" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors text-xs font-bold" title="Heading 3">H3</button>
                    <div class="w-px h-5 bg-zinc-300 dark:bg-zinc-600 mx-1"></div>
                    <button type="button" x-on:click="toggleBulletList()" x-bind:class="{ 'bg-emerald-200 dark:bg-emerald-800': isActive('bulletList') }" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors" title="Bullet List">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M8 6h13 m-13 6h13 m-13 6h13 M3 6h.01 M3 12h.01 M3 18h.01"/></svg>
                    </button>
                    <button type="button" x-on:click="toggleOrderedList()" x-bind:class="{ 'bg-emerald-200 dark:bg-emerald-800': isActive('orderedList') }" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors" title="Numbered List">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M10 6h11 m-11 6h11 m-11 6h11 M3 6l2 2m2-4l-2 2 M4 14h6"/></svg>
                    </button>
                    <button type="button" x-on:click="toggleBlockquote()" x-bind:class="{ 'bg-emerald-200 dark:bg-emerald-800': isActive('blockquote') }" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors" title="Blockquote">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/></svg>
                    </button>
                    <button type="button" x-on:click="toggleCodeBlock()" x-bind:class="{ 'bg-emerald-200 dark:bg-emerald-800': isActive('codeBlock') }" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors" title="Code Block">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </button>
                    <button type="button" x-on:click="toggleHorizontalRule()" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors" title="Horizontal Rule">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="12" x2="21" y2="12" stroke-linecap="round"/></svg>
                    </button>
                    <div class="w-px h-5 bg-zinc-300 dark:bg-zinc-600 mx-1"></div>
                    <button type="button" x-on:click="insertImageDialog()" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors text-emerald-600 dark:text-emerald-400" title="Insert Image">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </button>
                    <button type="button" x-on:click="insertLinkDialog()" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors text-teal-600 dark:text-teal-400" title="Insert Link">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </button>
                    <div class="flex-shrink-0 ml-auto w-px h-5 bg-zinc-300 dark:bg-zinc-600 mr-1"></div>
                    <button type="button" x-on:click="undo()" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors" title="Undo">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 016.32 3.13M3 10l5-5m-5 5l5 5"/></svg>
                    </button>
                    <button type="button" x-on:click="redo()" class="p-1.5 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors" title="Redo">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 10H11a8 8 0 00-6.32 3.13M21 10l-5-5m5 5l-5 5"/></svg>
                    </button>
                </div>

                {{-- Tiptap Editor Container --}}
                <div x-ref="editorEl" class="min-h-[350px] p-4 prose prose-sm dark:prose-invert max-w-none prose-a:text-emerald-600 dark:prose-a:text-emerald-400"></div>
            </div>

            {{-- Section: Media --}}
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-700">
                <button type="button" wire:click="toggleSection('showMedia')"
                        class="w-full flex items-center gap-2 px-4 py-3 text-sm font-semibold text-emerald-700 dark:text-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10 transition-colors">
                    <svg class="w-4 h-4 transition-transform {{ $showMedia ? 'rotate-90' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    {{ __('Media') }}
                </button>
                @if ($showMedia)
                    <div class="px-4 pb-4 space-y-4">
                        <flux:input
                            wire:model.defer="image"
                            label="Featured Image URL"
                            placeholder="https://example.com/featured-image.jpg"
                        />
                        <flux:input
                            wire:model.defer="ogImage"
                            label="OG Image URL"
                            placeholder="https://example.com/social-media-image.jpg"
                        />
                        <p class="text-xs text-zinc-400">Tips: Untuk gambar di dalam artikel, klik tombol gambar di toolbar editor.</p>
                    </div>
                @endif
            </div>

            {{-- Section: Status & Schedule --}}
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-700">
                <button type="button" wire:click="toggleSection('showStatus')"
                        class="w-full flex items-center gap-2 px-4 py-3 text-sm font-semibold text-emerald-700 dark:text-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10 transition-colors">
                    <svg class="w-4 h-4 transition-transform {{ $showStatus ? 'rotate-90' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    {{ __('Status & Jadwal Publikasi') }}
                </button>
                @if ($showStatus)
                    <div class="px-4 pb-4 space-y-4">
                        <flux:select wire:model.defer="status" label="Status">
                            <flux:select.option value="draft">Draft</flux:select.option>
                            <flux:select.option value="published">Published</flux:select.option>
                            <flux:select.option value="archived">Archived</flux:select.option>
                        </flux:select>
                        <flux:input
                            wire:model.defer="scheduledAt"
                            type="datetime-local"
                            label="Jadwal Publikasi (opsional)"
                            placeholder="YYYY-MM-DD HH:MM"
                        />
                        <p class="text-xs text-zinc-400">Artikel akan otomatis dipublikasikan pada waktu yang ditentukan.</p>
                    </div>
                @endif
            </div>

            {{-- Section: SEO Settings --}}
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-700">
                <button type="button" wire:click="toggleSection('showSeo')"
                        class="w-full flex items-center gap-2 px-4 py-3 text-sm font-semibold text-emerald-700 dark:text-emerald-400 hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10 transition-colors">
                    <svg class="w-4 h-4 transition-transform {{ $showSeo ? 'rotate-90' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    {{ __('SEO Settings') }}
                </button>
                @if ($showSeo)
                    <div class="px-4 pb-4 space-y-4">
                        <flux:input
                            wire:model.defer="focusKeyword"
                            label="Focus Keyword"
                            placeholder="Kata kunci utama untuk SEO"
                        />
                        <div>
                            <flux:input
                                wire:model.defer="metaTitle"
                                label="Meta Title"
                                placeholder="Judul untuk mesin pencari (max 60 karakter)"
                            />
                            <p class="text-xs text-zinc-400 mt-1">{{ strlen($metaTitle ?? '') }}/60 karakter</p>
                        </div>
                        <div>
                            <flux:textarea
                                wire:model.defer="metaDescription"
                                label="Meta Description"
                                placeholder="Deskripsi untuk mesin pencari (max 160 karakter)"
                                :rows="3"
                            />
                            <p class="text-xs text-zinc-400 mt-1">{{ strlen($metaDescription ?? '') }}/160 karakter</p>
                        </div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 bg-zinc-50 dark:bg-zinc-800 rounded-lg p-3">
                            Preview di Google:<br>
                            @if ($metaTitle)
                                <span class="text-blue-600 font-medium">{{ $metaTitle }}</span><br>
                            @else
                                <span class="text-blue-600 font-medium">{{ $title ?: 'Judul Artikel' }}</span><br>
                            @endif
                            @if ($metaDescription)
                                <span class="text-zinc-500 text-xs">{{ $metaDescription }}</span>
                            @else
                                <span class="text-zinc-400 text-xs">{{ $summary ?: 'Deskripsi artikel akan muncul di sini...' }}</span>
                            @endif
                        </p>
                    </div>
                @endif
            </div>

            {{-- Form Actions --}}
            <div class="flex justify-end gap-3 pt-2">
                <flux:button variant="primary" wire:click="save" class="rounded-2xl bg-emerald-500 hover:bg-emerald-600">
                    {{ $editingId ? 'Perbarui Artikel' : 'Publish Artikel' }}
                </flux:button>
                <flux:button wire:click="resetForm">Batal</flux:button>
            </div>
        </div>
    @else
        <div class="flex justify-end">
            <flux:button
                variant="primary"
                wire:click="toggleForm"
                class="rounded-2xl bg-emerald-500 hover:bg-emerald-600"
            >
                + Tambah Artikel
            </flux:button>
        </div>
    @endif

    {{-- Article Table --}}
    <div class="rounded-2xl bg-white shadow-lg dark:bg-neutral-900 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-neutral-800">
                <thead class="bg-emerald-50 dark:bg-emerald-900/20">
                    <tr>
                        <th class="px-4 py-3 text-start text-xs font-semibold uppercase tracking-wider text-emerald-700 dark:text-emerald-400">Judul</th>
                        <th class="px-4 py-3 text-start text-xs font-semibold uppercase tracking-wider text-emerald-700 dark:text-emerald-400">Penulis</th>
                        <th class="px-4 py-3 text-start text-xs font-semibold uppercase tracking-wider text-emerald-700 dark:text-emerald-400">Status</th>
                        <th class="px-4 py-3 text-start text-xs font-semibold uppercase tracking-wider text-emerald-700 dark:text-emerald-400">Tanggal</th>
                        <th class="px-4 py-3 text-end text-xs font-semibold uppercase tracking-wider text-emerald-700 dark:text-emerald-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-neutral-800">
                    @forelse ($this->articles as $article)
                        <tr class="transition-colors hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10">
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium">{{ $article->title }}</div>
                                <div class="text-xs text-zinc-400">{{ $article->slug }}</div>
                                @if ($article->isSchedule())
                                    <div class="text-xs text-amber-500">Dijadwalkan: {{ $article->scheduled_at?->format('d M Y H:i') }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $article->author->name }}</td>
                            <td class="px-4 py-3">
                                @if ($article->isPublished())
                                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">Published</span>
                                @elseif ($article->isDraft())
                                    @if ($article->isSchedule())
                                        <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">Scheduled</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-zinc-100 px-2.5 py-0.5 text-xs font-medium text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">Draft</span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">Archived</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-zinc-500">{{ $article->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex items-center justify-end gap-1">
                                    @if ($article->isDraft())
                                        <flux:button size="sm" variant="ghost" wire:click="publish({{ $article->id }})">
                                            <svg class="size-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/></svg>
                                        </flux:button>
                                    @elseif ($article->isPublished())
                                        <flux:button size="sm" variant="ghost" wire:click="setDraft({{ $article->id }})">
                                            <svg class="size-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                        </flux:button>
                                    @endif
                                    <flux:button size="sm" variant="ghost" wire:click="edit({{ $article->id }})">
                                        <svg class="size-4 text-teal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 0 20.25 21H5.25A2.25 2.25 0 0 0 3 18.75V16"/></svg>
                                    </flux:button>
                                    <flux:button size="sm" variant="ghost" wire:click="delete({{ $article->id }})" wire:confirm="Yakin ingin menghapus artikel ini?">
                                        <svg class="size-4 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 4.667 0 0 0-7.5 0"/></svg>
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center text-zinc-400">
                                <svg class="mx-auto mb-3 size-10 text-zinc-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                                </svg>
                                Belum ada artikel. Klik tombol <span class="font-medium">Tambah Artikel</span> untuk membuat yang baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($this->articles->hasPages())
            <div class="border-t border-zinc-200 px-4 py-3 dark:border-neutral-800">
                {{ $this->articles->links() }}
            </div>
        @endif
    </div>
</div>
