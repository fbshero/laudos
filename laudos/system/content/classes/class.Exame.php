<?
/**
 * @package Base
 *
 * classe que realiza opera��es epec�cficas nos registros da tabela relacionamento
 */
class Exame extends Base{
    /**
     * Construtor da classe
     *
     * @param string $id id do registro a ser acessado
     */
	function Exame($id=''){
		//inicializa a classe m�e - obrigat�rio
		parent::Base($id, "exame", "exa_id");
		//seta as configura��es - n�o � obrigat�rio, caso seja uma classe com muitas peculiaridades
		parent::propertiesSetConfig(
			array(
				"med_id"	=> array(
					"titulo"		=> "M�dico",
					"requerido"		=> "1",
					"validacao"		=> "Int",
				),
				"exa_nome"	=> array(
					"titulo"		=> "Exame",
					"requerido"		=> "1",
					"validacao"		=> "Text",
				),

			)
		);
	}
	
    /**
     * monta uma string que cont�m a consulta sql que ser� executada na busca
	 *
	 * no final chama o m�todo {@link setLinksBusca()} para setar as propriedades de links do objeto, que viabilizar�o o funcionamento correto dos links daa pagina��o
     *
     * @param array $filtros nomes e valores dos campos q devem ser levados em conta na consulta
	 * @param array $ordenacao nome do campo e tipo de ordenacao
	 * @param mixed $tamanho_pagina tamanho maximo de registros por p�gina
     * @return string
     */
	function setSqlBusca($filtros=array(), $ordenacao=array(), $tamanho_pagina = 20){
		$sql = "select * from exame where med_id = ".$_SESSION["med_id"]." ";

		if ($filtros["exa_nome"]){
			$sql .= " and exa_nome like '%".addslashes($filtros["exa_nome"])."%' ";
		}

		if ($ordenacao["campo_ordenacao"]){
			$sql .= " order by ".addslashes($ordenacao["campo_ordenacao"])." ";
		} else {
			$sql .= " order by exa_nome";
		}
		if ($ordenacao["tipo_ordenacao"]){
			$sql .= " ".addslashes($ordenacao["tipo_ordenacao"])." ";
		} else {
			$sql .= " asc ";
		}
		$this->setLinksBusca($filtros, $ordenacao, $tamanho_pagina);
//		Util::prt("", $sql);
//		Js::alert($sql);
		$this->sql_busca = $sql;
	}
	
    /**
     * monta um array de objetos, contendo todos os registros da base de dados
	 *
     * @return array
     */
	function getAll(){
        $sql 	= "select * from exame where med_id = ".$_SESSION[med_id]." order by exa_nome ";
		$rs		= Db::sql($sql, "Exame::getAll()");
        $out 	= array();
        while ($r = mysql_fetch_assoc($rs)) {
            $out[] = new Exame($r["exa_id"]);
        }
        return $out;
	}
	
    /**
     * retorna o valor de um exame, dado um determinado convenio
	 *
     * @return array
     */
	function getValorAbsoluto($con_id){
        $sql 	= "select vex_valor_absoluto from valor_exame where exa_id = ".$this->get("exa_id")." and  con_id = ".$con_id;
		$rs		= Db::sql($sql, "Exame::getValorAbsoluto()");
        $r = mysql_fetch_assoc($rs);
        return $r["vex_valor_absoluto"];
	}
	
    /**
     * retorna o valor do contraste de um exame, dado um determinado convenio
	 *
     * @return array
     */
	function getValorContraste($con_id){
        $sql 	= "select vex_valor_contraste from valor_exame where exa_id = ".$this->get("exa_id")." and  con_id = ".$con_id;
		$rs		= Db::sql($sql, "Exame::getValorContraste()");
        $r = mysql_fetch_assoc($rs);
        return $r["vex_valor_contraste"];
	}
	
    /**
     * retorna o CH de um exame, dado um determinado convenio
	 *
     * @return array
     */
	function getCh($con_id){
        $sql 	= "select vex_ch from valor_exame where exa_id = ".$this->get("exa_id")." and  con_id = ".$con_id;
		$rs		= Db::sql($sql, "Exame::getCh()");
        $r = mysql_fetch_assoc($rs);
        return $r["vex_ch"];
	}
	
    /**
     * retorna o Filme de um exame, dado um determinado convenio
	 *
     * @return array
     */
	function getFilme($con_id){
        $sql 	= "select vex_filme from valor_exame where exa_id = ".$this->get("exa_id")." and  con_id = ".$con_id;
		$rs		= Db::sql($sql, "Exame::getFilme()");
        $r = mysql_fetch_assoc($rs);
        return $r["vex_filme"];
	}

	
    /**
     * monta um array com os dados que dever�o ser exibidos em options de select
	 *
     * @return array
     */
	function getOptions(){
		$objs	= Exame::getAll();
        $out 	= array();
        foreach($objs as $o) {
            $out[$o->get("exa_id")] = $o->get("exa_nome");
        }
        return $out;
	}
	
    /**
     * seta as seguintes propriedades do objeto:
	 * 
	 * {@link Base::link_base_paginacao}, {@link Base::setas_ordenacao}, {@link Base::links_ordenacao}
	 * 
	 * serve para viabilizar o funcinamento correto dos links da pagina��o e ordena��o
	 *
	 * � chamado pelo m�todo {@link setSqlBusca()}.
     *
     * @param array $filtros nomes e valores dos campos q devem ser levados em conta na consulta
	 * @param array $ordenacao nome do campo e tipo de ordenacao
	 * @param mixed $tamanho_pagina tamanho maximo de registros por p�gina
     */
	function setLinksBusca($filtros=array(), $ordenacao=array(), $tamanho_pagina = 20){
		$ordenacao["campo_ordenacao"] 		= ($ordenacao["campo_ordenacao"] ? $ordenacao["campo_ordenacao"] : "exa_nome");
		$ordenacao["tipo_ordenacao"] 		= ($ordenacao["tipo_ordenacao"] ? $ordenacao["tipo_ordenacao"] : "asc");	
		$tipo_ordenacao_inverso				= ($ordenacao["tipo_ordenacao"] == "asc" ? "desc" : "asc");
		
		$vars_get_filtros					= Util::mount_get_vars($filtros);
		$vars_get_ordenacao					= Util::mount_get_vars($ordenacao);
		$this->link_base_paginacao			= LINK_BASE_ATUAL.$vars_get_filtros.$vars_get_ordenacao;
		
		$campo = "exa_nome";
		if ($campo == $ordenacao["campo_ordenacao"]){
			$this->setas_ordenacao[$campo] 	= "<img src='images\seta_".$ordenacao["tipo_ordenacao"].".gif'>";
			$this->links_ordenacao[$campo]	= VARS_SECAO.$vars_get_filtros."&campo_ordenacao=$campo&tipo_ordenacao=".$tipo_ordenacao_inverso."&tamanho_pagina=".$tamanho_pagina;
		} else {
			$this->links_ordenacao[$campo] 	= VARS_SECAO.$vars_get_filtros."&campo_ordenacao=$campo&tipo_ordenacao=asc&tamanho_pagina=".$tamanho_pagina;
		}

	}
	
    /**
     * verifica se ja existe um registro cadastrado com os mesmos dados
     *
     */
	function exists() {
		$sql_inicio 	= " select * from ".$this->table." where med_id = ".$_SESSION[med_id]." and ";
		$sql_fim 		= " ".($this->get($this->pk) ? " and ".$this->pk." <> ".$this->get($this->pk) : "")." limit 1 ";
		
		$sql 	= "exa_nome = ".$this->get("exa_nome");
		if (mysql_num_rows(Db::sql($sql_inicio.$sql.$sql_fim))){
			$this->propertySetError ("exa_nome", "J� existe no banco de dados.");
		}
	}
	
	
    /**
     * pega informacoes sobre todos os registros de outras tabelas que est�o relacionados com o registro atual
	 * 
	 * suas informa��es ser�o usadas no m�todo {@link Base::deleteDependences()} e na montagem da interface que apontar� quais registros est�o vinculados ao registro atual, na hora da exclus�o.
	 * este m�todo � normalmente chamado em {@link Base::delete()}
     *
	 * @return array
     */
     function setdependences() {
		$dep 	= array();

		$sql 	= "select * from valor_exame v, convenio c where c.con_id = v.con_id and ".$this->pk." = ".$this->get($this->pk);
		$rs 	= Db::sql($sql);
		while ($r = mysql_fetch_assoc($rs)){
			$dep[]	= array(
				"sql_del"	=> "delete from valor_exame where ".$this->pk." = ".$r[$this->pk],
				"label"		=> "Valor do Exame pelo Conv�nio ".$r["con_nome"],
				"url"		=> "",
			);
		}
		$this->dependences = $dep;
    }
}
?>