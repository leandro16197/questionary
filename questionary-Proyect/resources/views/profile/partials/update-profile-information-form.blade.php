<section>


    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <x-input-label for="name" :value="__('Nombre')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
            <div class="datos-personales">
                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-full input-style"
                    :value="old('name', $user->name)"
                    required
                    autofocus
                    autocomplete="name" />
                <x-input-error class="mt-2 input-error" :messages="$errors->get('name')" />
            </div>
        </div>

        <div>
            <div class="form-group">
                <x-input-label for="email" :value="__('Correo electrónico')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
                <div class="datos-personales">
                    <x-text-input
                        id="email"
                        name="email"
                        type="email"
                        class="mt-1 block w-full input-style"
                        :value="old('email', $user->email)"
                        required
                        autocomplete="username" />
                    <x-input-error class="mt-2 input-error" :messages="$errors->get('email')" />
                </div>
            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Tu dirección de correo electrónico no está verificada.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Haz clic aquí para re-enviar el correo de verificación.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class=" form-group flex justify-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
<style>

    .form-group {
        display: flex;
        flex-direction: column;

        align-items: center;
        width: 100%;
        margin-top: 1rem;

    }

    
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
        border: none;
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
    }
</style>