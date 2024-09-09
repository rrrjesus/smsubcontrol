<?php

namespace Source\App\Admin;

use Source\Models\Patrimony\Brand;
use Source\Models\Patrimony\Product;
use Source\Models\User;

/**
 * Class Products
 * @package Source\App\Beta
 */
class Products extends Admin
{
    /**
     * Products constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * MARCA LISTA
     */
    public function products(): void
    {
        $head = $this->seo->render(
            "Patrimônios / Produtos - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        $products = (new Product())->find("status = :s", "s=actived")->fetch(true);
        $product = new Product();

        echo $this->view->render("widgets/patrimonys/products/list", [
            "head" => $head,
            "products" => $products,
            "urls" => "patrimonio/produtos",
            "namepage" => "Produtos",
            "name" => "Lista",
            "registers" => (object)[
                "disabled" => $product->find("status = :s", "s=disabled")->count()
            ]
        ]);
    }

        /**
     * @param array|null $data
     * @throws \Exception
     */
    /** @return void */
    public function disabledProducts(): void
    {
        $head = $this->seo->render(
            "Produtos Desabilitados - " . CONF_SITE_NAME ,
            "Lista de Produtos Desativados",
            url("/painel/patrimonio/produtos/desativados"),
            theme("/assets/images/favicon.ico")
        );

        $product = (new Product());
        $products = $product->find("status = :s", "s=disabled")->fetch(true);

        echo $this->view->render("widgets/patrimonys/products/disabledList",
            [
                "admin" => "produtos",
                "head" => $head,
                "products" => $products,
                "urls" => "patrimonio/produtos",
                "namepage" => "Produtos",
                "name" => "Lista"
            ]);

    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function product(?array $data): void
    {
        $user = (new User())->findById($this->user->id);

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $productCreate = new Product();
            $productCreate->brand_id = preg_replace("/[^0-9\s]/", "", $data["brand_id"]);
            $productCreate->product_name = $data["product_name"];
            $productCreate->description = $data["description"];
            $productCreate->login_created = $user->login;
            $productCreate->created_at = date_fmt('', "Y-m-d h:m:s");

            if(in_array("", $data)){
                $json['message'] = $this->message->info("Informe a marca, o produto e descrição para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$productCreate->save()) {
                $json["message"] = $productCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Producto {$productCreate->product_name} cadastrado com sucesso...")->icon("emoji-grin me-1")->flash();
            $json["redirect"] = url("/painel/patrimonio/produtos/cadastrar");

            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $productUpdate = (new Product())->findById($data["product_id"]);

            if (!$productUpdate) {
                $this->message->error("Você tentou gerenciar uma marca que não existe")->icon("gift")->flash();
                echo json_encode(["redirect" => url("/painel/patrimonio/produtos")]);
                return;
            }

            $productUpdate = (new Product())->findById($data["product_id"]);
            $productUpdate->brand_id = preg_replace("/[^0-9\s]/", "", $data["brand_id"]);
            $productUpdate->product_name = $data["product_name"];
            $productUpdate->description = $data["description"];
            $productUpdate->login_updated = $user->login;
            $productUpdate->updated_at = date_fmt('', "Y-m-d h:m:s");

            if(in_array("", $data)){
                $json['message'] = $this->message->info("Informe a marca, descrição e status para criar o registro !")->icon()->render();
                echo json_encode($json);
                return;
            }

            if (!$productUpdate->save()) {
                $json["message"] = $productUpdate->message()->render();
                echo json_encode($json);
                return;
            }

            $json["message"] = $this->message->success("Producto {$productUpdate->product_name} atualizada com sucesso !!!")->icon("emoji-grin me-1")->render();
            echo json_encode($json);
            return;
        }

          //actived
         if (!empty($data["action"]) && $data["action"] == "actived") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $productActived = (new Product())->findById($data["product_id"]);

            if (!$productActived) {
                $this->message->error("Você tentou gerenciar uma marca que não existe")->icon("gift")->flash();
                echo json_encode(["redirect" => url("/painel/patrimonio/produtos")]);
                return;
            }

            $productActived->status = "actived";
            $productActived->login_updated = $user->login;

            if (!$productActived->save()) {
                $json["message"] = $productActived->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Producto {$productActived->product_name} reativada com sucesso !!!")->icon("gift")->flash();
            redirect("/painel/patrimonio/produtos/desativados");
            return;
        }

        
         //disabled
         if (!empty($data["action"]) && $data["action"] == "disabled") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $productDisabled = (new Product())->findById($data["product_id"]);

            if (!$productDisabled) {
                $this->message->error("Você tentou gerenciar uma marca que não existe")->icon("gift")->flash();
                echo json_encode(["redirect" => url("/painel/patrimonio/produtos")]);
                return;
            }

            $productDisabled->status = "disabled";
            $productDisabled->login_updated = $user->login;

            if (!$productDisabled->save()) {
                $json["message"] = $productDisabled->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Producto {$productDisabled->product_name} desativada com sucesso !!!")->icon("gift")->flash();
            redirect("/painel/patrimonio/produtos");
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $productDelete = (new Product())->findById($data["product_id"]);

            if (!$productDelete) {
                $this->message->error("Você tentou deletar uma marca que não existe")->icon("gift")->flash();
                echo json_encode(["redirect" => url("/painel/patrimonio/produtos")]);
                return;
            }

            $productDelete->destroy();

            $this->message->success("A marca {$productDelete->product_name} foi excluída com sucesso...")->icon("gift")->flash();
            redirect("/painel/patrimonio/produtos");
            return;
        }

       $brands = new Brand();

        $productEdit = null;
        if (!empty($data["product_id"])) {
            $productId = filter_var($data["product_id"], FILTER_VALIDATE_INT);
            $productEdit = (new Product())->findById($productId);
        }

        $head = $this->seo->render(
            "Produtos - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/favicon.ico"),
            false
        );

        echo $this->view->render("widgets/patrimonys/products/product", [
            "head" => $head,
            "produtos" => $productEdit,
            "brands" => $brands,
            "urls" => ($productEdit ? "produtos/editar/{$productEdit->id}" : "cadastrar"),
            "namepage" => "Produtos",
            "name" => ($productEdit ? "Editar" : "Cadastrar")
        ]);
    }
}