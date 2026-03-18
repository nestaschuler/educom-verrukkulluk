<?php
//// Allereerst zorgen dat de "Autoloader" uit vendor opgenomen wordt:
require_once("./vendor/autoload.php");

/// Twig koppelen:
$loader = new \Twig\Loader\FilesystemLoader("./templates");
/// VOOR PRODUCTIE:
/// $twig = new \Twig\Environment($loader), ["cache" => "./cache/cc"]);

/// VOOR DEVELOPMENT:
$twig = new \Twig\Environment($loader, ["debug" => true ]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

/******************************/

/// Next step, iets met je data doen. Ophalen of zo
require_once("fase-2/lib/recipe.php");
$recipe = new Recipe(1);
$data = $recipe->selectRecipe(1);


/*
URL:
http://localhost/index.php?recipe_id=4&action=detail
*/

$recipe_id = isset($_GET["recipe_id"]) ? $_GET["recipe_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";


switch($action) {

        case "homepage": {
            $data = $recipe->selectRecipe();
            $template = 'homepage.html.twig';
            $title = "homepage";
            break;
        }

        case "detail": {
            $data = $recipe->selectRecipe($recipe_id);
            $template = 'detail.html.twig';
            $title = "detail pagina";
            break;
        }

        /// etc

}


/// Onderstaande code schrijf je idealiter in een layout klasse of iets dergelijks
/// Juiste template laden, in dit geval "homepage"
$template = $twig->load($template);


/// En tonen die handel!
echo $template->render(["title" => $title, "data" => $data]);
