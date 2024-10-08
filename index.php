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
$route->get("/", "Dash:dash");
$route->get("/home", "Dash:home");
$route->post("/home", "Dash:home");

$route->get("/perfil", "Profile:profile");
$route->post("/perfil", "Profile:profile");
$route->get("/contatos", "Patrimony:contact");

//Contatos
$route->get("/contatos", "Contacts:contacts");
$route->get("/contatos/desativados", "Contacts:disabledContacts");
$route->get("/contatos/cadastrar", "Contacts:contact");
$route->post("/contatos/cadastrar", "Contacts:contact");
$route->get("/contatos/editar/{contact_id}", "Contacts:contact");
$route->post("/contatos/editar/{contact_id}", "Contacts:contact");
$route->get("/contatos/ativar/{contact_id}/{action}", "Contacts:contact");
$route->get("/contatos/desativar/{contact_id}/{action}", "Contacts:contact");
$route->get("/contatos/excluir/{contact_id}/{action}", "Contacts:contact");

//Patrimonios
$route->get("/patrimonios", "Patrimonys:patrimonys");
$route->get("/patrimonios/desativados", "Patrimonys:disabledPatrimonys");
$route->get("/patrimonio/cadastrar", "Patrimonys:patrimony");
$route->post("/patrimonio/cadastrar", "Patrimonys:patrimony");
$route->get("/patrimonios/detalhar/{patrimonys_id}", "Patrimonys:viewPatrimony");
$route->get("/patrimonio/detalhe/{patrimonys_id}", "Patrimonys:patrimony");
$route->post("/patrimonio/detalhe/{patrimonys_id}", "Patrimonys:patrimony");
$route->get("/patrimonios/ativar/{patrimonys_id}/{action}", "Patrimonys:patrimony");
$route->get("/patrimonios/desativar/{patrimonys_id}/{action}", "Patrimonys:patrimony");
$route->get("/patrimonio/termo/{patrimonys_id}", "Patrimonys:term");

//Historico Patrimonios
$route->get("/patrimonios/historico", "PatrimonysHistory:patrimonysHistory");
$route->get("/patrimonio/historico/excluir/{patrimonys_id}/{action}", "PatrimonysHistory:patrimonyHistory");
$route->get("/patrimonio/historico/editar/{patrimonys_id}", "PatrimonysHistory:patrimonyHistory");
$route->post("/patrimonio/historico/editar/{patrimonys_id}", "PatrimonysHistory:patrimonyHistory");
$route->get("/patrimonio/historico/termo/{patrimonys_id}", "PatrimonysHistory:term");

$route->get("/logoff", "Dash:logoff");

/**
 * ADMIN ROUTES
 */
$route->namespace("Source\App\Admin");
$route->group("/painel");

//Login
$route->get("/", "Login:root");
$route->get("/login", "Login:login");
$route->post("/login", "Login:login");

//Dash
$route->get("/controle", "Dash:dash");
$route->get("/controle/inicial", "Dash:home");
$route->post("/controle/inicial", "Dash:home");
$route->get("/logoff", "Dash:logoff");

//perfil
$route->get("/perfil", "Users:profile");
$route->post("/perfil", "Users:profile");

/**
 * Company
 */

//Unidades
$route->get("/unidades", "Units:units");
$route->get("/unidades/desativadas", "Units:disabledUnits");
$route->get("/unidades/cadastrar", "Units:unit");
$route->post("/unidades/cadastrar", "Units:unit");
$route->get("/unidades/editar/{unit_id}", "Units:unit");
$route->post("/unidades/editar/{unit_id}", "Units:unit");
$route->get("/unidades/ativar/{unit_id}/{action}", "Units:unit");
$route->get("/unidades/desativar/{unit_id}/{action}", "Units:unit");
$route->get("/unidades/excluir/{unit_id}/{action}", "Units:unit");

$route->get("/cargos", "UsersPositions:userspositions");
$route->get("/cargos/desativados", "UsersPositions:disabledUsersPositions");
$route->get("/cargos/cadastrar", "UsersPositions:userposition");
$route->post("/cargos/cadastrar", "UsersPositions:userposition");
$route->get("/cargos/editar/{userposition_id}", "UsersPositions:userposition");
$route->post("/cargos/editar/{userposition_id}", "UsersPositions:userposition");
$route->get("/cargos/ativar/{userposition_id}/{action}", "UsersPositions:userposition");
$route->get("/cargos/desativar/{userposition_id}/{action}", "UsersPositions:userposition");
$route->get("/cargos/excluir/{userposition_id}/{action}", "UsersPositions:userposition");

//Users
$route->get("/usuarios", "Users:users");
$route->get("/usuarios/desativados", "Users:disabledUsers");
$route->get("/usuarios/cadastrar", "Users:user");
$route->post("/usuarios/cadastrar", "Users:user");
$route->get("/usuarios/editar/{user_id}", "Users:user");
$route->post("/usuarios/editar/{user_id}", "Users:user");
$route->get("/usuarios/ativar/{user_id}/{action}", "Users:user");
$route->get("/usuarios/desativar/{user_id}/{action}", "Users:user");
$route->get("/usuarios/excluir/{user_id}/{action}", "Users:user");
$route->get("/usuarios/termo/{patrimonys_id}", "Users:term");
$route->get("/usuarios/historico/termo/{patrimonys_id}", "Users:termHistory");

//contratos
$route->get("/patrimonio/contratos", "Contracts:contracts");
$route->get("/patrimonio/contratos/desativados", "Contracts:disabledContracts");
$route->get("/patrimonio/contratos/cadastrar", "Contracts:contract");
$route->post("/patrimonio/contratos/cadastrar", "Contracts:contract");
$route->get("/patrimonio/contratos/editar/{contract_id}", "Contracts:contract");
$route->post("/patrimonio/contratos/editar/{contract_id}", "Contracts:contract");
$route->get("/patrimonio/contratos/ativar/{contract_id}/{action}", "Contracts:contract");
$route->get("/patrimonio/contratos/desativar/{contract_id}/{action}", "Contracts:contract");
$route->get("/patrimonio/contratos/excluir/{contract_id}/{action}", "Contracts:contract");

//marcas
$route->get("/patrimonio/marcas", "Brands:brands");
$route->get("/patrimonio/marcas/desativadas", "Brands:disabledBrands");
$route->get("/patrimonio/marcas/cadastrar", "Brands:brand");
$route->post("/patrimonio/marcas/cadastrar", "Brands:brand");
$route->get("/patrimonio/marcas/editar/{brand_id}", "Brands:brand");
$route->post("/patrimonio/marcas/editar/{brand_id}", "Brands:brand");
$route->get("/patrimonio/marcas/ativar/{brand_id}/{action}", "Brands:brand");
$route->get("/patrimonio/marcas/desativar/{brand_id}/{action}", "Brands:brand");
$route->get("/patrimonio/marcas/excluir/{brand_id}/{action}", "Brands:brand");

//produtos
$route->get("/patrimonio/produtos", "Products:products");
$route->get("/patrimonio/produtos/desativados", "Products:disabledProducts");
$route->get("/patrimonio/produtos/cadastrar", "Products:product");
$route->post("/patrimonio/produtos/cadastrar", "Products:product");
$route->get("/patrimonio/produtos/editar/{product_id}", "Products:product");
$route->post("/patrimonio/produtos/editar/{product_id}", "Products:product");
$route->get("/patrimonio/produtos/ativar/{product_id}/{action}", "Products:product");
$route->get("/patrimonio/produtos/desativar/{product_id}/{action}", "Products:product");
$route->get("/patrimonio/produtos/excluir/{product_id}/{action}", "Products:product");

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