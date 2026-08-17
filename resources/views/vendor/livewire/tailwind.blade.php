@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="mt-10 flex flex-col items-center gap-4">
            {{-- Mobile: prev/next --}}
            <div class="flex items-center gap-2 sm:hidden">
                @if ($paginator->onFirstPage())
                    <span class="inline-flex h-10 items-center justify-center rounded-xl border border-gray-200 bg-white px-4 text-sm font-medium text-gray-400 opacity-60">Prev</span>
                @else
                    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" class="inline-flex h-10 items-center justify-center rounded-xl border border-gray-200 bg-white px-4 text-sm font-medium text-gray-500 transition-all duration-200 hover:border-emerald-600 hover:text-emerald-600">
                        Prev
                    </button>
                @endif

                <span class="text-sm font-medium text-gray-500">Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}</span>

                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" class="inline-flex h-10 items-center justify-center rounded-xl border border-gray-200 bg-white px-4 text-sm font-medium text-gray-500 transition-all duration-200 hover:border-emerald-600 hover:text-emerald-600">
                        Next
                    </button>
                @else
                    <span class="inline-flex h-10 items-center justify-center rounded-xl border border-gray-200 bg-white px-4 text-sm font-medium text-gray-400 opacity-60">Next</span>
                @endif
            </div>

            {{-- Desktop: numbered --}}
            <div class="hidden items-center justify-center gap-1.5 sm:flex">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="inline-flex h-10 min-w-10 items-center justify-center rounded-xl border border-gray-200 bg-white px-3 text-sm font-medium text-gray-400 opacity-60">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @else
                    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="{{ __('pagination.previous') }}" class="inline-flex h-10 min-w-10 items-center justify-center rounded-xl border border-gray-200 bg-white px-3 text-sm font-medium text-gray-500 transition-all duration-200 hover:border-emerald-600 hover:text-emerald-600">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true" class="inline-flex h-10 min-w-10 items-center justify-center rounded-xl px-3 text-sm font-medium text-gray-400">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class="inline-flex h-10 min-w-10 items-center justify-center rounded-xl border border-emerald-600 bg-emerald-600 px-3 text-sm font-medium text-white">{{ $page }}</span>
                                @else
                                    <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="{{ __('Go to page :page', ['page' => $page]) }}" class="inline-flex h-10 min-w-10 items-center justify-center rounded-xl border border-gray-200 bg-white px-3 text-sm font-medium text-gray-500 transition-all duration-200 hover:border-emerald-600 hover:text-emerald-600">{{ $page }}</button>
                                @endif
                            </span>
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="{{ __('pagination.next') }}" class="inline-flex h-10 min-w-10 items-center justify-center rounded-xl border border-gray-200 bg-white px-3 text-sm font-medium text-gray-500 transition-all duration-200 hover:border-emerald-600 hover:text-emerald-600">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="inline-flex h-10 min-w-10 items-center justify-center rounded-xl border border-gray-200 bg-white px-3 text-sm font-medium text-gray-400 opacity-60">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif
            </div>
        </nav>
    @endif
</div>
