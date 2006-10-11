<?
	$config_menu_medico = array(
		"home"	=> array(
			"nome"	=> "Home",
			"sub"	=> array(),
			"hide_menu" => "0",
		),
		"interpretacao"	=> array(
			"nome"	=> "Interpreta��es",
			"sub"	=> array(),
			"hide_menu" => "0",
		),
		"hospital"	=> array(
			"nome"	=> "Hospitais",
			"sub"	=> array(),
			"hide_menu" => "0",
		),
		"convenio"	=> array(
			"nome"	=> "Conv�nios",
			"sub"	=> array(),
			"hide_menu" => "0",
		),
		"exame"	=> array(
			"nome"	=> "Exames",
			"sub"	=> array(),
			"hide_menu" => "0",
		),
 		"valor_exame"	=> array(
			"nome"	=> "Valores de Exames",
			"sub"	=> array(),
			"hide_menu" => "0",
		),
		"texto_padrao"	=> array(
			"nome"	=> "Textos Padronizados",
			"sub"	=> array(),
			"hide_menu" => "0",
		),
		"relatorio"	=> array(
			"nome"	=> "Relat�rio Mensal",
			"sub"	=> array(),
			"hide_menu" => "0",
		),
	);
	
	$config_menu_hospital = array(
		"home"	=> array(
			"nome"	=> "Home",
			"sub"	=> array(),
			"hide_menu" => "0",
		),
		"interpretacao"	=> array(
			"nome"	=> "Interpreta��es",
			"sub"	=> array(),
			"hide_menu" => "0",
		),
	);
	
	switch($_SESSION[medico]){
	case "1":
		$config_menu = $config_menu_medico;
	break;
	case "0":
		$config_menu = $config_menu_hospital;
	break;
	default:
		$config_menu = array();
	}
?>