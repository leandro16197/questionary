fetch('/create-preference', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    },
    body: JSON.stringify({}),
})
    .then(response => response.json())
    .then(data => {
        const mp = new MercadoPago("{{env('MERCADO_PAGO_PUBLIC_KEY')}}");
        mp.bricks().create("wallet", "wallet_container", {
            initialization: {
                preferenceId: data.preferenceId,
            },
        });
    })
    .catch(error => console.error('Error al crear la preferencia:', error));
