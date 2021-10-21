<?php

// Se o usuário não está logado, manda para página de login.
if (!isset($_SESSION['usuarioNome'])){

	session_start();
	
	unset(
		$_SESSION['usuarioId'],
		$_SESSION['usuarioNome'],
		$_SESSION['usuariocpf'],
		$_SESSION['permissao'],
		$_SESSION['sn_admin'],
		$_SESSION['sn_importar_arquivos'],
		$_SESSION['sn_pendencias_prontuario'],
		$_SESSION['sn_lancamentos_pgr']
	);
	
	$_SESSION['msgerro_usuario'] = "Sessão expirada!";
	header("Location: index.php");
	
};

//Se o usuário não for admin
if($_SESSION['sn_admin'] == 'N'){

	session_start();
	
	$_SESSION['msgerro_usuario'] = "Usuário sem permissão!";
	header("Location: home.php");
}

?>