<section class="space-y-6" x-data="{ open: false }">

    <!-- Botón para abrir el modal -->
    <x-danger-button
        x-on:click.prevent="open = true" 
        class="btn btn-danger border-none"
    >
        {{ __('Eliminar ') }}
    </x-danger-button>

    <!-- Modal -->
    <div x-show="open" @click.away="open = false" x-transition class=" fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="p-6 rounded-lg w-1/3">
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6 form-group">
                @csrf
                @method('delete')

                <h2 class="centered-text text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('¿Estás seguro de que deseas eliminar tu cuenta?') }}
                </h2>

                <p class=" centered-text mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Por favor ingresa tu contraseña para confirmar que deseas eliminar tu cuenta de forma permanente.') }}
                </p>

                <div class="input-pass mt-6">
                    <x-input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />

                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-3/4 input-style"
                        placeholder="{{ __('Contraseña') }}"
                    />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="open = false" class="btn btn-style border-none">
                        {{ __('Cancelar') }}
                    </x-secondary-button>

                    <x-danger-button class="btn btn-danger border-none">
                        {{ __('Eliminar') }}
                    </x-danger-button>
                </div>
            </form>
        </div>
    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>

<style>
    .btn-danger {
        border: inherit !important;
    }
    .input-style {
        padding: 0.75rem 1rem;
        border-radius: 0.375rem;
        border: 1px solid #ddd;
        background-color: #fff;
        font-size: 1rem;
        color: #333;
        width: 100%;
        transition: border-color 0.3s, box-shadow 0.3s;
    }


    .input-style:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
    }

    .input-style::placeholder {
        color: #a0aec0;
    }
    .input-pass{
        margin-bottom: 2%;
    }
    .btn-style{
        background-color: #007bff !important;
        color: white;
    }

</style>
