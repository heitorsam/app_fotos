<?php

//CONEXAO
include 'conexao.php';
session_start();	

//////////////////////
// LIMPANDO SESSION //
//////////////////////

if(isset($_POST['ps_atendimento'])){

  $_SESSION['S_CD_ATENDIMENTO'] = NULL;
  $_SESSION['S_NM_PACIENTE'] = NULL;
  $_SESSION['S_NM_CONVENIO'] = NULL;
  $_SESSION['S_DS_TP_ATENDIMENTO'] = NULL;

  $var_ps_atendimento = $_POST['ps_atendimento'];

  $var_endereco_paginas = "lancamento.php";
  $var_endereco_paginas_dentro = "lancamento.php?cd_atendimento=".$var_ps_atendimento;

      //////////////////////////
      // CONSULTA ATENDIMENTO //
      //////////////////////////

      $consulta_atendimento_pend ="SELECT atd.*, conv.NM_CONVENIO, pac.nm_paciente,
                                    CASE
                                      WHEN atd.TP_ATENDIMENTO = 'U' THEN 'URGÊNCIA'
                                      WHEN atd.TP_ATENDIMENTO = 'I' THEN 'INTERNAÇÃO'
                                      WHEN atd.TP_ATENDIMENTO = 'A' THEN 'AMBULATÓRIO'
                                      WHEN atd.TP_ATENDIMENTO = 'E' THEN 'EMERGÊNCIA'
                                    END AS DS_TP_ATENDIMENTO
                                      FROM dbamv.ATENDIME atd
                                    INNER JOIN dbamv.CONVENIO conv
                                        ON conv.CD_CONVENIO = atd.CD_CONVENIO
                                    INNER JOIN DBAMV.PACIENTE pac
                                        ON pac.CD_PACIENTE = atd.CD_PACIENTE
                                    WHERE CD_ATENDIMENTO = '$var_ps_atendimento'";

      $result_atendimento_pend = oci_parse($conn_ora, $consulta_atendimento_pend);

      oci_execute($result_atendimento_pend);

      $row_atendimento_pend = oci_fetch_array($result_atendimento_pend);

      if(oci_num_rows($result_atendimento_pend) == 0 AND $var_ps_atendimento <> ''){
          																			
          $_SESSION['msgerro'] = 'Atendimento não existe!';
          header('location: '. $var_endereco_paginas); 
          return 0;

      } else {

          $_SESSION['S_CD_ATENDIMENTO'] = $row_atendimento_pend['CD_ATENDIMENTO'];
          $_SESSION['S_NM_PACIENTE'] = $row_atendimento_pend['NM_PACIENTE'];
          $_SESSION['S_NM_CONVENIO'] = $row_atendimento_pend['NM_CONVENIO'];
          $_SESSION['S_DS_TP_ATENDIMENTO'] = $row_atendimento_pend['DS_TP_ATENDIMENTO'];

          unset($_SESSION['msgerro']);
          
          header('location: '.$var_endereco_paginas_dentro);
          return 0;

      }   
  }
?>