document.addEventListener("DOMContentLoaded", function () {
    const questionContainer = document.querySelector("#question-container");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    let isLocked = false;

    // Función para manejar clics en las respuestas
    function handleAnswerClick(event) {
        if (isLocked) return;

        const label = event.currentTarget;
        const selectedAnswerId = label.getAttribute("data-id");
        const isCorrect = label.getAttribute("data-correct") === "1";
        const correctAnswerLabel = document.querySelector('.answer-option[data-correct="1"]');
        const answerLabels = document.querySelectorAll(".answer-option");

        // Restablecer estilos previos
        answerLabels.forEach(l => {
            l.style.backgroundColor = "";
            l.style.color = "";
        });

        // Estilo para respuesta seleccionada
        label.style.backgroundColor = isCorrect ? "green" : "red";
        label.style.color = "white";

        // Mostrar la respuesta correcta
        if (!isCorrect && correctAnswerLabel) {
            correctAnswerLabel.style.backgroundColor = "green";
            correctAnswerLabel.style.color = "white";
        }

        isLocked = true;
        disableInputs();

        // Enviar la respuesta y cargar la siguiente pregunta
        submitAnswer(selectedAnswerId)
            .then(loadNextQuestion)
            .catch(error => {
                console.error("Error al procesar la respuesta:", error);
                alert("Hubo un problema al procesar tu respuesta.");
                isLocked = false;
            });
    }

    // Deshabilitar inputs y clics
    function disableInputs() {
        document.querySelectorAll(".answer-option").forEach(label => {
            label.style.pointerEvents = "none";
        });

        document.querySelectorAll(".form-check-input").forEach(input => {
            input.disabled = true;
        });
    }

    // Enviar la respuesta al servidor
    async function submitAnswer(answerId) {
        const response = await fetch(@json(route('submit.answer')), {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({ respuesta: answerId }),
        });

        if (!response.ok) {
            throw new Error(`Error al enviar la respuesta: ${response.status}`);
        }

        const data = await response.json();
        console.log("Respuesta enviada exitosamente:", data);
    }

    // Cargar la siguiente pregunta
    async function loadNextQuestion() {
        try {
            const response = await fetch("/play");
            if (!response.ok) {
                throw new Error(`Error al cargar la nueva pregunta: ${response.status}`);
            }

            const newQuestionHtml = await response.text();
            questionContainer.innerHTML = newQuestionHtml;

            isLocked = false;
            attachClickEvents();
        } catch (error) {
            console.error("Error al cargar la nueva pregunta:", error);
            alert("Hubo un problema al cargar la nueva pregunta.");
        }
    }

    // Adjuntar eventos a las respuestas
    function attachClickEvents() {
        document.querySelectorAll(".answer-option").forEach(label => {
            label.removeEventListener("click", handleAnswerClick); // Evitar duplicación de eventos
            label.addEventListener("click", handleAnswerClick);
        });
    }

    // Inicializar eventos al cargar la página
    attachClickEvents();
});
