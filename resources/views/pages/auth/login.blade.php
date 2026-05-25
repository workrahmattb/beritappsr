<x-layouts::auth :title="__('Login')">
    <div class="flex flex-col gap-6">
        <x-auth-session-status class="text-center" :status="session('status')" />

        @if ($errors->any())
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600 dark:border-red-800 dark:bg-red-950/50 dark:text-red-400">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-4">
            @csrf

            <flux:input
                name="email"
                :label="__('Email')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="admin@berita.com"
            />

            <flux:input
                name="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
                viewable
            />

            <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                {{ __('Login') }}
            </flux:button>
        </form>
    </div>
</x-layouts::auth>
