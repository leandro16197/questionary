<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Actualizar Contraseña') }}
        </h2>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <x-input-label for="update_password_current_password" :value="__('Contraseña Actual')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
            <div class="datos-personales">
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full input-style" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 input-error" />
            </div>
        </div>

        <div class="form-group">
            <x-input-label for="update_password_password" :value="__('Nueva Contraseña')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
            <div class="datos-personales">
                <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full input-style" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 input-error" />
            </div>
        </div>

        <div class="form-group">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Contraseña')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
            <div class="datos-personales">
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full input-style" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 input-error" />
            </div>
        </div>

        <div class="form-group flex justify-center gap-4">
            <x-primary-button class="btn btn-primary">{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>

<style>
    /* Contenedor de la sección para centrar todo */
    section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    /* Contenedor de los form-group con flexbox */
    .form-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        margin-top: 1rem;
    }

    /* Contenedor de los inputs */
    .datos-personales {
        width: 100%;
        max-width: 400px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Estilo para el input */
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

    /* Estilo cuando el input está enfocado */
    .input-style:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
    }

    /* Estilo para el placeholder del input */
    .input-style::placeholder {
        color: #a0aec0;
    }

    /* Estilo para los errores */
    .input-error {
        color: #e53e3e;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    /* Estilo para el botón */
    .btn {
        width: 150px !important;
        padding: 0.75rem 1.25rem;
        font-size: 1rem;
        color: white;
        border-radius: 0.375rem;
        border: none !important;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
    }

    /* Efecto cuando el botón es presionado */
    .btn:active {
        transform: translateY(1px);
    }

    /* Estilo cuando el botón está enfocado */
    .btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.4);
    }

    /* Estilo para inputs deshabilitados */
    .datos-personales .input-style:disabled {
        background-color: #f7fafc;
        border-color: #edf2f7;
    }

    form:hover {
        background-color: inherit !important;
        color: inherit !important;
        box-shadow: inherit !important;
    }
</style>
