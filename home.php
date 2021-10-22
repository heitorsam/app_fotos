<?php 
    session_start();	

    //CABECALHO
    include 'cabecalho.php';

    //ACESSO RESTRITO
    include 'acesso_restrito.php';
?>


<div class="div_br"> </div>

         <!--MENSAGENS-->
         <?php
            include 'js/mensagens.php';
            include 'js/mensagens_usuario.php';
        ?>

        <?php if($_SESSION['sn_app_fotos']=='S'){ ?>

             <!--TITULO-->
            <h11><i class="fas fa-chart-line"></i> Aplicativo Fotos</h11>

            <div class="div_br"> </div>

            <a href="lancamento.php" class="botao_home" type="submit"><i class="fas fa-paper-plane"></i> Lançamentos</a></td></tr>  
            <span class="espaco_pequeno"></span>
    
            <?php if($_SESSION['sn_admin'] == 'S'){ ?>

            <?php } ?> 
            
            </br>
            <div class="div_br"> </div>

        <?php } ?>     

        <?php if($_SESSION['sn_admin'] == 'S'){ ?>
        <!--TITULO-->
        <h11><i class="fa fa-cogs" aria-hidden="true"></i> Administrativo</h11>
        
        <div class="div_br"> </div>

        <!--BOTOES ADM-->        
            <a href="administradores.php" class="botao_home_adm" type="submit"><i class="fas fa-user-cog"></i> Administradores</a></td></tr>
            <span class="espaco_pequeno"></span>

        <?php } ?>
            
<?php
    //RODAPE
    include 'rodape.php';
?>