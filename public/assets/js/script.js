function validarFormulario() {
    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellido').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var confirmarPassword = document.getElementById('confirmarPassword').value;
  
    // Validar nombre y apellido
    if (nombre.length < 2 || apellido.length < 2) {
      alert('El nombre y el apellido deben tener al menos 2 caracteres.');
      return false;
    }
  
    // Validar formato de correo electrónico
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      alert('El correo electrónico debe tener un formato válido.');
      return false;
    }
  
    // Validar longitud de la contraseña
    if (password.length < 6) {
      alert('La contraseña debe tener al menos 6 caracteres.');
      return false;
    }
  
    // Validar coincidencia de contraseñas
    if (password !== confirmarPassword) {
      alert('La confirmación de contraseña debe coincidir con la contraseña ingresada.');
      return false;
    }
  
    // Si todos los campos son válidos, enviar el formulario mediante fetch
    enviarFormulario(nombre, apellido, email, password);
  
  }

  function enviarFormulario(nombre, apellido, email, password) {
    var url = 'http://localhost/m06/procesar.php';
  
    var datos = {
      nombre: nombre,
      apellido: apellido,
      email: email,
      sexo: sexo,
      password: password
    };
  
    var configuracionFetch = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(datos)
    };
  
    console.log('Enviando solicitud fetch al servidor...');
  
    fetch(url, configuracionFetch)
      .then(response => {
        console.log('Respuesta del servidor recibida.');
        if (!response.ok) {
          throw new Error('Error en la solicitud fetch');
        }
        return response.json();
      })
      .then(data => {
        console.log('Datos recibidos del servidor:', data);
  
        if (data.exito) {
          console.log('Registro exitoso. Redirigiendo a registro_exitoso.php...');
          window.location.href = 'http://registro_exitoso.php'; 
        } else {
          console.log('Error en el registro. Mostrando alerta...');
          alert('Error en el registro. Por favor, inténtalo de nuevo.');
        }
      })
      .catch(function(error) {
        console.error('Error al enviar el formulario:', error);
      });
  }


  
/* ---------------------------Agregar Skills---------------------------*/
function agregarSkills(){
  let contenedor = document.getElementById("skillset");
  let nuevoElemento = document.createElement("div");
  nuevoElemento.classList = "input-group";
  nuevoElemento.innerHTML =`<input type='text' class='form-control claseskill' name='por-skills[]' placeholder='skills' required><span class='input-group-btn'><button class='btn btn-primary claseskill' type='button' onclick='agregarSkills()'> +<span class='fa fa-eye-slash icon'></span></button><button class='btn btn-danger claseskill botonEliminarSkill' type='button'>-<span class='fa fa-eye-slash icon'></span></button></span>`
  contenedor.appendChild(nuevoElemento);
}

let contenedor = document.getElementById("skillset");
  contenedor.addEventListener('click', e=>{
     if (e.target.classList.contains('botonEliminarSkill')){
      e.target.parentNode.parentNode.remove();
      
  }
})

/* ---------------------------Agregar Proyectos---------------------------*/

let contenedor2 = document.getElementById("projectSet");
  contenedor2.addEventListener('click', e=>{
     if (e.target.classList.contains('botonEliminarProyecto')){
     e.target.parentNode.parentNode.parentNode.remove();
      
  }
})

function agregarProyecto(){
  let contenedor = document.getElementById("projectSet");
  let nuevoElemento = document.createElement("div");
  nuevoElemento.classList = "DivEliminarProyecto";
  nuevoElemento.innerHTML = `<fieldset class="border p-2 mr-auto ml-2"><legend class="fs-5">Proyecto</legend>
  <div class="input-group claseskill">
      <input type="text" class="form-control" name="pro-titulo[]" placeholder="titulo" required>
  </div>
  <div class="input-group claseskill">
      <input type="text" class="form-control" name="pro-descripcion[]" placeholder="descripcion" required>
  </div>
  <div class="input-group claseskill">
    <input type="text" class="form-control" name="pro-enlace[]" placeholder="enlace" required>
</div>
 <span class="input-group-btn">
  <button class="btn btn-primary float-end botonCrearProyecto" type="button" onclick="agregarProyecto()">
      +<span class="fa fa-eye-slash icon"></span>
  </button> 
  <button class="btn btn-danger float-end botonEliminarProyecto" type="button">
    -<span class="fa fa-eye-slash icon"></span>
  </button>  
 </span>
</fieldset>`
  contenedor.appendChild(nuevoElemento);
}


