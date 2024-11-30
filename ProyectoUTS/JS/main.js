// Obtener la URL actual y extraer el nombre de la página
const currentPage = window.location.pathname.split('/').pop().replace('.html', '');


// Seleccionar todos los elementos del navbar
const navItems = document.querySelectorAll('.nav-item');

// Recorrer los elementos y verificar cuál coincide con la página actual
navItems.forEach((item) => {
  const page = item.getAttribute('data-page');
console.log(page, "page");
console.log(currentPage, "currentPage");




  if (page === currentPage) {
    item.classList.add('active');
  }
});
