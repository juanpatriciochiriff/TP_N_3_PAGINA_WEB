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
