document.addEventListener("DOMContentLoaded", function () {
    const snowContainer = document.getElementById("snow-container");

    function createSnowflake() {
        const snowflake = document.createElement("div");
        snowflake.className = "snowflake";
        snowflake.textContent = "❄"; // Puedes cambiar el símbolo si lo deseas
        snowflake.style.left = Math.random() * window.innerWidth + "px";
        snowflake.style.animationDuration = Math.random() * 3 + 2 + "s"; // Duración entre 2-5s
        snowflake.style.fontSize = Math.random() * 10 + 10 + "px"; // Tamaño entre 10-20px
        snowContainer.appendChild(snowflake);

        // Eliminar el copo después de la animación
        setTimeout(() => {
            snowflake.remove();
        }, 5000);
    }

    // Generar copos de nieve periódicamente
    setInterval(createSnowflake, 200);
});
