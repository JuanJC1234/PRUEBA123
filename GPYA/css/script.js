// Función para desplazar la vista hasta el formulario
function scrollToForm() {
  const formSection = document.getElementById('formulario');
  formSection.scrollIntoView({ behavior: 'smooth' });
}


// Funcion para el cuadro de datos registrados
document.getElementById('contact-form').addEventListener('submit', function(event) {
  event.preventDefault(); // Evita el envío normal del formulario

  const formData = new FormData(this);

  fetch('guardar.php', {
      method: 'POST',
      body: formData
  })
  .then(response => response.text())
  .then(data => {
      // Mostrar el modal de éxito
      document.getElementById('successModal').style.display = 'block';
  })
  .catch(error => {
      console.error('Error:', error);
  });
});

// Cerrar el modal cuando se haga clic en el botón "Aceptar"
document.querySelector('.close').onclick = function() {
  document.getElementById('successModal').style.display = 'none';
}

document.getElementById('modalButton').onclick = function() {
  document.getElementById('successModal').style.display = 'none';
  window.location.href = '#formulario'; // Navegar a la parte superior de la página
  window.location.reload(); // Recargar la página
}

// Cerrar el modal si se hace clic fuera del contenido del modal
window.onclick = function(event) {
  if (event.target == document.getElementById('successModal')) {
      document.getElementById('successModal').style.display = 'none';
  }
}


// Para el boton de WhatsApp
window.addEventListener('scroll', function() {
  var formulario = document.getElementById('formulario');
  var whatsappButton = document.getElementById('whatsappButton');
  var windowHeight = window.innerHeight;
  var scrollY = window.scrollY || window.pageYOffset;
  var formularioOffsetTop = formulario.offsetTop;

  if ((scrollY + windowHeight) >= formularioOffsetTop) {
      whatsappButton.style.display = 'block';
  } else {
      whatsappButton.style.display = 'none';
  }
});
