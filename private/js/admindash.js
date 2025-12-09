function deleteuser(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        window.location.href = `../private/controller/user.php?deleteid=${userId}`;
    }
}

function deletereview(reviewId) {
    if (confirm("Are you sure you want to delete this review?")) {
        window.location.href = `../private/controller/user.php?reviewId=${reviewId}`;
    }
}

function deletegalery(galeryId) {
    if (confirm("Are you sure you want to delete this galery item?")) {
        window.location.href = `../private/controller/user.php?galeryId=${galeryId}`;
    }
}

// Manejo de mensajes de éxito o error en el envío de reseñas
function obtenerParametros() {
    // 1. Obtener la URL actual
    const url = new URL(window.location.href);
    
    // 2. Crear un objeto URLSearchParams a partir de la query string
    const params = new URLSearchParams(url.search);

    const parametrosCapturados = {};

    // 3. Iterar sobre todos los parámetros y guardarlos
    for (const [key, value] of params.entries()) {
        parametrosCapturados[key] = value;
    }

    return parametrosCapturados;
}

const misParametros = obtenerParametros();
if (misParametros.success) {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: misParametros.success
    });
    window.history.replaceState({}, document.title, window.location.pathname);
} else {
    if (misParametros.error) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: misParametros.error
        });
        window.history.replaceState({}, document.title, window.location.pathname);
    }
}

document.getElementById('Logout').addEventListener('click', function() {
    window.location.href = '../private/controller/logout.php';
});