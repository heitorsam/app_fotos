<?php

	// Se o usuário não está logado, manda para página de login.
	if (!isset($_SESSION['usuarioNome'])){
		
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
		
		$_SESSION['msgerro'] = "Sessão expirada!";
		header("Location: index.php");
		
	};

?>