<?php 
    session_start();	

    //CABECALHO
    include 'cabecalho.php';

    //ACESSO RESTRITO
    include 'acesso_restrito.php';
?>

<h11><i class="fas fa-paper-plane"></i> Lançamento</h11>
<h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27>

</br>

 <!--MENSAGENS-->
 <?php
        include 'js/mensagens.php';
        include 'js/mensagens_usuario.php';
?>



<?php
    //RODAPE
    include 'rodape.php';
?>