<?php
include_once("../../config.php");
$session = new Session();

if (!$session->activa()) {
    header('location: login.php');
    exit();
}


include_once("../structure/header.php");



?>

<h2>Adminitrar Stock</h2>

    <!-- ---TABLA USUARIOS--- -->

    <table id="dg" title="Productos" class="easyui-datagrid" style="width:950px;height:250px"
           url="../action/listarProductos.php"
           toolbar="#toolbar" pagination="true"
           rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
        <tr>
            <th field="idproducto" width="20">ID</th>
            <th field="pronombre" width="50">Nombre</th>
            <th field="prodetalle" width="120">Detalle</th>
            <th field="procantstock" width="60">Cantidad</th>
            <th field="proprecio" width="50">Precio</th>
            <th field="proeditorial" width="70">Editorial</th>
            <th field="proautor" width="50">Autor</th>
        </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevoProducto()">Nuevo
            Producto</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarProducto()">Editar
        Producto</a>
    </div>
    <div id="dlg" class="easyui-dialog" style="width:400px"
         data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3></h3>
            <div style="margin-bottom:10px">
                <input name="pronombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="prodetalle" class="easyui-textbox" required="true" label="Descripcion:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="procantstock" class="easyui-textbox" required="true" label="Cant. Stock:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="proprecio" class="easyui-textbox" required="true" label="Precio:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="proeditorial" class="easyui-textbox" required="true" label="Editorial:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="proautor" class="easyui-textbox" required="true" label="Autor:" style="width:100%">
            </div>
            <div>
                <input name="idproducto " value="idproducto " type="hidden">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarProducto()"
           style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
           onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script type="text/javascript">

        var url;

        function nuevoProducto() {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Poducto');
            $('#fm').form('clear');
            url = '../action/agregarProducto.php';
        }

        function editarProducto() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Poducto');
                $('#fm').form('load', row);
                url = '../action/editarProducto.php';
            }
        }

        function guardarProducto() {
            $('#fm').form('submit', {
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
                        $('#dlg').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
    </script>

<?php
include_once("../structure/footer.php");
?>