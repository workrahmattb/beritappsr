<nav id="navbar"
     x-persist="navbar"
     class="fixed inset-x-0 top-0 z-50 border-b border-emerald-500/10 bg-white/95 backdrop-blur-xl transition-shadow"
     x-data="{
         mobileOpen: false,
         scrolled: false,
         path: window.location.pathname,
         init() {
             this.scrolled = window.scrollY > 20;
             window.addEventListener('livewire:navigated', () => {
                 this.path = window.location.pathname;
             });
         },
         isActive(prefix) {
             if (prefix === '/') return this.path === '/';
             return this.path === prefix || this.path.startsWith(prefix + '/');
         }
     }"
     @scroll.window="scrolled = window.scrollY > 20"
     :class="{ 'shadow-[0_4px_24px_rgba(22,163,74,0.08)]': scrolled }">
    <div class="mx-auto flex h-[72px] max-w-[1200px] items-center justify-between px-6">
        <a href="/" wire:navigate class="flex items-center gap-2.5 text-xl font-extrabold tracking-tight text-emerald-600">
            <img src="{{ asset('gambar/ppsr logo.webp') }}" alt="PPSR Logo" class="h-10 w-auto">
        </a>

        <div class="hidden items-center gap-8 md:flex">
            <a href="/" wire:navigate
                class="relative text-sm font-medium no-underline transition-colors after:absolute after:-bottom-1 after:left-0 after:right-0 after:h-0.5 after:rounded-sm after:bg-emerald-600 after:scale-x-0 after:transition-transform hover:text-emerald-600 hover:after:scale-x-100"
                :class="isActive('/') ? 'text-emerald-600 after:scale-x-100' : 'text-gray-500'">
                Beranda
            </a>

            <div class="group relative">
                <span
                    class="relative flex cursor-pointer items-center gap-1 text-sm font-medium transition-colors after:absolute after:-bottom-1 after:left-0 after:right-0 after:h-0.5 after:rounded-sm after:bg-emerald-600 after:scale-x-0 after:transition-transform group-hover:text-emerald-600 group-hover:after:scale-x-100"
                    :class="isActive('/profile') ? 'text-emerald-600 after:scale-x-100' : 'text-gray-500'">
                    Profile
                    <svg class="transition-transform group-hover:rotate-180" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </span>
                <div
                    class="invisible absolute left-1/2 top-full z-[100] min-w-[200px] -translate-x-1/2 translate-y-2 rounded-xl border border-emerald-500/10 bg-white p-1.5 opacity-0 shadow-[0_12px_40px_rgba(0,0,0,0.12)] transition-all group-hover:visible group-hover:translate-y-1 group-hover:opacity-100">
                    <a href="{{ route('profile.pimpinan') }}" wire:navigate
                        class="flex items-center gap-2.5 rounded-lg px-3.5 py-2.5 text-sm font-medium no-underline transition-all hover:bg-emerald-500/10 hover:text-emerald-600"
                        :class="isActive('/profile/pimpinan') ? 'bg-emerald-500/10 text-emerald-600' : 'text-gray-600'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        Pimpinan Pondok
                    </a>
                    <a href="{{ route('profile.pengajar') }}" wire:navigate
                        class="flex items-center gap-2.5 rounded-lg px-3.5 py-2.5 text-sm font-medium no-underline transition-all hover:bg-emerald-500/10 hover:text-emerald-600"
                        :class="isActive('/profile/pengajar') ? 'bg-emerald-500/10 text-emerald-600' : 'text-gray-600'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Pengajar
                    </a>
                </div>
            </div>

            <a href="{{ route('fasilitas') }}" wire:navigate
                class="relative text-sm font-medium no-underline transition-colors after:absolute after:-bottom-1 after:left-0 after:right-0 after:h-0.5 after:rounded-sm after:bg-emerald-600 after:scale-x-0 after:transition-transform hover:text-emerald-600 hover:after:scale-x-100"
                :class="isActive('/fasilitas') ? 'text-emerald-600 after:scale-x-100' : 'text-gray-500'">
                Fasilitas
            </a>

            <a href="/berita" wire:navigate
                class="relative text-sm font-medium no-underline transition-colors after:absolute after:-bottom-1 after:left-0 after:right-0 after:h-0.5 after:rounded-sm after:bg-emerald-600 after:scale-x-0 after:transition-transform hover:text-emerald-600 hover:after:scale-x-100"
                :class="isActive('/berita') ? 'text-emerald-600 after:scale-x-100' : 'text-gray-500'">
                Berita
            </a>

            <a href="{{ route('tentang') }}" wire:navigate
                class="relative text-sm font-medium no-underline transition-colors after:absolute after:-bottom-1 after:left-0 after:right-0 after:h-0.5 after:rounded-sm after:bg-emerald-600 after:scale-x-0 after:transition-transform hover:text-emerald-600 hover:after:scale-x-100"
                :class="isActive('/tentang') ? 'text-emerald-600 after:scale-x-100' : 'text-gray-500'">
                Tentang
            </a>
            <a href="{{ route('kontak') }}" wire:navigate
                class="relative text-sm font-medium no-underline transition-colors after:absolute after:-bottom-1 after:left-0 after:right-0 after:h-0.5 after:rounded-sm after:bg-emerald-600 after:scale-x-0 after:transition-transform hover:text-emerald-600 hover:after:scale-x-100"
                :class="isActive('/kontak') ? 'text-emerald-600 after:scale-x-100' : 'text-gray-500'">
                Kontak
            </a>
            <a href="https://lws.syafaaturrasul.com" target="_blank" rel="noopener noreferrer"
                class="rounded-lg bg-gradient-to-br from-yellow-700 to-yellow-500 px-4 py-1.5 font-semibold text-white">
                Wakaf
            </a>
        </div>

        <button class="flex cursor-pointer flex-col gap-[5px] border-none bg-transparent p-1 md:hidden"
            @click="mobileOpen = !mobileOpen" aria-label="Menu">
            <span class="block h-[2.5px] w-6 rounded bg-gray-600 transition-all"
                :class="mobileOpen && '[transform:rotate(45deg)_translate(5px,5px)]'"></span>
            <span class="block h-[2.5px] w-6 rounded bg-gray-600 transition-all"
                :class="mobileOpen && 'opacity-0'"></span>
            <span class="block h-[2.5px] w-6 rounded bg-gray-600 transition-all"
                :class="mobileOpen && '[transform:rotate(-45deg)_translate(5px,-5px)]'"></span>
        </button>
    </div>

    <div class="mx-auto flex max-w-[1200px] flex-col gap-1 bg-white px-6 pb-5 md:hidden" x-show="mobileOpen" x-cloak>
        <a href="/" wire:navigate @click="mobileOpen = false"
            class="py-2.5 text-sm font-medium no-underline transition-colors hover:text-emerald-600"
            :class="isActive('/') ? 'text-emerald-600' : 'text-gray-600'">Beranda</a>
        <div class="pb-0.5 pt-1.5 text-xs font-semibold uppercase tracking-wide text-gray-400">Profile</div>
        <a href="{{ route('profile.pimpinan') }}" wire:navigate @click="mobileOpen = false"
            class="py-2.5 pl-4 text-sm font-medium no-underline transition-colors hover:text-emerald-600"
            :class="isActive('/profile/pimpinan') ? 'text-emerald-600' : 'text-gray-600'">Pimpinan
            Pondok</a>
        <a href="{{ route('profile.pengajar') }}" wire:navigate @click="mobileOpen = false"
            class="py-2.5 pl-4 text-sm font-medium no-underline transition-colors hover:text-emerald-600"
            :class="isActive('/profile/pengajar') ? 'text-emerald-600' : 'text-gray-600'">Pengajar</a>
        <a href="{{ route('fasilitas') }}" wire:navigate @click="mobileOpen = false"
            class="py-2.5 text-sm font-medium no-underline transition-colors hover:text-emerald-600"
            :class="isActive('/fasilitas') ? 'text-emerald-600' : 'text-gray-600'">Fasilitas</a>
        <a href="/berita" wire:navigate @click="mobileOpen = false"
            class="py-2.5 text-sm font-medium no-underline transition-colors hover:text-emerald-600"
            :class="isActive('/berita') ? 'text-emerald-600' : 'text-gray-600'">Berita</a>
        <a href="{{ route('tentang') }}" wire:navigate @click="mobileOpen = false"
            class="py-2.5 text-sm font-medium no-underline transition-colors hover:text-emerald-600"
            :class="isActive('/tentang') ? 'text-emerald-600' : 'text-gray-600'">Tentang</a>
        <a href="{{ route('kontak') }}" wire:navigate @click="mobileOpen = false"
            class="py-2.5 text-sm font-medium no-underline transition-colors hover:text-emerald-600"
            :class="isActive('/kontak') ? 'text-emerald-600' : 'text-gray-600'">Kontak</a>
        <a href="https://lws.syafaaturrasul.com" target="_blank" rel="noopener noreferrer" @click="mobileOpen = false"
            class="py-2.5 text-sm font-bold text-yellow-700 no-underline">Wakaf</a>
    </div>
</nav>
