
{.include file="lib/templates/$design.top.tpl".}
	<LINK REL=StyleSheet HREF="{.$path_tpl.}gerenciar.css" media="screen" TYPE="text/css">
	<form id="form" name="form" action="index.php" method="get" >
	{.$input_secao.}
		
		<div class="hos_id">
			<label>Hospital:</label><br />
			<select class="hos_id" name="hos_id">
				<option value=""></option>
				{.html_options options=$vet_hospitais selected=$hos_id.}
			</select>
		</div>
	
		<div class="con_nome">
			<label>Nome do Conv�nio:</label><br />
			<input class="con_nome" type="text" name="con_nome">
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
			

			<td width="" onClick="href('{.$link_ordenacao.hos_nome.}');" style="cursor:pointer;">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td><strong>Hospital</strong></td>
						<td width="20" align="right">{.$seta_ordenacao.hos_nome.}&nbsp;</td>
					</tr>
				</table>
			</td>

		

			<td width="" onClick="href('{.$link_ordenacao.con_nome.}');" style="cursor:pointer;">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td><strong>Nome do Conv�nio</strong></td>
						<td width="20" align="right">{.$seta_ordenacao.con_nome.}&nbsp;</td>
					</tr>
				</table>
			</td>

			<!-- <td width="15%">&nbsp;</td> -->
		</tr>
	{.foreach from=$registros key=i item=r .}
		<tr bgcolor="#FFFFFF"  style="cursor:pointer;" onClick="href('{.$vars_secao.}&acao=show&id={.$r.con_id.}');">
			
			<td>
				&nbsp;{.$r.hos_nome.}
			</td>
		
			<td>
				&nbsp;{.$r.con_nome.}
			</td>
		
		
<!-- 			<td>
				<a href="{.$vars_secao.}&acao=show&id={.$r.con_id.}"><img src="images/bt_visualizar.gif" border="0"></a>&nbsp;
				<a href="{.$vars_secao.}&acao=update&id={.$r.con_id.}"><img src="images/bt_editar.gif" border="0"></a>&nbsp;
				<a href="{.$vars_secao.}&acao=show&id={.$r.con_id.}&del=1"><img src="images/bt_excluir.gif" border="0"></a>
			</td> -->
		</tr>
		<tr>
			<td colspan="2" height="1" bgcolor="#CCCCCC"></td>
		</tr>
	{./foreach.}
		<tr>
			<td colspan="2" height="10" bgcolor="#FFE6B0"></td>
		</tr>
		<tr>
			<td colspan="2" height="10"></td>
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
	