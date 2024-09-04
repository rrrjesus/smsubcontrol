<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */

use CoffeeCode\Router\Router;
use Source\Core\Session;

$session = new Session();
$route = new Router(url(), ":");
$route->namespace("Source\App");

/**
 * WEB ROUTES
 */
$route->group(null);
$route->get("/", "Web:home");
$route->get("/sobre", "Web:about");

//agenda
$route->group("/contatos");
$route->get("/", "Web:contact");

//blog
$route->group("/blog");
$route->get("/", "Web:blog");
$route->get("/p/{page}", "Web:blog");
$route->get("/{uri}", "Web:blogPost");
$route->post("/buscar", "Web:blogSearch");
$route->get("/buscar/{search}/{page}", "Web:blogSearch");
$route->get("/em/{category}", "Web:blogCategory");
$route->get("/em/{category}/{page}", "Web:blogCategory");

//auth
$route->group(null);
$route->get("/entrar", "Web:login");
$route->post("/entrar", "Web:login");
$route->get("/cadastrar", "Web:register");
$route->post("/cadastrar", "Web:register");
$route->get("/recuperar", "Web:forget");
$route->post("/recuperar", "Web:forget");
$route->get("/recuperar/{code}", "Web:reset");
$route->post("/recuperar/resetar", "Web:reset");

//assinatura de email
$route->get("/email", "Web:creatorCard");

//optin
$route->group(null);
$route->get("/confirma", "Web:confirm");
$route->get("/obrigado/{email}", "Web:success");

//services
$route->group(null);
$route->get("/termos", "Web:terms");

/**
 * APP ROUTES
 */
$route->namespace("Source\App\Beta");
$route->group("/beta");

//login
$route->get("/", "Login:root");
$route->get("/login", "Login:login");
$route->post("/login", "Login:login");

//dash
$route->get("/dash", "Dash:dash");
$route->get("/dash/home", "Dash:home");
$route->post("/dash/home", "Dash:home");

$route->get("/perfil", "Profile:profile");
$route->post("/perfil", "Profile:profile");
$route->get("/contatos", "Patrimonio:contact");

//Marcas
$route->get("/patrimonio/marcas/lista", "BensMarcas:bensmarcasLista");
$route->get("/patrimonio/marcas/cadastrar", "BensMarcas:bensMarcas");
$route->post("/patrimonio/marcas/cadastrar", "BensMarcas:bensMarcas");
$route->get("/patrimonio/marcas/editar/{bensmarcas_id}", "BensMarcas:bensMarcas");
$route->post("/patrimonio/marcas/editar/{bensmarcas_id}", "BensMarcas:bensMarcas");

//Modelos
$route->get("/patrimonio/modelos/lista", "BensModelos:bensmodelosLista");
$route->get("/patrimonio/modelos/cadastrar", "BensModelos:bensModelos");
$route->post("/patrimonio/modelos/cadastrar", "BensModelos:bensModelos");
$route->get("/patrimonio/modelos/editar/{bensmodelos_id}", "BensModelos:bensModelos");
$route->post("/patrimonio/modelos/editar/{bensmodelos_id}", "BensModelos:bensModelos");

//Bens
$route->get("/patrimonio/bens/lista", "Bens:bensLista");
$route->get("/patrimonio/bens/cadastrar", "Bens:bens");
$route->post("/patrimonio/bens/cadastrar", "Bens:bens");
$route->get("/patrimonio/bens/editar/{bens_id}", "Bens:bens");
$route->post("/patrimonio/bens/editar/{bens_id}", "Bens:bens");

//Historico Bens
$route->get("/patrimonio/benshistorico/lista", "BensHistorico:bensLista");
$route->get("/patrimonio/benshistorico/editar/{bens_id}", "BensHistorico:bens");
$route->post("/patrimonio/benshistorico/editar/{bens_id}", "BensHistorico:bens");

$route->get("/logoff", "Dash:logoff");

/**
 * ADMIN ROUTES
 */
$route->namespace("Source\App\Admin");
$route->group("/painel");

//login
$route->get("/", "Login:root");
$route->get("/login", "Login:login");
$route->post("/login", "Login:login");

//dash
$route->get("/controle", "Dash:dash");
$route->get("/controle/inicial", "Dash:home");
$route->post("/controle/inicial", "Dash:home");
$route->get("/logoff", "Dash:logoff");

// Colaboradores
$route->get("/colaboradores", "Collaborators:Collaborators");
$route->get("/colaboradores/desativados", "Collaborators:disabledCollaborators");
$route->get("/colaboradores/adicionar", "Collaborators:collaborator");
$route->post("/colaboradores/adicionar", "Collaborators:collaborator");
$route->get("/colaboradores/editar/{collaborator_id}", "Collaborators:collaborator");
$route->post("/colaboradores/editar/{collaborator_id}", "Collaborators:collaborator");
$route->get("/colaboradores/identidade/{collaborator_id}", "Collaborators:Identifier");
$route->get("/colaboradores/verificador/{collaborator_id}/{crypto}", "Collaborators:Identifier");
$route->get("/colaboradores/ativar/{collaborator_id}", "Collaborators:activedCollaborator");
$route->get("/colaboradores/desativar/{collaborator_id}", "Collaborators:disabledCollaborator");
$route->get("/colaboradores/excluir/{collaborator_id}/{action}", "Collaborators:collaborator");

// Igrejas
$route->get("/igrejas", "Churches:Churches");
$route->get("/igrejas/desativadas", "Churches:disabledChurches");
$route->get("/igrejas/adicionar", "Churches:churche");
$route->post("/igrejas/adicionar", "Churches:churche");
$route->get("/igrejas/editar/{churche_id}", "Churches:churche");
$route->post("/igrejas/editar/{churche_id}", "Churches:churche");
$route->get("/igrejas/identidade/{churche_id}", "Churches:Identifier");
$route->get("/igrejas/ativar/{churche_id}", "Churches:activedChurche");
$route->get("/igrejas/desativar/{churche_id}", "Churches:disabledChurche");
$route->get("/igrejas/excluir/{churche_id}/{action}", "Churches:churche");

// Grupos
$route->get("/grupos", "Groups:Groups");
$route->get("/grupos/desativados", "Groups:disabledGroups");
$route->get("/grupos/adicionar", "Groups:group");
$route->post("/grupos/adicionar", "Groups:group");
$route->get("/grupos/editar/{group_id}", "Groups:group");
$route->post("/grupos/editar/{group_id}", "Groups:group");
$route->get("/grupos/ativar/{group_id}", "Groups:activedGroup");
$route->get("/grupos/desativar/{group_id}", "Groups:disabledGroup");
$route->get("/grupos/excluir/{group_id}/{action}", "Groups:group");

//users
$route->get("/usuarios", "Users:users");
$route->get("/usuarios/desativados", "Users:disabledUsers");
$route->get("/usuarios/adicionar", "Users:user");
$route->post("/usuarios/adicionar", "Users:user");
$route->get("/usuarios/editar/{user_id}", "Users:user");
$route->post("/usuarios/editar/{user_id}", "Users:user");
$route->get("/usuarios/ativar/{user_id}", "Users:activedUser");
$route->get("/usuarios/desativar/{user_id}", "Users:disabledUser");
$route->get("/usuarios/excluir/{user_id}/{action}", "Users:user");

//notification center
$route->post("/notifications/count", "Notifications:count");
$route->post("/notifications/list", "Notifications:list");

//END ADMIN
$route->namespace("Source\App");

/**
 * ERROR ROUTES
 */
$route->group("/ops");
$route->get("/{errcode}", "Web:error");

/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();