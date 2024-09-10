$route->get("/beta/contatos", "Contacts:contacts");
$route->get("/beta/contatos/cadastrar", "Contacts:contact");
$route->post("/beta/contatos/cadastrar", "Contacts:contact");
$route->get("/beta/contatos/editar/{bensmarcas_id}", "Contacts:contact");
$route->post("/beta/contatos/editar/{bensmarcas_id}", "Contacts:contact");