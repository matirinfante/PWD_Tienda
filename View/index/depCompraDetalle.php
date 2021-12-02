<?php
include_once("../../config.php");
$session = new Session();
$controller = new RolController();
if (!$session->activa()) {
    header('location: login.php');
    exit();
}
$pagina = "depCompraDetalle";
$controllerPermiso = new GestorPermisos();
include_once "../structure/header.php";
if (!$controllerPermiso->tienePermiso($session->getRolActivo(), $pagina)) { ?>
    <div class="container">
        <div class="alert alert-danger p-3" role="alert">
            ACCESO PROHIBIDO
        </div>
    </div>
    <?php
} else {

    include_once("../structure/menuLateral.php");

    ?>
    <div class="col-9 p-2 mt-2 mb-2">
        <h2 class="text-center">Ver compras</h2>
        <table id="dg" style="height: auto"
               url="../action/deposito/listarCompraDetalle.php"
               title="Compra detalle"
               singleSelect="true" fitColumns="true">
            <thead>
            <tr>
                <th field="idcompra" width="80">ID Compra</th>
                <th field="cofecha" width="100">Fecha</th>
                <th field="usnombre" align="right" width="80">Usuario</th>
            </tr>
            </thead>
        </table>
    </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('#dg').datagrid({
                view: detailview,
                detailFormatter: function (index, row) {
                    return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
                },
                onExpandRow: function (index, row) {
                    var ddv = $(this).datagrid('getRowDetail', index).find('table.ddv');
                    ddv.datagrid({
                        url: '../action/deposito/detalleCompra.php?idcompra=' + row.idcompra,
                        fitColumns: true,
                        singleSelect: true,
                        rownumbers: false,
                        loadMsg: '',
                        height: 'auto',
                        columns: [[
                            {field: 'idproducto', title: 'ID Producto', width: 200},
                            {field: 'pronombre', title: 'Nombre', width: 100, align: 'right'},
                            {field: 'proprecio', title: 'Precio', width: 100, align: 'right'},
                            {field: 'cantidad', title: 'Cantidad', width: 100, align: 'right'}
                        ]],
                        onResize: function () {
                            $('#dg').datagrid('fixDetailRowHeight', index);
                        },
                        onLoadSuccess: function () {
                            setTimeout(function () {
                                $('#dg').datagrid('fixDetailRowHeight', index);
                            }, 0);
                        }
                    });
                    $('#dg').datagrid('fixDetailRowHeight', index);
                }
            });
        });
    </script>
    <?php
}
?>

<?php
include_once "../structure/footer.php";
?>