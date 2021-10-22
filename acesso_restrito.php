<?php

	// Se o usuário não está logado, manda para página de login.
	if (!isset($_SESSION['usuarioNome'])){
		
		unset(
			$_SESSION['usuarioId'],
			$_SESSION['usuarioNome'],
			$_SESSION['usuariocpf'],
			$_SESSION['permissao'],
			$_SESSION['sn_admin'],
			$_SESSION['sn_app_fotos']
			
		);
		
		$_SESSION['msgerro'] = "Sessão expirada!";
		header("Location: index.php");
		
	};

?>