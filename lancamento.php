<?php 
    session_start();	

    //CABECALHO
    include 'cabecalho.php';

    //ACESSO RESTRITO
    include 'acesso_restrito.php';

    $var_nm_paciente_ped = NULL;
    if(@$_SESSION['S_NM_PACIENTE'] <> NUll){
        $var_nm_paciente_ped = @$_SESSION['S_NM_PACIENTE'];
    }

    $var_ds_tp_atd_ped = NULL;
    if(@$_SESSION['S_DS_TP_ATENDIMENTO'] <> NUll){
        $var_ds_tp_atd_ped = @$_SESSION['S_DS_TP_ATENDIMENTO'];
    }

    $var_nm_convenio_ped = NULL;
    if(@$_SESSION['S_NM_CONVENIO'] <> NUll){
        $var_nm_convenio_ped = @$_SESSION['S_NM_CONVENIO'];
    }    
?>

<h11><i class="fas fa-plus"></i> Lançamento</h11>
<span class="espaco_pequeno" style="width: 6px;" ></span>
<h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

<div class="div_br"> </div>


<!--MENSAGENS-->
<?php
        include 'js/mensagens.php';
        include 'js/mensagens_usuario.php';
?>
    
    <div id="main" class="container-fluid">

<div class="row align-self-center">
    <form action="sql_consulta_atd.php" method="post">
        <div class="row">
            <div class="input-group col-md-12">
                <label>Atendimento:</label>
            </div>
            
            <div class="input-group col-md-9">    
            <?php if(isset($_GET['cd_atendimento']) == null){?>
                <input type="number" class="form-control" name="ps_atendimento" required min="0" placeholder="Atendimento"></input>
            <?php }else{ ?>
                <input type="number" class="form-control" name="ps_atendimento" required min="0" value="<?php echo $_GET['cd_atendimento'];?>"></input>
            <?php }; ?>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>



<?php
    //RODAPE
    include 'rodape.php';
?>