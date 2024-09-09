$route->get("/marcas/desativados", "Brands:disabledBrands");
$route->get("/marcas/cadastrar", "Brands:brand");
$route->post("/marcas/cadastrar", "Brands:brand");
$route->get("/marcas/editar/{brand_id}", "Brands:brand");
$route->post("/marcas/editar/{brand_id}", "Brands:brand");
$route->get("/marcas/ativar/{brand_id}/{action}", "Brands:brand");
$route->get("/marcas/desativar/{brand_id}/{action}", "Brands:brand");
$route->get("/marcas/excluir/{brand_id}/{action}", "Brands:brand");