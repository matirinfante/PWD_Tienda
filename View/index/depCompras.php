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

        <!-- cambiar estados -->
        <div id="est1" class="easyui-dialog" style="width:400px"
             data-options="closed:true,modal:true,border:'thin',buttons:'#est1-buttons'">
            <form id="fm-est1" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3></h3>
                <div style="margin-bottom:20px">
                    <select class="easyui-combobox" name="idcompraestadotipo" label="Estado: " style="width:100%">
                        <option value="2">ACEPTADA</option>
                        <option value="4">CANCELADA</option>
                    </select>
                </div>

                <div>
                    <input name="idcompraestado" value="idcompraestado" type="hidden">
                    <input name="idcompra" value="idcompra" type="hidden">
                    <input name="cefechaini" value="cefechaini" type="hidden">
                    <input name="cefechafin" value="cefechafin" type="hidden">
                </div>
            </form>
        </div>
        <div id="est1-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="cambiarEstado1()"
               style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
               onclick="javascript:$('#est1').dialog('close')" style="width:90px">Cancelar</a>
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

        function cambiarEstado() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#est1').dialog('open').dialog('center').dialog('setTitle', 'Editar estado');
                $('#fm-est1').form('load', row);
                url = '../action/deposito/cambiarEstado1.php';


            }
        }

        function cambiarEstado1() {
            alert("hola");
            $('#fm-est1').form('submit', {
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
                        $('#est1').dialog('close');        // close the dialog
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