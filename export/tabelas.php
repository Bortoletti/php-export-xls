
<?php

$fileLog = 'export-tabelas-'. rand() * 10;
$export_file = "tabelas.xls";
$queryp = (isset( $_REQUEST['q'])?$_REQUEST['q']:'q1') . '.sql';
$sql = file_get_contents( './sql/' . $queryp );

header( "Content-type: application/x-msexcel" );
header( 'Content-Disposition: attachment; filename="' . $export_file . '"' );

include("../conf/conexao.php");
include("../conf/util.php");


logar( $fileLog, '==================   INICIO   =====================');
logar( $fileLog, __FILE__ );
logar( $fileLog, "param: ". $queryp );


$saida = json_decode( '{"status":"sucesso","mensagem":"","parametros":{},"itens":[],"log":"","inicio":"","termino":"" }' );
$saida->log = $fileLog;
$saida->inicio = date_format( date_create()  , 'Y-m-d H:i:s');


$colunas = array();
$linhas = array();

logar( $fileLog, "SQL:" . $sql );

logar( $fileLog, '==================   CARREGAR LINHAS E COLUNAS   =====================');

try {
  $result = $conn->query( $sql );
  
  $linhas = $result->fetchAll( PDO::FETCH_CLASS );
  $linha = $linhas[0];

  foreach( $linha as $k => $v )
  {
	    $colunas[] = $k;
  }
  logar( $fileLog, json_encode( $colunas ) );
}
catch(PDOException $e) {
  $saida->status = "falha";
  $saida->mensagem = "Error: " . $e->getMessage();
  goto saida;
}


logar( $fileLog, '==================   IMPRIMIR TABELA   =====================');


print( '<table border="1">');
print( "<tr>"  );



foreach ($colunas as $k => $v ) 
{ 
  print("<th>" . $v . "</th>");
} 
print( "</tr>" );
foreach ($linhas as $linha ) 
{
	print("<tr>");
	foreach( $linha as $k => $v )
	{
		print("<td>" . $v . "</td>");
	}
  print("</tr>");
}
print("</table>");

saida:
logar( $fileLog, '==================   FIM   =====================');

logar( $fileLog, json_encode( $saida ) );


?>
