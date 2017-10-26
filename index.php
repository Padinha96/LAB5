<?php 
 require_once "HTML/Template/IT.php";
include 'db.php';

$db = dbconnect($hostname,$db_name,$db_user,$db_passwd); 
if($db) {
  // criar query numa string
$query  = "SELECT *, users.name FROM microposts RIGHT JOIN users ON microposts.user_id=users.id";
  
  // executar a query
  if(!($result = @ mysql_query($query,$db )))
   showerror();

  // Cria um novo objecto template
  $template = new HTML_Template_IT('.');

  // Carrega o template Filmes2_TemplateIT.html
  $template->loadTemplatefile('index_template.html', true, true);


  // mostra o resultado da query utilizando o template

     $template->setCurrentBlock("MENU");

     $template->setVariable('MENU_1', "HOME");
     $template->setVariable('MENU_2', "Login");
     $template->setVariable('MENU_3', "Register");
	      $template->parseCurrentBlock();
  $nrows  = mysql_num_rows($result);
  var_dump($result);
   for($i=0; $i<$nrows; $i++) {
     $tuple = mysql_fetch_array($result,MYSQL_ASSOC);
		       $template->setCurrentBlock("MICROPOSTS");
     $template->setVariable('USER', $tuple['name']);
     $template->setVariable('UPDATED', $tuple['updated_at']);
	      $template->setVariable('UPDATE',$tuple['content']);
		       $template->setVariable('CREATED', $tuple['created_at']);
   
     // Faz o parse do bloco FILMES
     $template->parseCurrentBlock();

   } // end for

  // Mostra a tabela
  $template->show();

  // fechar a ligaÃ§Ã£o Ã  base de dados
  mysql_close($db);
} // end if 
?>



