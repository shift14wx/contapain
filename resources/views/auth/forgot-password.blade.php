<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        <img src="/images/logodashboard.png" alt="contapainSecondaryLogo" class="rounded-full h-20 w-20 object-cover">
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente díganos su dirección de correo electrónico y le enviaremos un enlace para restablecer la contraseña que le permitirá elegir una nueva.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label value="{{ __('Email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Enviar a correo enlace para reestablecer la contraseña') }}
                </x-jet-button>
            </div>
        </form>
        <div class="mb-4 text-sm text-gray-600">
        <div class="flex items-center justify-end mt-4">
                <a href="/login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                ir a iniciar sesión
                </a>
        </div>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
