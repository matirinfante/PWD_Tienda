<?php
include_once("../../config.php");
$session = new Session();
$controller = new RolController();
if (!$session->activa()) {
    header('location: login.php');
    exit();
}
$pagina = "cliCompras";
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
    <div class="col-8 p-2 mt-2 mb-2">
        <table id="dg" title="Compras iniciadas" class="easyui-datagrid"
               url="../action/cliente/listarMisCompras.php"
               toolbar="#toolbar" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
            <tr>
                <th field="idcompraestado" width="20">ID</th>
                <th field="idcompra" width="50">ID Compra</th>
                <th field="idcompraestadotipo" width="50" hidden>ID Compra estado tipo</th>
                <th field="cetdescripcion" width="70">Estado</th>
                <th field="cefechaini" width="50">Fecha inicio</th>
                <th field="cefechafin" width="50">Fecha fin</th>
                <th field="usnombre" width="50">Usuario</th>
            </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true"
               onclick="cancelarCompra()">Cancelar compra</a>
        </div>

        <!-- cancelar compra -->
        <div id="cancel" class="easyui-dialog" style="width:400px"
             data-options="closed:true,modal:true,border:'thin',buttons:'#cancel-buttons'">
            <form id="fm-cancel" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Está seguro?</h3>
                <div>
                    <input name="idcompraestadotipo" value="idcompraestadotipo" type="hidden">
                    <input name="idcompraestado" value="idcompraestado" type="hidden">
                    <input name="idcompra" value="idcompra" type="hidden">
                    <input name="cefechaini" value="cefechaini" type="hidden">
                    <input name="cefechafin" value="cefechafin" type="hidden">
                </div>
            </form>
        </div>
        <div id="cancel-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="cancelarCompraSubmit()"
               style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
               onclick="javascript:$('#cancel').dialog('close')" style="width:90px">Cancelar</a>
        </div>

    </div>
    </div>

    <script type="text/javascript">
        var url;

        $('#dg').datagrid({
            queryParams: {
                idusuario: <?php echo $session->getUsuario()->getIdusuario();?>
            }
        });


        function cancelarCompra() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#cancel').dialog('open').dialog('center').dialog('setTitle', 'Cancelar compra');
                $('#fm-cancel').form('load', row);
                url = '../action/cliente/cancelarCompra.php';


            }
        }

        function cancelarCompraSubmit() {
            $('#fm-cancel').form('submit', {
                url: url,
                iframe: false,
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if (result.errorMsg) {
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#cancel').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
    </script>
    <?php
}
?>

<?php
include_once "../structure/footer.php";
?>