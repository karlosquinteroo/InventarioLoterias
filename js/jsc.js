//funcion que sube, oculta o guarda el div de agregar el proveedor
function up_div_pro()
{ 
    var nombreprov=$("#nombreprov").val();
    var provexist=$("#provexist").val();
    var direcprov=$("#direcprov").val();
    var telefprov=$("#telefprov").val();
    var rifprov=$("#rifprov").val();
    var muniprov=$("#muniprov").val();
    var tipo_ingreso =$("#tipo_ingreso").val();      
    if( $("#provexist").val() == 0 )
    {
        if( nombreprov =="" || direcprov =="" || telefprov =="" || rifprov=="" || muniprov=="" || tipo_ingreso=="0" )
        {
            if ( nombreprov =="" ) 
            {
                $("#nombreprov").css("border-color", "#9a1616");
            }
            if (direcprov =="" ) 
            {
                $("#direcprov").css("border-color", "#9a1616");
            }
            if ( telefprov =="" ) 
            {
                $("#telefprov").css("border-color", "#9a1616");
            }
            if ( rifprov=="" ) 
            {
                $("#rifprov").css("border-color", "#9a1616");
            }
            if ( muniprov=="0" ) 
            {
                $("#muniprov").css("border-color", "#9a1616");
            }
            if ( tipo_ingreso=="" ) 
            {
                $("#tipo_ingreso").css("border-color", "#9a1616");
            }
            alert("Debe completar todos los campos del proveedor");
        }
        else
        {
            if( $("#provexist").val() == 0 )
            {
                $("label[for='me']").text($("#nombreprov").val());
            }
            else
            {
               $("label[for='me']").text($("#provexist option:selected").text()); 
            }
            $("#addmore").hide( 'bounce' , { times: 0.8 , direction: "up"}, 500 );
        }
    }
    else
    {
        if( tipo_ingreso=="0" )
        {
            if ( tipo_ingreso=="" ) 
            {
                $("#tipo_ingreso").css("border-color", "#9a1616");
            }
            alert("Debe seleccionar un tipo de ingreso");
        }
        else
        {
            if( $("#provexist").val() == 0 )
            {
                $("label[for='me']").text($("#nombreprov").val());
            }
            else
            {
               $("label[for='me']").text($("#provexist option:selected").text()); 
            }
            $("#addmore").hide( 'bounce' , { times: 0.8 , direction: "up"}, 500 );
        }
    }  
}
//funcion que muestra , enseña el div de agregar el proveedor
function down_div_pro()
{
	$("#addmore").effect( 'bounce' , { times: 0.8	, direction: "up"}, 500 );
}

function down_div_auth()
{
	$("#auth").effect( 'bounce' , { times: 0.8	, direction: "up"}, 500 );
}
function up_div_auth()
{
	$("#auth").hide( 'bounce' , { times: 0.8	, direction: "up"}, 500 );
}
//funcion que muestra , enseña el div de agregar el proveedor
function busqueda_eliminar()
{
	$("#result_busqueda").css({"visibility":"visible"});
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//mostrar opciones segun tipo de articulo/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function mostrarsimcard(sim)
{
	if(sim.value=="9")
	{
		$("#SimCard").slideDown("slow");
		$("#Otros").slideUp("slow");
	}
	else
	{
		$("#SimCard").slideUp("slow");
		$("#Otros").slideUp("slow");
	}
	if(sim.value=="21")
	{
		$("#Otros").slideDown("slow");
	}

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//mostrar opciones segun tipo de articulo/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function mostraringreso(aporte)
{
	if(aporte.value=="2")
	{
		$("#aporte").slideDown("slow");
	}
	else
	{
		$("#aporte").slideUp("slow");
	}

}
//mostrar o no formulario de proveedor /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function mostrar_formulario(prov)
{
	if(prov.value==0)
	{
		$("#proveedor_existente").slideDown("slow");
	}
	else
	{
		$("#proveedor_existente").slideUp("slow");
	}
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//busqueda de articulo//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var ajax;
function buscar_articulo()
{
    if( window.XMLHttpRequest ){
        ajax = new XMLHttpRequest();
        } // No Internet Explorer
    else{
        ajax = new ActiveXObject("Microsoft.XMLHTTP"); // Internet Explorer
    }
     ajax.onreadystatechange = funcionCallback_buscar();
    
     var sw_bdel_art=$("#sw_bdel_art").val();
     var serial_busqueda=$("#serial_busqueda").val();
     alert( sw_bdel_art );
     alert( serial_busqueda );

    ajax.open( "GET", "del.php?sw_bdel_art="+sw_bdel_art+"&serial_busqueda="+serial_busqueda+"", true ); 
    ajax.send( "" );
}

function funcionCallback_buscar()
{
    // Comprobamos si la peticion se ha completado (estado 4)
    if( ajax.readyState == 4 )
    {
        // Comprobamos si la respuesta ha sido correcta (resultado HTTP 200)
        if( ajax.status == 200 )
        {
            // Escribimos el resultado en la pagina HTML mediante DHTML
            document.all.busqueda.innerHTML = "<b>"+ajax.responseText+"</b>";
        }
    }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//busqueda avanzada//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function prueba()
{
    $("#div_carga").css("display", "inline");
    var codigo=$("#co_busqueda").val();
    var serial=$("#se_busqueda").val();
    var ubicacion=$("#agencia_buscar").val();

    $("#prueba").load("nuevo.php",{cod:codigo, ser:serial}, function(){$("#div_carga").css("display", "none");});
    
}
var global_ubicacion;
 function muestra(esto)
{
    var valors=esto.value; 
    var mystring = valors.split(".");
    var id= mystring[0];
    var articulo_a = mystring[1];
    var g_l = global_ubicacion;
    confirmar = confirm("Desea realizar esta actualizacion?");
    if(confirmar)
    {
        $("#resultado_e").load("update_art.php",{ id:id, art:articulo_a, localizacion:g_l} );
        $("#div_carga").css("display", "inline");
        ubicacion = g_l;
        $("#prueba").load("agency_control.php",{ ubica:ubicacion}, function(){$("#div_carga").css("display", "none");} );

    }  
}

function recarga()
{
    location.reload(true);
}

function edo(estado)
{
    $("#div_carga").css("display", "inline");
    var estado=$("#estado_buscar").val();
    $("#prueba").load("edo.php",{ edo:estado}, function(){$("#div_carga").css("display", "none");} );
}

function tip(tipo)
{
    $("#div_carga").css("display", "inline");
    var tipo=$("#tipo_buscar").val();
    $("#prueba").load("tip.php",{ tip:tipo}, function(){$("#div_carga").css("display", "none");} );
}

function ubi(ubica)
{
    $("#div_carga").css("display", "inline");
    var ubicacion=ubica.value;
    $("#prueba").load("ubica.php",{ ubica:ubicacion}, function(){$("#div_carga").css("display", "none");} );
}
function ubi_1(ubica_1)
{
    $("#div_carga").css("display", "inline");
    var ubicacion=ubica_1.value;
    global_ubicacion = ubicacion;
    $("#prueba").load("agency_control.php",{ ubica:ubicacion}, function(){$("#div_carga").css("display", "none");} );
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//addarticle//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_article()
{
    var nombreprov=$("#nombreprov").val();
    var provexist=$("#provexist").val();
    var direcprov=$("#direcprov").val();
    var telefprov=$("#telefprov").val();
    var rifprov=$("#rifprov").val();
    var muniprov=$("#muniprov").val();
    var tipo_ingreso =$("#tipo_ingreso").val();
    var serial =$("#serial").val();
    var descripcion =$("#descrip").val();
    var precio =$("#precio").val();
    var deposito =$("#almacen").val();
    var cantidad=$("#cantidad").val();
    var tipo_articulo =$("#tipo_articulo").val();
    var costo_plan =$("#costo_plan").val();
    var fecha_plan =$("#fecha_plan").val();
    var detarti =$("#detarti").val();
    var fabricante =$("#fabricante").val();

    if( serial =="" || serial ==" " || descripcion =="" || descripcion ==" " || precio =="" || precio ==" " || deposito=="0" || tipo_articulo=="0" || fabricante=="" || fabricante==" " )
    {
        if ( serial =="" || serial ==" " ) 
        {
            $("#serial").css("border-color", "#9a1616");
        }
        if (descripcion =="" || descripcion =="" ) 
        {
            $("#descrip").css("border-color", "#9a1616");
        }
        if ( precio =="" || descripcion ==" " ) 
        {
            $("#precio").css("border-color", "#9a1616");
        }
        if ( deposito=="0" ) 
        {
            $("#almacen").css("border-color", "#9a1616");
        }
        if ( tipo_articulo=="0" ) 
        {
            $("#tipo_articulo").css("border-color", "#9a1616");
        }
        if ( fabricante=="" || fabricante==" " ) 
        {
            $("#fabricante").css("border-color", "#9a1616");
        }
        if ( fabricante=="" ) 
        {
            $("#fabricante").css("border-color", "#9a1616");
        }
        if( tipo_articulo== 9)
        {
            if( costo_plan=="" || costo_plan==" " || fecha_plan=="" )
            {
                if( costo_plan=="" || costo_plan==" " )
                {
                    $("#costo_plan").css("border-color", "#9a1616");
                }
                if( fecha_plan=="" )
                {
                    $("#fecha_plan").css("border-color", "#9a1616");
                }
            }
        }
        if( tipo_articulo == 21 )
        {
            if(detarti=="" || detarti ==" ")
            {
                $("#detarti").css("border-color", "#9a1616");
            }
        }
        alert("Debe completar todos los campos");
    }
    else
    {
        confirmar = confirm("Esta Seguro Que Desea Realizar Esa Asignacion ?");
        if(confirmar)
        {
            $("#div_carga").css("display", "inline");
            $("#resultado").load("add.php",{nombreprov:nombreprov, provexist:provexist, direcprov:direcprov, telefprov:telefprov, 
            rifprov:rifprov, muniprov:muniprov, tipo_ingreso:tipo_ingreso, serial:serial, descripcion:descripcion, precio:precio,
            deposito:deposito, cantidad:cantidad, tipo_articulo:tipo_articulo, costo_plan:costo_plan, fecha_plan:fecha_plan, detarti:detarti,
            fabricante:fabricante}, function(){$("#div_carga").css("display", "none");} );
            limpia();
        }
    }

}

function limpia()
{
    $("#serial").val('');
    $("#descrip").val('');
    $("#precio").val('');
    $("#almacen").val($("#almacen").children('option:first').val());
    $("#cantidad").val($("#cantidad").children('option:first').val());
    $("#tipo_articulo").val($("#tipo_articulo").children('option:first').val());
    $("#costo_plan").val('');
    $("#fecha_plan").val('');
    $("#detarti").val('');
    $("#fabricante").val('');
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//addarticle//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var cadenasw;
var articulos = new Array();
var cantidades = new Array();
var i=0;
var agencia_detalle;


function go_asiga()
{   
   var agencia_detalle=$("#agencia_detalle").val();
   window.location.href="assign_det.php?cod="+agencia_detalle;
}


function seleccion(form)
{	
	var checked = new Array();
	$('input[name="radiogroup[]"]:checked').each(function(){
	checked.push( $(this).val() );
	});

	var canti = new Array();
	$('cant').each(function(index, value){
	canti.push( $(this).val() );
	});

    articulos = canti
    cantidades =checked;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//addarticle//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function edo_in(estado_i)
{
    $("#div_carga").css("display", "inline");
    var estado=$("#estado_in").val();
    window.location="invent_edo.php?estado="+estado+"";
    $("#prueba_in").load("invent_edo.php",{ estado:estado}, function(){$("#div_carga").css("display", "none");} );
    
}
function tipo_in(tipo_i)
{
    $("#div_carga").css("display", "inline");
    var tipo=$("#tipo_in").val();
    window.location="invent_tipo.php?tipo="+tipo+"";
    $("#prueba_in").load("invent_tipo.php",{ tipo:tipo}, function(){$("#div_carga").css("display", "none");} );
}
function ubica_in(ubica_i)
{
    $("#div_carga").css("display", "inline");
    var agencia=$("#agencia_in").val();
    window.location="invent_agencia.php?agencia="+agencia+"";
    $("#prueba_in").load("invent_agencia.php",{ agencia:agencia}, function(){$("#div_carga").css("display", "none");} );
}

function total_in()
{
    $("#div_carga").css("display", "inline");
    window.location="invent_total.php";
    $("#div_carga").css("display", "none"); 
}
    

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//addarticle//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_agency()
{
	var nombre=$("#nombre_agen").val();
    var code=$("#code_agen").val();
	var direccion=$("#direccion_agen").val();
	var telef=$("#telefono_agen").val();
	var rif=$("#rif_agen").val();
	var encargado=$("#encar_agen").val();
	var municipio=$("#muni_agen").val();
	var princi=$("#agen_pri").val();
	var correo=$("#correo_agen").val();
    var nombre_f=nombre+' - '+code;
	if(nombre =="" ||code =="" || direccion =="" ||telef =="" ||rif =="" ||encargado =="" ||municipio =="seleccione" ||princi =="seleccione" ||correo ==""  )
	{
		alert("Debe rellenar todos los campos");
	}
	else
	{
		confirmar = confirm("Desea agregar esta agencia ?");
		if(confirmar)
		{
   			$("#resultado_add").load("angency_add.php",{ nombre:nombre_f, direccion:direccion, correo:correo, telef:telef, rif:rif, encargado:encargado, municipio:municipio, princi:princi });
   		}
   	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//addarticle//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function del_agency(del)
{
	var id_agen=del;
	confirmar = confirm("Desea desincorporar esta agencia ?");
	if(confirmar)
	{
		$("#resultado_e").load("agency_del.php",{ id_agen:id_agen });
        setTimeout("location.reload()",1000);
	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//addarticle//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function add_user()
{
    var pnombre=$("#pnombre").val();
    var snombre=$("#snombre").val();
    var papellido=$("#papellido").val();
    var sapellido=$("#sapellido").val();
    var ci=$("#ci").val();
    var prioridad=$("#prioridad").val();
    var correo =$("#correo").val();
    var telefono =$("#telefono").val();
    var fnacimiento =$("#fnacimiento").val();
    var agencia =$("#agencia").val();

    var nusuario=pnombre+'.'+papellido;
    nusuario= nusuario.toLowerCase();
    var uno=(Math.floor(Math.random()*324)+25).toString();
    var dos = (Math.floor(Math.random()*321)+25).toString();
    var tres = (Math.floor(Math.random()*876)+25).toString();
    var pass =uno+dos+tres;  
    
    if( pnombre =="" || papellido =="" || ci =="" || prioridad =="" || correo =="" || telefono  =="" || fnacimiento =="" || agencia =="" )
    {
         alert("Debe rellenar toos los campos que son obligatorios");
    }
    else
    {
        confirmar = confirm("Esta Seguro Que Desea Realizar Esa Asignacion ?");
        if(confirmar)
        {
            $("#resultado_user").load("add_user.php",{pnombre:pnombre, snombre:snombre, papellido:papellido, sapellido:sapellido, 
            ci:ci, prioridad:prioridad, correo:correo, telefono:telefono, telefono:telefono, fnacimiento:fnacimiento,
            agencia:agencia, nusuario:nusuario,pass:pass});
            alert("Ingreso exitoso");
        }
       
    }
    
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function track()
{
    $("#div_carga").css("display", "inline");
    var cod = $("#co_busqueda_art").val();
    $("#track_res").load("track_bus.php",{cod:cod}, function(){$("#div_carga").css("display", "none");} );

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
