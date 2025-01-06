
    document.getElementById('addGeneroForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('/api/generos', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: formData.get('name')
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status == 201) {
                alert('Género agregado exitosamente');
            } else {
                alert('Error al agregar género');
            }
        })
        .catch(error => console.error('Error:', error));
    });