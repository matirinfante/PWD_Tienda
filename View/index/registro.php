<?php
include_once("../../config.php");
$data = data_submitted();
$session = new Session();
include_once("../structure/header.php");
?>


    <div class="container px-5">
        <div class="text-center p-3">
            <h3>Registro de nuevo usuario</h3>
        </div>
        <form id="formUser" name="formUser" method="post" action="../action/registroAction.php"
              onsubmit="return actualizarDatos();" novalidate>

            <div class="form-floating mb-3">
                <input class="form-control" id="usnombre" name="usnombre" type="text" placeholder="Username" required>
                <label for="usnombre">Username</label>
                <div class="invalid-feedback">Ingrese un username correcto.</div>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="uspass" name="uspass" type="text" placeholder="password" required>
                <label for="uspass">Password</label>
                <div class="invalid-feedback">Ingrese una password válida: min 8 caracteres, letras y numeros.</div>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="usmail" name="usmail" type="text" placeholder="email" required>
                <label for="usmail">Email</label>
                <div class="invalid-feedback">Ingrese un email válida.</div>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Registrarse</button>
            </div>
        </form>
    </div>
    <script rel="script" src="../js/validaciones.js"></script>

<?php
include_once('../structure/footer.php');
?>