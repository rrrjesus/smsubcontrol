//users
$route->get("/unidades", "Units:users");
$route->get("/unidades/desativados", "Units:disabledUnits");
$route->get("/unidades/cadastrar", "Units:unit");
$route->post("/unidades/cadastrar", "Units:unit");
$route->get("/unidades/editar/{user_id}", "Units:unit");
$route->post("/unidades/editar/{user_id}", "Units:unit");
$route->get("/unidades/ativar/{user_id}/{action}", "Units:unit");
$route->get("/unidades/desativar/{user_id}/{action}", "Units:unit");
$route->get("/unidades/excluir/{user_id}/{action}", "Units:unit");