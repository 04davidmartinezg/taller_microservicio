const API = "http://127.0.0.1:8000";

async function crearSprint() {

    const data = {
        nombre: document.getElementById("nombreSprint").value,
        fecha_inicio: document.getElementById("fechaInicio").value,
        fecha_fin: document.getElementById("fechaFin").value
    };

    const response = await fetch(`${API}/sprint`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    });

    const result = await response.json();

    alert(result.message);
}

async function crearItem() {

    const data = {
        sprint_id: document.getElementById("sprintId").value,
        categoria: document.getElementById("categoria").value,
        descripcion: document.getElementById("descripcion").value
    };

    const response = await fetch(`${API}/retro_items`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    });

    const result = await response.json();

    alert("Item creado");

    cargarHistorial();
}

async function cargarHistorial() {

    const response = await fetch(`${API}/retro_items`);

    const data = await response.json();

    const contenedor = document.getElementById("resultado");

    contenedor.innerHTML = "";

    data.forEach(item => {

        contenedor.innerHTML += `
            <div class="item ${item.categoria}">
                <h3>${item.categoria.toUpperCase()}</h3>

                <p>${item.descripcion}</p>

                <small>
                    Sprint ID: ${item.sprint_id}
                </small>
            </div>
        `;
    });
}

cargarHistorial();