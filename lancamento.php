<?php 
    session_start();	

    //CABECALHO
    include 'cabecalho.php';

    //ACESSO RESTRITO
    include 'acesso_restrito.php';
    
    include 'conexao.php';

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

<h11><i class="fas fa-paper-plane"></i>Lançamento</h11>
<span class="espaco_pequeno" style="width: 6px;" ></span>
<h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

<div class="div_br"> </div>


<!--MENSAGENS-->
<?php
        include 'js/mensagens.php';
        include 'js/mensagens_usuario.php';
?>
    
<div id="main" class="container-fluid ">

    <div class="row align-self-center">
        <form action="sql_consulta_atd.php" method="post">
            <div class="row align-self-center" style="margin-left: 0px !important; ">

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

    <div class="div_br"> </div>

    <?php
        if(isset($_GET['cd_atendimento']) == @$_SESSION['S_CD_ATENDIMENTO']){
    ?>

    <!--DADOS USUARIO-->
    <form action="">
        <div class="row align-self-center" >
            <div class="form-group col-md-2">
                <label for="name_indicador">Código:</label>
                <input type="text" class="form-control" name="frm_cd_usuario" 
                style="font-size: 14px !important;"
                value="<?php echo @$_SESSION['S_CD_ATENDIMENTO']; ?>" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="name_indicador">Nome Paciente:</label>
                <input type="text" class="form-control" name="frm_chapa"
                style="font-size: 14px !important;"
                value="<?php echo @$_SESSION['S_NM_PACIENTE']; ?>" disabled>
            </div>

            <div class="form-group col-md-3">
                <label for="name_indicador">Convenio:</label>
                <input type="text" class="form-control" name="frm_nm_usuario"
                style="font-size: 14px !important;"
                value="<?php echo @$_SESSION['S_NM_CONVENIO']; ?>" disabled>
            </div>

            <div class="form-group col-md-3">
                <label for="name_indicador">Tipo de Atendimento:</label>
                <input type="text" class="form-control" name="frm_ds_funcao"
                style="font-size: 14px !important;"
                value="<?php echo @$_SESSION['S_DS_TP_ATENDIMENTO']; ?>" disabled>
            </div>
        </div>
    </form>

     <!--DADOS USUARIO-->
     <form action="sql_lancamento.php?cd_atendimento=<?php echo @$_SESSION['S_CD_ATENDIMENTO']; ?>" method="post" id="form_anexo" enctype="multipart/form-data">
        <div class="row align-self-center" >
            <div class="form-group col-md-3">
                <label for="frm_nm_doc">Nome Documento:</label>
                <input type="text" class="form-control" name="frm_nm_doc"
                style="font-size: 14px !important;"
                value="" required>
            </div>
            
            <div class="form-group col-md-3">
                <label for="frm_tp_doc">Tipo do documento:</label>
                <select class="form-control" id="" name="" required>
                    <option value="">Selecione uma opção: </option>
                    <option value="IMAGEM">Imagem</option>
                </select>
            </div>

            <div class="form-group col-md-4">
            <label for="frm_doc">Arquivo:</label>
            <br>
            <input type="file" accept="image/png, image/jpeg" id='file' name='file' required>
            </div>
            
            <div class="form-group col-md-2">
            <label for="name_indicador"></label>
            <br>
            <button class='btn btn-primary' type='submit' form='form_anexo' value='Submit'>
				<i class='fa fa-paper-plane-o' aria-hidden='true'></i> Enviar</button>
            </div>

        </div>
    </form>

    <?php
        }
    ?>
</div>
<?php
    //RODAPE
    include 'rodape.php';
?>