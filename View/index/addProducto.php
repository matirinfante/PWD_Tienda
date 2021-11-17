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

    <table id="dg" title="Productos" class="easyui-datagrid"
           url="../action/listarProductos.php" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" style="width:100%;height:350px;">
        <thead>
        <tr>
            <!--<th field="idproducto" width="20">ID</th> -->
            <th field="pronombre" width="150">Nombre</th>
            <th field="prodetalle" width="120">Detalle</th>
            <th field="procantstock" width="60">Cantidad</th>
            <th field="proprecio" width="50">Precio</th>
            <th field="proeditorial" width="70">Editorial</th>
            <th field="proautor" width="50">Autor</th>
        </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevoProducto()">Nuevo Producto</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarProducto()">Editar Producto</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyProducto()">Eliminar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="modificarImagen()">Cargar Imagen</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarStock()">Editar Stock</a>
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
                <input name="idproducto" value="idproducto" type="hidden">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarProducto()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    <div id="dlg2" class="easyui-dialog" style="width:400px"
         data-options="closed:true,modal:true,border:'thin',buttons:'#dlg2-buttons'">
        <form id="fm2" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3></h3>
            <div style="margin-bottom:10px">
                <input name="pronombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="prodetalle" class="easyui-textbox" required="true" label="Descripcion:" style="width:100%">
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
                <input name="idproducto" value="idproducto" type="hidden">
            </div>
            <div>
                <input name="procantstock" value="procantstock" type="hidden">
            </div>
        </form>
    </div>
    <div id="dlg2-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarProducto2()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg2').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    <div id="setImagen" class="easyui-dialog" style="width:400px"
         data-options="closed:true,modal:true,border:'thin',buttons:'#setImagen-buttons'">
        <form id="fmImagen" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Cargar Imagen</h3>
            <div class="col">
                <input type="file" name="imagen" id="imagen" required>
                
                <label for="imagen" class="form-label"><strong>Formato permitido: .jpg</strong></label> 
                <div class="invalid-feedback">Seleccione una imagen de su equipo</div>
            </div>
            <div>
                <input name="idproducto" value="idproducto" type="hidden">
            </div>


        </form>
    </div>
    <div id="setImagen-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarProductoImg()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#setImagen').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    <div id="stock" class="easyui-dialog" style="width:400px"
         data-options="closed:true,modal:true,border:'thin',buttons:'#stock-buttons'">
        <form id="fmStock" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3></h3>
            <div style="margin-bottom:10px">
                <input name="procantstock" class="easyui-textbox" required="true" label="Cant. Stock:" style="width:100%">
            </div>
            
            <div>
                <input name="idproducto" value="idproducto" type="hidden">
                <input name="pronombre" value="pronombre" type="hidden">
                <input name="prodetalle" value="prodetalle" type="hidden">
                <input name="proprecio" value="proprecio" type="hidden">
                <input name="proeditorial" value="proeditorial" type="hidden">
                <input name="proautor" value="proautor" type="hidden">
                <input name="proimagen" value="proimagen" type="hidden">
            </div>
        </form>
    </div>
    <div id="stock-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarStock()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#stock').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    <script type="text/javascript">

        var url;

        function nuevoProducto() {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Producto');
            $('#fm').form('clear');
            url = '../action/agregarProducto.php';
        }

        function editarProducto() {
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg2').dialog('open').dialog('center').dialog('setTitle','Editar Producto');
                $('#fm2').form('load',row); 
                url = '../action/editarProducto.php'; // +row.id
                

            }
        }

        function  modificarImagen() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#setImagen').dialog('open').dialog('center').dialog('setTitle', 'Editar Stock');
                $('#fmImagen').form('load', row);
                url = '../action/modificarImagen.php';
                

            }
        }

        function editarStock() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#stock').dialog('open').dialog('center').dialog('setTitle', 'Editar Stock');
                $('#fmStock').form('load', row);
                url = '../action/editarStock.php';
                

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
        function guardarProducto2() {
            $('#fm2').form('submit', {
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
                        $('#dlg2').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        function guardarProductoImg() {
            $('#fmImagen').form('submit', {
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
                        $('#setImagen').dialog('close');        // close the dialog
                        //$('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        function guardarStock() {
            $('#fmStock').form('submit', {
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
                        $('#stock').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }

        function destroyProducto(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','¿Estás seguro de que quieres eliminar este producto?',function(r){
                    if (r){
                        $('#fm').form('load',row);
                        url = '../action/eliminarProducto.php';
                        $('#fm').form('submit',{
                            url: url,
                            iframe: false,
                            onSubmit: function(){
                                return $(this).form('validate');
                            },
                            success: function(result){
                                var result = eval('('+result+')');
                                if (result.errorMsg){
                                    $.messager.show({
                                        title: 'Error',
                                        msg: result.errorMsg
                                    });
                                } else {
                                    $('#dg').datagrid('reload'); 
                                }
                            }
                        });
                    }
                });
            }
        }
    </script>

<?php
include_once("../structure/footer.php");
?>