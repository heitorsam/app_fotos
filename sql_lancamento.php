<?php
//require_once('acesso_restrito.php');?>

<?php
include_once("conexao.php");

//INFORMACOES DO USUARIO
@$login_usuario = $_SESSION['usuarioLogin'];

//RECEBENDO AVISO DE CIRURGIA
@$var_cd_atendimento = filter_input(INPUT_GET, 'cd_atendimento', FILTER_SANITIZE_STRING);

//INFORMACOES DO ARQUIVO 
$arquivo = $_FILES['file'];
$nome_arquivo = $arquivo['name'];
$tamanho = $_FILES['file']['size'];
$arquivo_temp = $arquivo['tmp_name'];
$extensao_arquivo = strrchr( $nome_arquivo, '.' );

//DECLARANDO VARIAVEIS DO ARQUIVO PARA IMPORTACAO PARA O BANCO
$image = file_get_contents($_FILES['file']['tmp_name']);

$consulta_pp_atd = "SELECT a.CD_PACIENTE,a.CD_PRESTADOR FROM ATENDIME A WHERE A.CD_ATENDIMENTO = $var_cd_atendimento";
$result_pp_atd = oci_parse($conn_ora, $consulta_pp_atd);
oci_execute($result_pp_atd);
$row_pp_atd = oci_fetch_array($result_pp_atd);

$var_prestador = $row_pp_atd['CD_PRESTADOR'];
$var_paciente  = $row_pp_atd['CD_PACIENTE'];

// SEQ_ARQUIVO_DOCUMENTO
$consulta_seq_ad = "SELECT SEQ_ARQUIVO_DOCUMENTO.nextval  as SEQ_ARQUIVO_DOCUMENTO FROM DUAL";
$result_seq_ad = oci_parse($conn_ora, $consulta_seq_ad);
oci_execute($result_seq_ad);
$row_seq_ad = oci_fetch_array($result_seq_ad);

// SEQ_ARQUIVO_ATENDIMENTO
$consulta_seq_aa = "SELECT SEQ_ARQUIVO_ATENDIMENTO.nextval as SEQ_ARQUIVO_ATENDIMENTO FROM DUAL";
$result_seq_aa = oci_parse($conn_ora, $consulta_seq_aa);
oci_execute($result_seq_aa);
$row_seq_aa = oci_fetch_array($result_seq_aa);

//SEQ_PW_DOCUMENTO_CLINICO
$consulta_seq_pdc = "SELECT SEQ_PW_DOCUMENTO_CLINICO.nextval as SEQ_PW_DOCUMENTO_CLINICO FROM DUAL";
$result_seq_pdc = oci_parse($conn_ora, $consulta_seq_pdc);
oci_execute($result_seq_pdc);
$row_seq_pdc = oci_fetch_array($result_seq_pdc);

$var_seq_pdc = $row_seq_pdc['SEQ_PW_DOCUMENTO_CLINICO'];
$var_seq_aa = $row_seq_aa['SEQ_ARQUIVO_ATENDIMENTO'];
$var_seq_ad = $row_seq_ad['SEQ_ARQUIVO_DOCUMENTO'];

$consulta_insert_AD = "INSERT INTO dbamv.ARQUIVO_DOCUMENTO 
                                   (cd_arquivo_documento,
                                    tp_extensao,
                                    ds_autor,
                                    ds_origem,
                                    dt_documento,
                                    ds_nome_arquivo,
                                    LO_ARQUIVO_DOCUMENTO)
                            VALUES 
                                   ($var_seq_ad,
                                    UPPER(substr('$extensao_arquivo',2)),
                                    NULL,
                                    NULL,
                                    NULL,
                                    '$nome_arquivo',
                                    empty_blob()) RETURNING LO_ARQUIVO_DOCUMENTO INTO :image";

//echo '<br>' . $consulta_insert_AD . '<br>';

$result_insert_AD = oci_parse($conn_ora, $consulta_insert_AD);
$blob = oci_new_descriptor($conn_ora, OCI_D_LOB);
oci_bind_by_name($result_insert_AD, ":image", $blob, -1, OCI_B_BLOB);
oci_execute($result_insert_AD, OCI_DEFAULT);

if(!$blob->save($image)) {
   oci_rollback($conn_ora);
}
else {
   oci_commit($conn_ora);
}

oci_free_statement($result_insert_AD);
$blob->free();


$consulta_insert_pdc = "INSERT INTO PW_DOCUMENTO_CLINICO
SELECT $var_seq_pdc AS CD_DOCUMENTO_CLINICO,
       2 AS CD_TIPO_DOCUMENTO, 
       NULL AS CD_DOCUMENTO_DIGITAL,
       '$var_paciente' AS CD_PACIENTE, 
       $var_cd_atendimento AS CD_ATENDIMENTO,
       '$login_usuario' AS CD_USUARIO,
       '$var_prestador' AS CD_PRESTADOR,
       'FECHADO' AS TP_STATUS,
       SYSDATE AS DH_REFERENCIA,
       SYSDATE AS DH_CRIACAO,
       SYSDATE AS DH_FECHAMENTO,
       NULL AS DH_IMPRESSO,
       'IMAGEM' AS TP_EXTENSAO,
       NULL AS CD_SETOR,
       222 As CD_OBJETO,
       NULL AS CD_DOCUMENTO_CANCELADO,
       '$nome_arquivo' AS NM_DOCUMENTO,
       NULL AS NM_VERSAO_DOCUMENTO,
       SYSDATE AS DH_DOCUMENTO,
       NULL AS CD_DOCUMENTO_CLINICO_NOVO,
       NULL AS CD_DOC_CLINICO_REFERENCIA,
       NULL AS CD_USUARIO_AUTORIZADOR,
       NULL AS SN_INTEGRA_GREEN,
       NULL AS CD_MULTI_EMPRESA,
       NULL AS SN_CONFIDENCIAL,
       NULL AS QT_VIAS_IMPRESSAS
       FROM DUAL";

$result_insert_pdc = oci_parse($conn_ora, $consulta_insert_pdc);
oci_execute($result_insert_pdc);

$consulta_insert_AA = "INSERT INTO dbamv.ARQUIVO_ATENDIMENTO
SELECT $var_seq_aa AS CD_ARQUIVO_ATENDIMENTO,
       $var_seq_ad AS CD_ARQUIVO_DOCUMENTO,
       $var_cd_atendimento AS CD_ATENDIMENTO,
SYSDATE AS DH_CRIACAO,
'' AS NM_USUARIO,
NULL AS CD_TIPO_DOCUMENTO, 
$var_paciente AS CD_PACIENTE,
NULL AS CD_PW_TIPO_DOCUMENTO,
$var_seq_pdc AS CD_DOCUMENTO_CLINICO,
NULL AS DS_DESCRICAO,
661 AS CD_STATUS_ARQUIVO_ATENDIMENTO,
222 AS CD_OBJETO_SELECIONADO
FROM DUAL";

$result_insert_AA = oci_parse($conn_ora, $consulta_insert_AA);
oci_execute($result_insert_AA);

if($result_insert_AA > 0){
	$_SESSION['msg'] = "Anexo enviado com sucesso!";
   header("Location: lancamento.php?cd_atendimento=$var_cd_atendimento");
}else{
	$_SESSION['msgerro'] = "Anexo não foi enviado!";
	header("Location: lancamento.php?cd_atendimento=$var_cd_atendimento");
}
