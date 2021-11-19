<?php
include_once("../../config.php");
$session = new Session();
$controller = new RolController();
if (!$session->activa()) {
    header('location: login.php');
    exit();
}
include_once "../structure/header.php";
if ($session->getRolActivo() != "11") { ?>
    <div class="container">
        <div class="alert alert-danger" role="alert">
            ACCESO PROHIBIDO
        </div>
    </div>
    <?php
} else {

    include_once("../structure/menuLateral.php");

    ?>
    <div class="col-8 mt-2 mb-2">
        <table id="dg" title="Compras iniciadas" class="easyui-datagrid"
               url="../action/deposito/listarCompras.php"
               toolbar="#toolbar" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
            <tr>
                <th field="idcompraestado" width="20">ID</th>
                <th field="idcompra" width="50">ID Compra</th>
                <th field="cetdescripcion" width="70">Estado</th>
                <th field="cefechaini" width="50">Fecha inicio</th>
                <th field="cefechafin" width="50">Fecha fin</th>
                <th field="usnombre" width="50">Usuario</th>

            </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true"
               onclick="cambiarEstado()">Cambiar estado</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true"
               onclick="cancelarCompra()">Cancelar compra</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:400px"
             data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Datos Usuario</h3>
                <div style="margin-bottom:10px">
                    <input name="usnombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="uspass" class="easyui-textbox" required="true" label="Contraseña:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input name="usmail" class="easyui-textbox" required="true" label="E-mail:" style="width:100%">
                </div>
                <div>
                    <input name="idusuario" value="idusuario" type="hidden">
                </div>
                <div>
                    <input name="usdeshabilitado" value="usdeshabilitado" type="hidden">
                </div>

            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarUsuario()"
               style="width:90px">OK</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
               onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
        </div>
    </div>
    </div>

    <script type="text/javascript">
        var url;

        $('#dg').datagrid({
            queryParams: {
                idcompraestadotipo: 1
            }
        });

        function editarUsuario() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Usuario');
                $('#fm').form('load', row);
                url = '../action/admin/updateUsuario.php';
            }
        }

    </script>
    <?php
}
?>

<?php
include_once "../structure/footer.php";
?>