$(document).ready(function () {
<<<<<<< HEAD
    const radios = document.querySelectorAll('.vida-radio');
    const confirmButtonContainer = document.getElementById('confirmButtonContainer');
    const confirmButton = document.getElementById('confirmButton');
    const walletContainer = $('#wallet_container');
    const mp = new MercadoPago(MERCADO_PAGO_PUBLIC_KEY);
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
=======

    const radios = document.querySelectorAll('.vida-radio');
    const confirmButtonContainer = document.getElementById('confirmButtonContainer');
    const confirmButton = document.getElementById('confirmButton');

>>>>>>> f7ce9542c7d24e9ef74ada78f0cf3d8fae0bfe31
    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            confirmButtonContainer.style.display = 'block';
        });
    });

<<<<<<< HEAD
    // Al hacer clic en el botón "Confirmar"
    confirmButton.addEventListener('click', function () {
        let selectedRadio = document.querySelector('input[name="vida"]:checked');
        if (selectedRadio) {
            
            let id = parseInt(selectedRadio.value); 
            let cantidad = parseInt(selectedRadio.getAttribute('data-quantity'));
            let precio = parseFloat(selectedRadio.getAttribute('data-price'));
        

            console.log('ID:', id);

        

            walletContainer.show();

            fetch('http://localhost:8000/create-preference', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    vidaId: id,

                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.preferenceId) {
                        mp.bricks().create("wallet", "wallet_container", {
                            initialization: {
                                preferenceId: data.preferenceId,
                                redirectMode: 'self'
                            },
                            customization: {
                                texts: {
                                    action: "Pagar ahora",
                                    valueProp: "Paga de forma rápida y segura",
                                }
                            }
                        });
                    } else {
                        console.error("No se pudo obtener el preferenceId");
                    }
                })
                .catch(error => {
                    console.error("Error al obtener el preferenceId:", error);
                });
        } else {
            console.error("No hay un paquete seleccionado.");
        }
    });
=======
    confirmButton.addEventListener('click', function () {
        const selectedRadio = document.querySelector('.vida-radio:checked');
        if (selectedRadio) {
            const selectedVida = {
                id: selectedRadio.value,
                quantity: selectedRadio.getAttribute('data-quantity'),
                price: selectedRadio.getAttribute('data-price')
            };

            console.log('Paquete seleccionado:', selectedVida);
        }
    });



    // Configuración cuando se muestre el modal
    $('#vidasModal').on('shown.bs.modal', function () {
        // Activar el botón de confirmar solo después de que se haya seleccionado una opción
        let selectedVida = null;

        $('#vidasList').on('click', '.vida-radio', function () {
            selectedVida = {
                id: $(this).data('id'),
                quantity: $(this).data('quantity'),
                price: $(this).data('price')
            };
            // Hacer visible el botón de confirmar si hay una opción seleccionada
            $('#confirmarSeleccion').prop('disabled', false);
        });

        // Al hacer clic en confirmar
        $('#confirmarSeleccion').on('click', function () {
            if (selectedVida) {
                const mp = new MercadoPago(MERCADO_PAGO_PUBLIC_KEY);
                $('#wallet_container').show();

                // Verificar que el contenedor es visible
                if ($('#wallet_container').is(':visible')) {
                    fetch('/create-preference', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        body: JSON.stringify({ selectedVida: selectedVida })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.preferenceId) {
                                mp.bricks().create("wallet", "wallet_container", {
                                    initialization: {
                                        preferenceId: data.preferenceId,
                                        redirectMode: 'self'
                                    },
                                    customization: {
                                        texts: {
                                            action: "pay",
                                            valueProp: 'security_safety',
                                        },
                                    },
                                });
                            } else {
                                console.error("No se pudo obtener el preferenceId");
                            }
                        })
                        .catch(error => {
                            console.error("Error al obtener el preferenceId:", error);
                        });
                } else {
                    console.error("El contenedor 'wallet_container' no está visible.");
                }
            } else {
                console.error("No se ha seleccionado un paquete.");
            }
        });
    });
>>>>>>> f7ce9542c7d24e9ef74ada78f0cf3d8fae0bfe31
});
