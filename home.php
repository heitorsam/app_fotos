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
            <h11><i class="fas fa-camera"></i> Fotos</h11>

            <div class="div_br"> </div>

            <a href="lancamento.php" class="botao_home" type="submit"><i class="fas fa-paper-plane"></i> Lançamentos</a></td></tr>  
            <span class="espaco_pequeno"></span>

            </br>
            <div class="div_br"> </div>

        <?php } ?>                 
<?php
    //RODAPE
    include 'rodape.php';
?>