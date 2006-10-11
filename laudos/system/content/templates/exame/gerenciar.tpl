{.include file="lib/templates/$design.top.tpl".}
	<LINK REL=StyleSheet HREF="{.$path_tpl.}gerenciar.css" media="screen" TYPE="text/css">
	<form id="form" name="form" action="index.php" method="get" >
	{.$input_secao.}
		
		<div class="exa_nome">
			<label>Exame:</label><br />
			<input class="exa_nome" type="text" name="exa_nome">
		</div>
	
		<div class="botoes">
			<input class="bt_enviar" type="button" onClick="document.form.submit();" value="Buscar">
		</div>
	</form>

{.if $total_registros > 0.}
	{.$paginacao.}
	<table width="540" cellpadding="3" cellspacing="1">
		<form name="form_tamanho_pagina" action="index.php" method="get">
		{.$input_secao.}
		<tr bgcolor="#FFFFFF">
			<td align="right">
				{.$total_registros.} Registro(s), mostrando 
				<select id="tamanho_pagina" name="tamanho_pagina" onChange="document.form_tamanho_pagina.submit();">
					{.html_options output=$vet_tamanho_pagina values=$vet_tamanho_pagina selected=$tamanho_pagina.}
				</select> por p�gina.
			</td>
		</tr>
		</form>
	</table>
	<table width="540" cellpadding="3" cellspacing="1">
		<tr bgcolor="#FFE6B0">
			

			<td width="" onClick="href('{.$link_ordenacao.exa_nome.}');" style="cursor:pointer;">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td><strong>Exame</strong></td>
						<td width="20" align="right">{.$seta_ordenacao.exa_nome.}&nbsp;</td>
					</tr>
				</table>
			</td>

		
<!-- 			<td width="15%">&nbsp;</td> -->
		</tr>
	{.foreach from=$registros key=i item=r .}
		<tr bgcolor="#FFFFFF" style="cursor:pointer; " onClick="href('{.$vars_secao.}&acao=show&id={.$r.exa_id.}')">
			
			<td>
				&nbsp;{.$r.exa_nome.}
			</td>
		
<!-- 			<td>
				<a href="{.$vars_secao.}&acao=show&id={.$r.exa_id.}"><img src="images/bt_visualizar.gif" border="0"></a>&nbsp;
				<a href="{.$vars_secao.}&acao=update&id={.$r.exa_id.}"><img src="images/bt_editar.gif" border="0"></a>&nbsp;
				<a href="{.$vars_secao.}&acao=show&id={.$r.exa_id.}&del=1"><img src="images/bt_excluir.gif" border="0"></a>
			</td>
 -->		</tr>
		<tr>
			<td height="1" bgcolor="#CCCCCC"></td>
		</tr>
	{./foreach.}
		<tr>
			<td height="10" bgcolor="#FFE6B0"></td>
		</tr>
		<tr>
			<td height="10"></td>
		</tr>
	</table>
	{.$paginacao.}


{.else.}
	<table width="540" border="0">
		<tr>
			<td>Nenhum registro encontrado.</td>
		</tr>
	</table>
{./if.}
{.include file="lib/templates/$design.footer.tpl".}
	