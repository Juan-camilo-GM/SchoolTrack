let tarjetaId = 1;

function editarTarjeta(id) {
  const tarjeta = document.getElementById(`tarjeta${id}`);
  const titulo = tarjeta.querySelector('.card-title');
  const texto = tarjeta.querySelector('.card-text');
  const editarBtn = tarjeta.querySelector('.btn-secondary');
  const guardarBtn = tarjeta.querySelector('.btn-primary');
  const fileInput = tarjeta.querySelector('input[type=file]');
  const eliminarBtn = tarjeta.querySelector('.btn-danger');

  titulo.contentEditable = true;
  texto.contentEditable = true;
  editarBtn.classList.add('d-none');
  guardarBtn.classList.remove('d-none');
  fileInput.disabled = false; // Habilitar la entrada de archivo al editar
  fileInput.classList.remove('d-none'); // Mostrar la entrada de archivo
  eliminarBtn.classList.remove('d-none'); // Mostrar el botón de eliminar
}

function guardarTarjeta(id) {
  const tarjeta = document.getElementById(`tarjeta${id}`);
  const titulo = tarjeta.querySelector('.card-title');
  const texto = tarjeta.querySelector('.card-text');
  const editarBtn = tarjeta.querySelector('.btn-secondary');
  const guardarBtn = tarjeta.querySelector('.btn-primary');
  const fileInput = tarjeta.querySelector('input[type=file]');
  const eliminarBtn = tarjeta.querySelector('.btn-danger');

  titulo.contentEditable = false;
  texto.contentEditable = false;
  editarBtn.classList.remove('d-none');
  guardarBtn.classList.add('d-none');
  fileInput.disabled = true; // Deshabilitar la entrada de archivo al guardar
  fileInput.classList.add('d-none'); // Ocultar la entrada de archivo
  eliminarBtn.classList.add('d-none'); // Ocultar el botón de eliminar
}

function eliminarTarjeta(id) {
  const tarjeta = document.getElementById(`tarjeta${id}`);
  tarjeta.remove();
}

function agregarTarjeta() {
  const tarjetasContainer = document.getElementById('tarjetasContainer');
  const nuevaTarjeta = document.createElement('div');
  nuevaTarjeta.className = 'card m-5';
  nuevaTarjeta.id = `tarjeta${tarjetaId}`;
  nuevaTarjeta.innerHTML = `
    <input type="file" onchange="previewImage(event, ${tarjetaId})" class="form-control mb-3 d-none" accept="image/*" disabled>
    <img id="img${tarjetaId}" src="..." class="card-img-top" alt="..." style="object-fit: cover; height: 200px; width: 100%;">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-body-secondary">Última actualización: <span id="fecha${tarjetaId}">justo ahora</span></small></p>
      <button onclick="editarTarjeta(${tarjetaId})" class="btn btn-secondary">Editar</button>
      <button onclick="guardarTarjeta(${tarjetaId})" class="btn btn-primary d-none">Guardar</button>
      <button onclick="eliminarTarjeta(${tarjetaId})" class="btn btn-danger d-none">Eliminar</button>
    </div>
  `;
  tarjetasContainer.insertBefore(nuevaTarjeta, tarjetasContainer.firstChild);
  tarjetaId++;
}

function previewImage(event, id) {
  const reader = new FileReader();
  reader.onload = function(){
    const output = document.getElementById(`img${id}`);
    output.src = reader.result;
  }
  reader.readAsDataURL(event.target.files[0]);
}
