<?php 
 require_once "HTML/Template/IT.php";
include 'db.php';


  //  Cria um novo objecto template
  $template = new HTML_Template_IT('.');

  // Carrega o template Filmes2_TemplateIT.html
  $template->loadTemplatefile('register_template.html', true, true);


  // mostra o resultado da query utilizando o template
     $template->setCurrentBlock("REGISTER");
if(!empty($_GET))
{
$template->setVariable('NAME', $_GET["name"]);
     $template->setVariable('EMAIL', $_GET["email"]);
}
else
{
	$template->setVariable('NAME', "");
     $template->setVariable('EMAIL', "");
     $template->setVariable('MESSAGE', "");
}
	      $template->parseCurrentBlock();

  // Mostra a tabela
  $template->show();


?>


