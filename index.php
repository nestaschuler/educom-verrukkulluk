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
/// Database verbinden 

$connection = new mysqli("localhost", "root", "", "ver");
if ($connection->connect_error) {
    die("Databaseconnection failed". $connection->connect_error); 
}

require_once("lib/database.php");
require_once("lib/groceries.php");
require_once("lib/ingredients.php");
require_once("lib/kitchentype.php");
require_once("lib/product.php");
require_once("lib/recipe.php");
require_once("lib/RecipeInfo.php");
require_once("lib/user.php"); 

$recipe = new Recipe($connection);
$recipe_id = isset($_GET["recipe_id"]) ? (int)$_GET["recipe_id"]: 0; 



/*
URL:
http://localhost/index.php?recipe_id=4&action=detail
*/

$recipe_id = isset($_GET["recipe_id"]) ? $_GET["recipe_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";


switch($action) {

        case "homepage": {
            $data = $recipe->selectRecipe($recipe_id);
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



/// Gebruiker klikt ster → JavaScript vangt klik op → stuurt naar index.php?action=rating → PHP slaat op in database → PHP stuurt {"success":true} terug → JavaScript ontvangt dat en update de sterren///
            

        case "rating": {
            $rating = $_GET["rating"];                                                  
            $recipe->addRating($recipe_id, $rating);
            $newAverage = $recipe->selectAverageRating($recipe_id); 
            header("Content-Type: application/json");

            echo json_encode([
                "success" => true,
                "rating" => $rating, 
                "newAverage" => $newAverage,
            ]); 
            exit;
        }

/// gebruiker klikt op hartje -> hartje moet vullen -> gerecht moet worden toegevoegd aan favourites
        case "addFavorite": {
            $recipe_id = $_POST['recipe_id']; 
            $user_id= 1; 
            $recipe->addFavorite($user_id, $recipe_id); 
            header("Content-Type: application/json"); 

            echo json_encode([
                "success" => true,
            ]);
            exit; 
            
        }

//Groceries list gaan we maken
        case "groceries": {
                $user_id = 1;
                $groceries = new Groceries($connection);
                $data = $groceries->selectGroceries($user_id);
                $template = 'groceries.html.twig';
                $title = 'groceries';
                break; 
        }

        case "onlist": {
            $user_id = 1;
            $groceries = new Groceries($connection);
            $groceries->addGroceries($recipe_id, $user_id);
            header("Location: index.php?action=groceries&recipe_id=" . $recipe_id);
            exit;
        }

        case "deleteGrocery": {
            $user_id = 1;
            $product_id = $_POST['product_id'];
            $groceries = new Groceries($connection);
            $groceries->deleteGroceryItem($user_id, $product_id);
            header('Content-Type: application/json');
            
            echo json_encode(["success" => true]);
            exit;
        }

}

/// Onderstaande code schrijf je idealiter in een layout klasse of iets dergelijks
/// Juiste template laden, in dit geval "homepage"
$template = $twig->load($template);


/// En tonen die handel!
echo $template->render(["title" => $title, "data" => $data]);
