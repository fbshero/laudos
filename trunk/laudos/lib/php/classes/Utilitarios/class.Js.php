<?
/**
 * @package Utilit�rios
 * Conjunto de m�todos php que geram fun��es javascript para ser executadas no browser do cliente.
 */
	class Js {

    /**
     * escreve uma fun��o javascript que redireciona para outro link.
	 * dependendo dos parametros de entrada, este redirecionamento pode ser feito via GET ou POST.
	 * � possivel tamb�m gravar mensagens de erro ou sucesso, que ser�o exibidas na p�gina de destino.
     *
     * @param array $args vetor de argumentos.
	 * 
     */
		function goto($args){
			if (!empty($args["erro"])){
				$_SESSION["erro"] = $args["erro"];
			} elseif (!empty($args["sucesso"])) {
				$_SESSION["sucesso"] = $args["sucesso"];
			}
			$url = $args["url"] . Util::mount_get_vars($args["get_vars"]);
			echo "</form><form id=\"goto\" name=\"goto\" action=\"".$url."\" method=\"post\">\n";
			echo Util::mount_post_vars($args["post_vars"]);
			echo "</form>\n";
			Js::code("document.getElementById(\"goto\").submit();\n");
		}
		
    /**
     * escreve vari�veis javascript que definem o texto que ser�o exibidos em mensagens de erro ou sucesso.
     *
     * @param string $msg mensagem.
     * @param string $tipo tipo de mensagem (erro ou sucesso).
	 * 
     */
		function msg($msg, $tipo){
			if ((!empty($msg)) && (($tipo == "erro") || ($tipo == "sucesso"))){
				Js::code("msg_".$tipo." = \"".$msg."\";\n");
			}
		}
		
    /**
     * faz a chamada da fun��o de exibi��o de mensagens de erro ou sucesso, dependendo dos valores gravados na se��o.
     *
     */
		function trata_msg(){
			if (!empty($_SESSION["erro"])){ //verifica se foram enviadas instrucoes para exibi��o de mensagens de erro ou sucesso.
				Js::js_msg($_SESSION["erro"], "erro");
			} elseif (!empty($_SESSION["sucesso"])){
				Js::js_msg($_SESSION["sucesso"], "sucesso");
			}
			$_SESSION["erro"] = "";
			$_SESSION["sucesso"] = "";
		}
		
    /**
     * escreve o valor de entrada dentro de tags de javascript.
     *
     * @param string $code c�digo javascript.
	 * 
     */

		function code($code){
			echo "\n<script language=\"javascript\">\n";
			echo $code;
			echo "\n</script>\n";
		}
		
    /**
     * escreve a fun��o alert com o conte�do da mensagem recebida como parametro .
     *
     * @param string $str mensagem a ser exibida como alert.
	 * 
     */
		function alert($str){
			Js::code("alert(\"".$str."\");");
		}
	}
?>
