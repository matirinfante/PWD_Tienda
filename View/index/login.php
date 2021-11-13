<?php
include_once("../../config.php");
$data = data_submitted();
$session = new Session();
$controller = new RolController();
if ($session->activa()) {
    header('location:../index/paginaSegura.php');
    exit();
}
include_once("../structure/header.php");
?>
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border rounded shadow p-3">
                    <div class="card-body">
                        <form class="ms-2" id="login" name="login" method="post" action="../action/verificarLogin.php"
                              data-toggle="validator" novalidate>
                            <h4 class="tittle text-center">Iniciar Sesión</h4>
                            <div class="form-group my-4">
                                <div class="input-group">
                                    <span class="input-group-text p-3"><i class="fas fa-user"></i></span>
                                    <input id="usnombre" class="form-control" type="text" placeholder="Nombre Usuario"
                                           name="usnombre">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text p-3"><i class="fas fa-lock"></i></span>
                                    <input id="uspass" class="form-control" type="password" placeholder="Contraseña"
                                           name="uspass">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="col-md-12">
                                    <button class="btn btn-success btn-md btn-block w-100" type="submit">Entrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include_once("../structure/footer.php");
?>