fetch("header.php")
    .then(res => res.text())
    .then(data => {
        document.getElementById("header").innerHTML = data;
    });


    fetch("footer.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("footer").innerHTML = data;
    })
    .catch(error => console.error("Error cargando el footer:", error));

let carrito = [];

function agregarAlCarrito(nombre, precio) {
    // Agregar objeto al array
    carrito.push({ nombre: nombre, precio: precio });
    actualizarCarrito();
}

function actualizarCarrito() {
   const lista = document.getElementById('lista-carrito');
    const contador = document.getElementById('contador-carrito');
    const totalSpan = document.getElementById('total-precio');

    // Limpiar lista anterior
    lista.innerHTML = '';
    
    let total = 0;
    // Recorrer carrito y crear elementos HTML
    carrito.forEach((item, index) => {
        const li = document.createElement('li');
        li.innerHTML = `${item.nombre} - $${item.precio} <button onclick="eliminarItem(${index})" style="color:red; cursor:pointer; border:none; background:none;">X</button>`;
        lista.appendChild(li);
      total += item.precio;
    });
    // Actualizar textos
    contador.innerText = carrito.length;
     otalSpan.innerText = total.toLocaleString(); // Formato con puntos
}

function eliminarItem(index) {
   carrito.splice(index, 1);
    actualizarCarrito();
}

function toggleCarrito() {
    const modal = document.getElementById('modal-carrito');
    if (modal.style.display === 'block') {
           modal.style.display = 'none';
    } else {
       modal.style.display = 'block';
    }
}