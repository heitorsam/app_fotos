CREATE USER appfotos IDENTIFIED BY sta_24_032022_1743_jsc;

GRANT CREATE SESSION TO appfotos;
GRANT CREATE PROCEDURE TO appfotos;
GRANT CREATE TABLE TO appfotos;
GRANT CREATE VIEW TO appfotos;
GRANT UNLIMITED TABLESPACE TO appfotos;
GRANT CREATE SEQUENCE TO appfotos;

GRANT EXECUTE ON dbasgu.FNC_MV2000_HMVPEP TO appfotos;

GRANT SELECT ON dbasgu.USUARIOS TO appfotos;
GRANT SELECT ON dbasgu.PAPEL_USUARIOS TO appfotos;
GRANT SELECT ON dbamv.ATENDIME TO appfotos;
GRANT SELECT ON dbamv.CONVENIO TO appfotos;
GRANT SELECT ON dbamv.PACIENTE TO appfotos;
GRANT SELECT ON dbamv.SEQ_ARQUIVO_DOCUMENTO TO appfotos;
GRANT SELECT ON dbamv.SEQ_ARQUIVO_ATENDIMENTO TO appfotos;
GRANT SELECT ON dbamv.SEQ_PW_DOCUMENTO_CLINICO TO appfotos;
GRANT SELECT ON dbamv.ARQUIVO_DOCUMENTO TO appfotos;
GRANT SELECT ON dbamv.PW_DOCUMENTO_CLINICO TO appfotos;
GRANT SELECT ON dbamv.ARQUIVO_ATENDIMENTO TO appfotos;
GRANT INSERT ON dbamv.ARQUIVO_DOCUMENTO TO appfotos;
GRANT INSERT ON dbamv.PW_DOCUMENTO_CLINICO TO appfotos;
GRANT INSERT ON dbamv.ARQUIVO_ATENDIMENTO TO appfotos;
GRANT UPDATE ON dbamv.ARQUIVO_DOCUMENTO TO appfotos;
GRANT UPDATE ON dbamv.PW_DOCUMENTO_CLINICO TO appfotos;
GRANT UPDATE ON dbamv.ARQUIVO_ATENDIMENTO TO appfotos;

CREATE OR REPLACE FUNCTION appfotos.VALIDA_SENHA_FUNC_APP_FOTOS
(var_login IN VARCHAR2, var_senha IN VARCHAR2)
RETURN VARCHAR2
IS
  --DECLARANDO VARIAVEL DE RETORNO
  var_retorno VARCHAR2(200);

  --DECLARANDO VARIAVEL PARA VERIFICAR FUNCIONARIO
  var_login_func INT;

BEGIN

  --VERIFICA SE EXISTE O LOGIN NA TABELA FUNCIONARIO
  -- 0 - Não existe / 1 - Existe
  SELECT COUNT(*)
  INTO var_login_func
  FROM dbasgu.USUARIOS usu
  INNER JOIN dbasgu.PAPEL_USUARIOS pu
    ON usu.CD_USUARIO =  pu.CD_USUARIO
  WHERE pu.CD_PAPEL IN (342) -- 342 APP FOTOS
  AND usu.CD_USUARIO = var_login;

  IF FNC_MV2000_HMVPEP(PUSUARIO => var_login, PSENHA => var_senha) = 'USUARIO NAO CADASTRADO'

    THEN var_retorno := 'Usuário não cadastrado';

  ELSIF FNC_MV2000_HMVPEP(PUSUARIO => var_login, PSENHA => var_senha) = 'SENHA INVALIDA'

    THEN var_retorno :=  'Senha inválida';

  ELSIF var_login_func = 0

    THEN var_retorno :=  'Usuário não possui papel';

  ELSIF LENGTH(FNC_MV2000_HMVPEP(PUSUARIO => var_login, PSENHA => var_senha)) = 30
        AND var_login_func > 0

     THEN  var_retorno := 'Login efetuado com sucesso';

  ELSE var_retorno := 'Erro Desconhecido';

END IF;

RETURN var_retorno;

EXCEPTION
WHEN OTHERS THEN
   raise_application_error(-20001,'An error was encountered - '||SQLCODE||' -ERROR- '||SQLERRM);
END;
