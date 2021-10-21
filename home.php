<?php 
    session_start();	

    //CABECALHO
    include 'cabecalho.php';

    //ACESSO RESTRITO
    include 'acesso_restrito.php';

    //SQL
    include 'sql_home.php';
?>


<?php if($_SESSION['sn_lancamentos_pgr']=='S'){ ?>


    <?php if($qtd_pend_pgr > 0){

        if ($qtd_pend_pgr > 1){

            echo "<a href='plano_acao.php' class='link_home_pend'><i class='fas fa-info-circle' style='color: #ffba00;'></i> Existem $qtd_pend_pgr plano de ações pendentes no PGR. </a> </br>";
        
        }else{

            echo "<a href='plano_acao.php' class='link_home_pend'><i class='fas fa-info-circle' style='color: #ffba00;'></i> Existe $qtd_pend_pgr plano de ação pendente no PGR. </a> </br>";

        }

    } ?>

    <?php if($qtd_pend_meri > 0){

        if ($qtd_pend_meri > 1){

            echo "<a href='plano_acao_meritocracia.php' class='link_home_pend'><i class='fas fa-info-circle' style='color: #ffba00;'></i> Existem $qtd_pend_meri plano de ações pendentes na Meritocracia. </a> </br>";

        }else{

            echo "<a href='plano_acao_meritocracia.php' class='link_home_pend'><i class='fas fa-info-circle' style='color: #ffba00;'></i> Existe $qtd_pend_meri plano de ação pendente na Meritocracia. </a> </br>";
        }


    } ?>

<?php } ?>

<div class="div_br"> </div>


        <?php 

            //echo 'Administrador: ' . $_SESSION['sn_admin'];
           // echo '</br> Importar Arquivos: ' . $_SESSION['sn_importar_arquivos'];
            //echo '</br> Cadastrar Pendencias: ' . $_SESSION['sn_pendencias_prontuario'];
            //echo '</br></br>';

        ?>

         <!--MENSAGENS-->
         <?php
            include 'js/mensagens.php';
            include 'js/mensagens_usuario.php';
        ?>

        <?php if($_SESSION['sn_lancamentos_pgr']=='S'){ ?>

            <!--TITULO-->
            <h11><i class="fas fa-chart-line"></i> Gerêncial</h11>
            
            <div class="div_br"> </div>  

            <a href="dashboard.php" class="botao_home" type="submit"><i class="fas fa-chart-pie"></i> Dashboard</a></td></tr>
            
            </br>

            <div class="div_br"> </div>


            <!--TITULO-->
            <h11><i class="fas fa-chart-line"></i> PGR</h11>

            <div class="div_br"> </div>       
            
            <!--<h12>Bem vindo <?php //echo $nome; ?></h12>-->
        
            <!--<div class="div_br"> </div>-->
        
            
            <!--BOTOES-->       
            <a href="lancamentos.php" class="botao_home" type="submit"><i class="fas fa-paper-plane"></i> Lançamentos </a></td></tr>
            <span class="espaco_pequeno"></span>
            <a href="resultados.php" class="botao_home" type="submit"><i class="fas fa-chart-bar"></i> Resultados</a></td></tr>
            <span class="espaco_pequeno"></span>
            <a href="plano_acao.php" class="botao_home" type="submit"><i class="fas fa-pen-alt"></i> Plano de Ações</a></td></tr>
            
            <?php if($_SESSION['sn_admin'] == 'S'){ ?>
            
             
            <?php } ?>


            </br>
            <!--<a href="sair.php" class="botao_home" type="submit"><i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a></td></tr>-->

            <div class="div_br"> </div>

        <?php } ?>


        <?php if($_SESSION['sn_lancamentos_pgr']=='S'){ ?>

             <!--TITULO-->
            <h11><i class="fas fa-chart-line"></i> Meritocracia</h11>

            <div class="div_br"> </div>

            <a href="lancamentos_meritocracia_matriz.php" class="botao_home" type="submit"><i class="fas fa-paper-plane"></i> Lançamentos</a></td></tr>  
            <span class="espaco_pequeno"></span>
            <a href="resultados_meritocracia.php" class="botao_home" type="submit"><i class="fas fa-chart-bar"></i> Resultados</a></td></tr>
            <span class="espaco_pequeno"></span>
            <a href="plano_acao_meritocracia.php" class="botao_home" type="submit"><i class="fas fa-pen-alt"></i> Plano de Ações</a></td></tr>

            <?php if($_SESSION['sn_admin'] == 'S'){ ?>
            
                
            <?php } ?> 
            
            </br>
            <div class="div_br"> </div>

       
        <?php } ?>     
                
        <?php if($_SESSION['sn_importar_arquivos']=='S'){ ?>

        <!--TITULO-->
        <h11><i class="fas fa-file-import"></i> Importações</h11>

        <div class="div_br"> </div>

        <a href="importar_arquivos.php" class="botao_home" type="submit"><i class="fas fa-file-import"></i> Importar Arquivos</a></td></tr>

        </br>
        <div class="div_br"> </div>

        <?php } ?>


        <?php if($_SESSION['sn_pendencias_prontuario']=='S'){ ?>

            <!--TITULO-->
            <h11><i class="far fa-clipboard"></i> Pendências</h11>

            <div class="div_br"> </div>

            <a href="cad_pendencia.php" class="botao_home" type="submit"><i class="fas fa-plus"></i> Cadastrar</a></td></tr>
            <span class="espaco_pequeno"></span>
            <a href="listar_pendencias.php" class="botao_home" type="submit"><i class="fas fa-list"></i> Listar</a></td></tr>  
            <span class="espaco_pequeno"></span>
            <a href="listar_pendencia_indicadores.php" class="botao_home" type="submit"><i class="fas fa-chart-area"></i> Indicadores</a></td></tr>         
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
            <a href="cad_indicador.php" class="botao_home_adm" type="submit"><i class="fas fa-chart-area"></i> Cadastrar Indicador</a></td></tr>
            <span class="espaco_pequeno"></span>
            <a href="listar_indicador.php" class="botao_home_adm" type="submit"><i class="fas fa-list"></i> Listar Indicadores</a></td></tr>
            <span class="espaco_pequeno"></span>
            <a href="cad_setor.php" class="botao_home_adm" type="submit"><i class="fas fa-puzzle-piece"></i> Cadastrar Setor</a></td></tr>
            <span class="espaco_pequeno"></span>
            <a href="permissoes.php" class="botao_home_adm" type="submit"><i class="fa fa-user-lock" aria-hidden="true"></i> Permissões PGR</a></td></tr>
            <span class="espaco_pequeno"></span>
            <a href="permissoes_meritocracia.php" class="botao_home_adm" type="submit"><i class="fa fa-user-lock" aria-hidden="true"></i> Permissões C.C.</a></td></tr>           
            <span class="espaco_pequeno"></span>
            <a href="define_func_setor.php" class="botao_home_adm" type="submit"><i class="fas fa-user-check"></i> Funcionário Setor</a></td></tr>
            <span class="espaco_pequeno"></span>
            <a href="cad_cargo.php" class="botao_home_adm" type="submit"><i class="fas fa-user-tie"></i> Cadastrar Cargo</a></td></tr>

        <?php } ?>
            
<?php
    //RODAPE
    include 'rodape.php';

   

unset($_SESSION['env_lanc_cd_setor'],
    $_SESSION['env_lanc_indicador'],$_SESSION['env_lanc_ano']);
?>
