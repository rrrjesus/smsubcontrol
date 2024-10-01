<?= $this->layout("_beta"); ?>

<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:8.0pt;
	margin-left:0cm;
	line-height:106%;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;}
h1
	{mso-style-link:"Título 1 Char";
	margin:0cm;
	text-align:center;
	page-break-after:avoid;
	font-size:12.0pt;
	font-family:"Arial",sans-serif;
	font-style:italic;}
p.MsoBodyText, li.MsoBodyText, div.MsoBodyText
	{mso-style-link:"Corpo de texto Char";
	margin:0cm;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	font-weight:bold;}
p.MsoNoSpacing, li.MsoNoSpacing, div.MsoNoSpacing
	{margin:0cm;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;}
span.Ttulo1Char
	{mso-style-name:"Título 1 Char";
	mso-style-link:"Título 1";
	font-family:"Arial",sans-serif;
	font-weight:bold;
	font-style:italic;}
span.CorpodetextoChar
	{mso-style-name:"Corpo de texto Char";
	mso-style-link:"Corpo de texto";
	font-family:"Times New Roman",serif;
	font-weight:bold;}
.MsoChpDefault
	{font-size:10.0pt;}
.MsoPapDefault
	{margin-bottom:8.0pt;
	line-height:106%;}
@page WordSection1
	{size:595.5pt 842.0pt;
	margin:3.0cm 2.0cm 2.0cm 2.0cm;}
div.WordSection1
	{page:WordSection1;}

/* Print Definitions */
@media print {
  nav {visibility: hidden;} 
  footer {visibility: hidden;} 
  div.WordSection1{visibility: visible;}div.WordSection1 {position: fixed;left: 0;top: 0;}}

</style>

<body lang=PT-BR link="#0563C1" vlink="#954F72" style='word-wrap:break-word'>

<div class=WordSection1>

<div align=center>

<img class="rounded mx-auto d-block" src="<?=url('themes/'.CONF_VIEW_APP.'/assets/images/logo_termo.png');?>">

<h1><u><span style='font-size:14.0pt;font-style:normal'><b>TERMO DE EMPRÉSTIMO</b></span></u></h1>

<p class=MsoNormal><span style='font-size:10.0pt;line-height:106%;font-family:
"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:1.25cm;margin-right:1.25cm;text-align:justify;text-indent:-.1pt'><span style='font-size:10.0pt;line-height:150%;font-family:
"Arial",sans-serif;font-weight:normal'>Eu <span class="text-uppercase"><?=$term->userPatrimony()->user_name?></span>,
portador do Registro Funcional (RF) <?=$term->userPatrimony()->rf?>, lotado/a na <?=$term->userUnit($term->userPatrimony()->unit_id)->unit_name?>,
&nbsp;declaro assumir responsabilidade pela guarda, conservação deste aparelho
(e acessórios) e uso adequado do(s) equipamento(s) abaixo listado(s) , conforme
segue:</span></p>

<table class=a border=1 cellspacing=0 cellpadding=0 width=624 style='border-collapse: collapse;border:none'>
    <tr style='height:44.0pt'>
        <td width=624 valign=top style='width:467.7pt;border:solid black 1.0pt; padding:0cm 5.4pt 0cm 5.4pt;height:44.0pt'>
        <p class=MsoNormal style='margin-left:1.25cm;margin-right:1.25cm;text-indent:-.1pt'><b>
            <span style='font-size:9.0pt;font-family:"Verdana",sans-serif'>Equipamento:</span></b>
            <span style='font-size:9.0pt;font-family:"Verdana",sans-serif'> 01 <?=$term->productBrand($term->product()->brand_id)->brand_name?> 
            <?=$term->product()->product_name?> - <?=$term->product()->type_part_number?> : <?=$term->part_number?></span>
        </p>
        <p class=MsoNormal style='margin-left:1.25cm;margin-right:1.25cm;text-indent:-.1pt'>
            <span style='font-size:9.0pt;font-family:"Verdana",sans-serif'><strong>Descrição</strong> : <?=$term->product()->description?></span>
        </p>
        </td>
    </tr>
</table>

<p class=MsoNormal style='margin-left:1.25cm;margin-right:1.25cm;text-align:justify;text-indent:-.1pt'><span
    style='font-family:"Arial",sans-serif'>Declaro<span style='letter-spacing:-.35pt'>
</span>ainda,<span style='letter-spacing:-.2pt'> </span>que<span
style='letter-spacing:-.3pt'> </span></span><span style='font-size:10.0pt;
line-height:150%;font-family:"Arial",sans-serif'>RECEBI</span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif;
font-weight:normal'> o equipamento acima discriminado em perfeita condição de
uso, e que li e entendi os termos deste Termo de Empréstimo, estando </span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif'>CIENTE</span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif;
font-weight:normal'> e </span><span style='font-size:10.0pt;line-height:150%;
font-family:"Arial",sans-serif'>DE ACORDO</span><span style='font-size:10.0pt;
line-height:150%;font-family:"Arial",sans-serif;font-weight:normal'> que:</span></p>

<p class=MsoNormal style='margin-left:1.25cm;margin-right:1.25cm;text-align:justify;text-indent:-.1pt'><span
    style='font-family:"Arial",sans-serif'>1</span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif;
font-weight:normal'>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; O
equipamento é para meu uso exclusivo, e por isso, é terminantemente vedado o
empréstimo, cessão e/ou transferência do aparelho recebido à terceiros;</span></p>

<p class=MsoNormal style='margin-left:1.25cm;margin-right:1.25cm;text-align:justify;text-indent:-.1pt'><span
    style='font-family:"Arial",sans-serif'>2</span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif;
font-weight:normal'>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Na
eventualidade de problemas de ordem técnica ou operacional, o aparelho deverá
ser enviado à </span><span style='font-size:10.0pt;line-height:150%;font-family:
"Arial",sans-serif'>COTI</span><span style='font-size:10.0pt;line-height:150%;
font-family:"Arial",sans-serif;font-weight:normal'> de imediato, por intermédio
de memorando, onde deverá ser registrado o problema apresentado, constando o </span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif'>IMEI</span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif;
font-weight:normal'> do aparelho;</span></p>

<p class=MsoNormal style='margin-left:1.25cm;margin-right:1.25cm;text-align:justify;text-indent:-.1pt'><span
    style='font-family:"Arial",sans-serif'>3</span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif;
font-weight:normal'>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No caso
de roubo / furto / perda do equipamento, deverei comunicar </span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif'>de
imediato</span><span style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif;
font-weight:normal'> à </span><span style='font-size:10.0pt;line-height:150%;
font-family:"Arial",sans-serif'>COTI</span><span style='font-size:10.0pt;
line-height:150%;font-family:"Arial",sans-serif;font-weight:normal'> por
intermédio de Memorando, anexando o B.O. - Boletim de Ocorrência Policial;</span></p>

<p class=MsoNormal style='margin-left:1.25cm;margin-right:1.25cm;text-align:justify;text-indent:-.1pt'><span
    style='font-family:"Arial",sans-serif'>4</span></a><span style='font-size:10.0pt;
line-height:150%;font-family:"Arial",sans-serif;font-weight:normal'>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Conforme a </span><span style='font-size:10.0pt;line-height:150%;font-family:
"Arial",sans-serif'>Portaria 137/05 SMG. Art. 1º Inciso IV</span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif;
font-weight:normal'> deverei ressarcir os prejuízos decorrentes de perda,
furto, ou danos ao equipamento, devido à má utilização ou conservação, repondo
o equipamento com a mesma especificação técnica à marca/modelo, ou similar, </span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif'>às minhas
expensas</span><span style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif;
font-weight:normal'>;</span></p>

<p class=MsoNormal style='margin-left:1.25cm;margin-right:1.25cm;text-align:justify;text-indent:-.1pt'><span
    style='font-family:"Arial",sans-serif'>5</span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif;
font-weight:normal'>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Em caso
de aposentadoria, exoneração ou licença, de mudança de setor, subprefeitura ou
secretaria, ou seja, alocado em outra função que não faz o uso do equipamento,
o servidor deverá comunicar à </span><span style='font-size:10.0pt;line-height:
150%;font-family:"Arial",sans-serif'>COTI</span><span style='font-size:10.0pt;
line-height:150%;font-family:"Arial",sans-serif;font-weight:normal'> de
imediato.</span></p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr style='height:47.5pt'>
  <td width=623 valign=top style='width:467.55pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:47.5pt'>
  <p class=MsoBodyText style='margin-right:15.3pt;text-align:justify;
  line-height:150%'><span style='font-size:10.0pt;line-height:150%;font-family:
  "Arial",sans-serif'>OBSERVAÇÕES : <?=$term->observations?> ID:<?=$term->id?></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-left:1.25cm;margin-right:1.25cm;text-align:justify;text-indent:-.1pt'><span
    style='font-family:"Arial",sans-serif'>6</span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif;
font-weight:normal'>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Declaro
ainda, que no momento da retirada, o equipamento se encontra em perfeita
condição de uso. Assumo também o compromisso de devolver para </span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif'>COTI</span><span
style='font-size:10.0pt;line-height:150%;font-family:"Arial",sans-serif;
font-weight:normal'> o/s equipamento/s supracitado/s caso mude de setor ou de
secretaria, ou seja, alocado em outra função que não faz uso do equipamento.</span></p>

<p class=MsoBodyText style='margin-top:4.6pt'><span style='font-size:10.0pt;
font-family:"Arial",sans-serif'>Nestes<span style='letter-spacing:.5pt'> </span>termos,</span></p>

<p class=MsoBodyText style='margin-top:.55pt'><span style='font-size:10.0pt;
font-family:"Arial",sans-serif'>&nbsp;</span></p>

</div>

<p class=MsoNormal style='text-indent:-.1pt;margin-left:1.25cm;margin-right:1.25cm;line-height:normal'><b><span style='font-size:10.0pt;
font-family:"Arial",sans-serif'>Assinatura do responsável pela retirada</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif'>:_________________________________________________</span></p>

<p class=MsoNormal style='text-indent:-.1pt;margin-left:1.25cm;margin-right:1.25cm;line-height:normal'><b><span style='font-size:10.0pt;
font-family:"Arial",sans-serif'>Data da retirada</span></b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif'>: _____/______/_________</span></p>

<p class=MsoNormal style='text-indent:-.1pt;margin-left:1.25cm;margin-right:1.25cm;line-height:normal'><b><span style='font-size:10.0pt;
font-family:"Arial",sans-serif'>E-mail: </span></b><span style='font-size:
10.0pt;font-family:"Arial",sans-serif'><?=(!empty($term->userPatrimony()->email) ? $term->userPatrimony()->email : "_______________________________________________");?></span><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif'>&nbsp;&nbsp;Telefone: _</span></b><u><span
style='font-size:10.0pt;font-family:"Arial",sans-serif'><?=(!empty($term->userPatrimony()->cell_phone) ? $term->userPatrimony()->cell_phone : "_______________________");?></span></u></p>

<p class="MsoNoSpacing text-uppercase" align=center style='text-align:center'><span
style='font-size:10.0pt'><b><?=user()->user_name?></b></span></p>

<p class=MsoNoSpacing align=center style='text-align:center'><span
style='font-size:10.0pt'><b><?=user()->userPosition()->position_name?></b></span></p>

<p class=MsoNoSpacing align=center style='text-align:center'><span
style='font-size:10.0pt'><b>RF: <?=user()->rf?></b></span></p>

<p class=MsoNoSpacing align=center style='text-align:center'><span
style='font-size:10.0pt'><b>Retirado em <?=date("d/m/Y")?></b></span></p>

</div>

</body>

