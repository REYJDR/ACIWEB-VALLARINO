<script type="text/javascript">
// ********************************************************
// * Aciones cuando la pagina ya esta cargada
// ********************************************************
$(window).load(function(){
   

$('#ERROR').hide();

modal_job_list();

});
</script>

<!--INI DIV ERRO-->
<div id="ERROR" ></div>

<!--ERROR -->

<div id="ErrorModal" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" onclick="javascript:history.go(-1);" class="close" data-dismiss="modal">&times;</button>
        <h3 >Error</h3>
      </div>

      <div class="col-lg-12 modal-body">

      <!--ini Modal  body-->  

            <div id='ErrorMsg'></div>

      <!--fin Modal  body-->

      </div>

      <div class="modal-footer">

        <button type="button" onclick="javascript:history.go(-1); return true;" data-dismiss="modal" class="btn btn-primary" >OK</button>

      </div>

    </div>

  </div>

</div>

<!--modal-->
<!--INI DIV ERROR-->

<?php
error_reporting(0);



//GET ACCOUNT INFO
if($id){

$sql = 'SELECT * FROM SAX_USER  where SAX_USER.onoff="1" and SAX_USER.id="'.$id.'";';
 
$res = $this->model->Query($sql);
 
foreach ($res as $value) {

	$value = json_decode($value);
	

	$id = $value->{'id'};
	$name = $value->{'name'};
	$lastname = $value->{'lastname'};
	$email = $value->{'email'};
	$pass = $value->{'pass'};
	$role= $value->{'role'};
	$INF_OC= $value->{'notif_oc'};
	$INF_rol_1= $value->{'role_purc'};
	$INF_rol_2= $value->{'role_fiel'};

	if($INF_OC==1){//notificaciones

	$notif_oc = 'checked';

	}else{

	$notif_oc = '';	
	}

	if($INF_rol_1==1){

	$rol_purc_value = 'checked';

	}else{

	$rol_purc_value= '';	
	}

	if($INF_rol_2==1){

	$rol_field_value = 'checked';

	}else{

	$rol_field_value = '';	
	}

}

if($this->model->active_user_role!='admin'){ 
	$notif_oc .= ' disabled';
	$rol_purc_value .= ' disabled';
	$rol_field_value .= ' disabled';

	 }


//UPDATE INFORMATION
if($_POST['flag2']=='1'){


	if($this->model->active_user_role=='admin'){ 

		if($_POST['oc_chk']==true){//notificaciones

		$not_oc_value = '1';

		}else{

		$not_oc_value = '0';	
		}

		if($_POST['rpurch_chk']==true){//notificaciones

		$rol_purc_value = '1';

		}else{

		$rol_purc_value= '0';	
		}

		if($_POST['rfield_chk']==true){//notificaciones

		$rol_field_value = '1';

		}else{

		$rol_field_value = '0';	
		}

	}

$pass_ck = $this->model->Query_value('SAX_USER','pass','where SAX_USER.onoff="1" and SAX_USER.id="'.$id.'"');


	if($pass_ck==$_POST['pass_22']){

	$pass==$_POST['pass_22'];

	}else{

	$pass = md5($_POST['pass_22']);
		
	}

if($this->model->active_user_role!='admin'){ 
		
	$columns  = array( 'name' => $_POST['name2'],
					   'lastname' => $_POST['lastname2'],
					   'pass' => $pass,

						);
}else{

	$columns  = array(  'name' => $_POST['name2'],
						'lastname' => $_POST['lastname2'],
						'pass' => $pass,
						'role'=> $_POST['priv'],
						'notif_oc' => $not_oc_value,
						'role_purc' => $rol_purc_value,
						'role_fiel' => $rol_field_value
						);

}					


$clause = 'id="'.$_POST['user_2'].'"';

$this->model->update('SAX_USER',$columns,$clause);




echo '<script>alert("Se ha actualizado los datos con exito");

self.location="'.URL.'index.php?url=home/edit_account/'.$id.'";


</script>';
}



}

?>

<div class="col-lg-3"></div>
<div class="page col-lg-6">

<div  class="col-lg-12">
<!-- contenido -->
    <!-- Modal content-->
    <div >
      <div >
       
        <h3 >Cuenta de Usuario</h3>

<div class="separador col-lg-12"></div>
<fieldset>
<form action="" enctype="multipart/form-data" method="post" role="form" class="form-horizontal">

<input type="hidden" id="user_2" name="user_2" value="<?php echo $id; ?>" />

<!-- <div class="col-lg-12" > 
	<label class="col-lg-2 control-label" for="tagsinput-1">Compa&ntildeia/Cliente</label>
	 <div class="col-lg-6" > 
	<input type="text" class="form-control" id="cli" name="cli"  readonly/>
	</div>
</div> -->
<div class="separador col-lg-12"></div>

<div class="col-lg-6" > 
	<label class="col-lg-4 control-label" >Nombre</label>							
	<div class="col-lg-8">								
	
	<input type="text" class="form-control" id="name2" name="name2"  value="<?php echo $name; ?>" required/>
	
	</div>
</div>

<div class="col-lg-6" > 
	<label class="col-lg-4 control-label" >Apellido</label>						
	<div class="col-lg-8">								
	
	<input type="text" class="form-control" id="lastname2" name="lastname2"  value="<?php echo $lastname; ?>" required/>
	
	</div>
</div>
<div class="separador col-lg-12"></div>

<div class="col-lg-12" > 
	<label class="col-lg-2 control-label" for="tagsinput-1"> Email</label>								
	<div class="col-lg-8">								
	<div class="input-group">
	<input type="text" class="form-control" name="email2" id="email2"  value="<?php echo $email; ?>"readonly/>		
	<span class="input-group-addon"><i class= "fa fa-envelope-o"></i></span>
	</div>
	</div>
</div>
<div class="separador col-lg-12"></div>
<div class="col-lg-12" > 
	<label class="col-lg-2 control-label" >Password</label>						
	<div class="col-lg-4">								
	
	<input type="password" class="form-control" id="pass_12" name="pass_12"  value="<?php echo $pass; ?>" required/>
	
	</div>
</div>
<div class="separador col-lg-12"></div>
<div class="col-lg-12" > 
	<label class="col-lg-2 control-label" >Repetir Password</label>					
	<div class="col-lg-4">								
	
	<input type="password" class="form-control" id="pass_22" name="pass_22" value="<?php echo $pass; ?>" required/>
	
	</div>
</div>
<div class="separador col-lg-12"></div>
<div class="col-lg-12" > 
	<label class="col-lg-2 control-label" for="tagsinput-2">Privilegio</label>					
	<div class="col-lg-3">
     <input type="text" class="form-control" id="priv" name="priv" value="<?php echo $role; ?>" readonly/>
	
     </div>
</div>	
<input type="hidden"  name="flag2" value="1" />

<div class="title col-lg-12"></div>
<div class="col-lg-6">
<fieldset>
<legend><h4>Notificaciones</h4></legend>
<input type="CHECKBOX" name="oc_chk"  <?php echo $notif_oc; ?> />&nbsp<label>Requisiciones</label>

</fieldset>
</div>
<div class="col-lg-6">
<fieldset>
<legend><h4>Rol de usuario</h4></legend>
<input type="CHECKBOX" name="rpurch_chk" <?php echo $rol_purc_value; ?> />&nbsp<label>Oficina</label> <p class="help-block">(Crea órdenes de compra y actualiza fechas de inicio de cotización)</p>
<input type="CHECKBOX" name="rfield_chk" <?php echo $rol_field_value; ?> />&nbsp<label>Campo</label><p class="help-block">(Crea requisiciones y reporta cantidades/fechas recibidas en órdenes de compra)</p>
</fieldset>
</div>

<div class="title col-lg-12"></div>
<div class="col-lg-4">
<?php if ($INF_rol_2 == 1 && $this->model->active_user_role == 'admin'){  ?>
	
<a title="modificar Item" data-toggle="modal" data-target="#jobModal"  href="javascript:void(0)" >
<input type="button" id="modify_button" name="modify_button"  class="btn btn-warning btn-sm btn-icon icon-left" value="Asignar Proyectos"/></a>

<?php } ?>
</div>
<div class="col-lg-2"></div>

<div class="col-lg-4">
<button   class="btn btn-primary  btn-block text-left" type="submit" >Actualizar</button>
</div>		

</form>
<?php if($this->model->active_user_role=='admin'){  ?>
	<div class="col-lg-2">
	<button  onclick="erase_user('<?php echo URL; ?>');" class="btn btn-danger btn-sm btn-icon icon-left"  >Eliminar</button>
	</div>	
<?php } ?>
</fieldset>
<div class="separador col-lg-12"></div>


      <!-- -->
     </div>
   </div>
 </div>
</div>

<!-- Modal : Modificacion de proyecto-->
<div id="jobModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 >Asignacion de Proyecto</h3>
      </div>

      <div class="col-lg-12 modal-body">
        
      <div id='prod'></div>

        <div class="col-lg-3" > 
             <label class="control-label">Usuario :</label>
             <input  class="form-control" id="job_id_modal" name="job_id_modal"  readonly/>
             
        </div>        
          
      <div class="separador col-lg-12" ></div>  
      
      <fieldset>
       <div id='job_list'></div>
      </fieldset>
      

      </div>
      <div class="modal-footer">
        <button type="button" onclick="modify_assigment();" class="btn btn-primary" data-dismiss="modal">Asignar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">


	
function modal_job_list(){

$('#job_list').html(''); //LIMPIO LA TABLA PRIMERO

var id = document.getElementById('user_2').value;

var name = document.getElementById('name2').value +' '+document.getElementById('lastname2').value;

document.getElementById('job_id_modal').value = name;


URL = document.getElementById('URL').value;

var datos= "url=ges_proyectos/list_job_modal/"+id;
   
var link= URL+"index.php";




  $.ajax({
      type: "GET",
      url: link,
      data: datos,
      success: function(res){
      
       $('#job_list').html(res);

        }
   });

     


}


function modify_assigment(){


LineArray = [];

var theTbl = document.getElementById('table_job'); //objeto de la tabla que contiene los datos de items

var userid = document.getElementById('user_2').value;

var name = document.getElementById('name2').value +' '+document.getElementById('lastname2').value;


var R = confirm('Desea modificar los proyectos asignados a : '+name+' ?');

  if (R==true) {


  	for(var i=1; i<theTbl.rows.length ;i++) //BLUCLE PARA LEER LINEA POR LINEA LA TABLA theTbl

	{

  		var chk = document.getElementById(i).checked;
  		
        	 if(chk){

              		
                            jobid       = theTbl.rows[i].cells[1].innerHTML;
                            desc = theTbl.rows[i].cells[2].innerHTML;
                            

                            LineArray[i] = jobid+'@'+desc+'@'+userid;               
                     

                            
                       }
                  

       } //FIN BLUCLE PARA LEER CELDA POR CELDA DE CADA LINEA
       
    URL = document.getElementById('URL').value;
    var link= URL+"index.php";

         $.ajax({

         type: "GET",

         url:  link,

         data:  {url: 'ges_proyectos/set_assigment/'+userid , Data : JSON.stringify(LineArray)}, 

         success: function(res){

            alert('Asignacion Completada!');

            
        	}

        }); 

   

  }
}






</script>

