<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'autoload.php';

class Router
{
    private $routes = [];

    // On stocke la route et l'action associée
    public function addRoute($uri, $controllerMethod)
    {
        $this->routes[trim($uri, '/')] = $controllerMethod;
    }

    public function route()
    {
        // 1. Quelle est l'adresse demandée par le navigateur ?
        $uri = $_SERVER['REQUEST_URI'];

        // 2. Quel est le dossier où se trouve le site ? (ex: /mon_site)
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
        
        // 3. On enlève le nom du dossier de l'adresse pour ne garder que la fin
        // Si l'adresse est "/mon_site/combat/data", on garde juste "combat/data"
        if (strpos($uri, $scriptDir) === 0) {
            $uri = substr($uri, strlen($scriptDir));
        }

        // Nettoyage final (enlève index.php et les slashs inutiles)
        $uri = str_replace('/index.php', '', $uri);
        $uri = explode('?', $uri)[0]; // Enlève les ?id=1...
        $url = trim($uri, '/');

        // 4. On cherche si cette adresse existe dans notre liste
        foreach ($this->routes as $route => $controllerMethod) {
            // ... (Votre logique de détection de paramètres {id} ...)
            $routeParts = explode('/', $route);
            $urlParts = explode('/', $url);

            if (count($routeParts) === count($urlParts)) {
                $params = [];
                $isMatch = true;
                foreach ($routeParts as $index => $part) {
                    if (preg_match('/^{\w+}$/', $part)) {
                        $params[] = $urlParts[$index];
                    } elseif ($part !== $urlParts[$index]) {
                        $isMatch = false;
                        break;
                    }
                }

                if ($isMatch) {
                    // TROUVÉ ! On lance le contrôleur
                    list($controllerName, $methodName) = explode('@', $controllerMethod);
                    
                    if (class_exists($controllerName)) {
                        $controller = new $controllerName();
                        if (method_exists($controller, $methodName)) {
                            call_user_func_array([$controller, $methodName], $params);
                            return;
                        }
                    }
                    die("Erreur config : $controllerName ou $methodName introuvable.");
                }
            }
        }

        // Si on arrive ici, c'est que la route n'existe pas
        // DEBUG : Affiche ce que le routeur a reçu pour comprendre l'erreur
        http_response_code(404);
        echo "<h1>Erreur 404</h1>";
        echo "<p>Le routeur a reçu : <strong>[$url]</strong></p>";
        echo "<p>Mais il ne connait que : " . implode(', ', array_keys($this->routes)) . "</p>";
    }
}



// Instanciation du routeur
$router = new Router("DungeonXplorer");

// Ajout des routes
// Pour la racine
$router->addRoute('', 'HomeController@index'); 

$router->addRoute('home', 'HomeController@index');
$router->addRoute('connexion', 'HomeController@connexion');
$router->addRoute('inscription', 'HomeController@inscription');
$router->addRoute('deconnexion', 'HomeController@deconnexion');
$router->addRoute('newgame', 'HeroController@index');
$router->addRoute('creationperso', 'HeroController@create');
$router->addRoute('chapitre/{id}', 'ChapterController@show');
$router->addRoute('load', 'ChapterController@load');
$router->addRoute('account', 'AccountController@index');
$router->addRoute('deleteAccount', 'AccountController@deleteAccount');

// Routes combat
$router->addRoute('combat', 'CombatController@index');
$router->addRoute('combat/data', 'CombatController@getCombatData');
$router->addRoute('combat/potion', 'CombatController@usePotion');
$router->addRoute('combat/end', 'CombatController@endCombat');

// === ROUTES ADMINISTRATION ===
$router->addRoute('admin', 'AdminController@index');

// Chapitres
$router->addRoute('admin/getChapters', 'AdminController@getChapters');
$router->addRoute('admin/addChapter', 'AdminController@addChapter');
$router->addRoute('admin/updateChapter', 'AdminController@updateChapter');
$router->addRoute('admin/deleteChapter', 'AdminController@deleteChapter');

// Connexion et inscription

$router->addRoute('connexion', 'HomeController@connexion');
$router->addRoute('inscription', 'HomeController@inscription');
$router->addRoute('deconnexion', 'HomeController@deconnexion');

//creation personnage

$router->addRoute('newgame', 'HeroController@index');
$router->addRoute('creationperso', 'HeroController@create');


//affichage chapitre

$router->addRoute('chapitre/{id}', 'ChapterController@show');


// Trésors
$router->addRoute('admin/getTreasures', 'AdminController@getTreasures');
$router->addRoute('admin/addTreasure', 'AdminController@addTreasure');
$router->addRoute('admin/updateTreasure', 'AdminController@updateTreasure');
$router->addRoute('admin/deleteTreasure', 'AdminController@deleteTreasure');

// Gestion des POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['route'])) {
    //echo "Route POST demandée : " . $_POST['route'] . "<br>";
    $router->route($_POST['route']);
    exit;
}

// Appel de la méthode route
$router->route(trim($_SERVER['REQUEST_URI'], '/'));

// Lancement
$router->route();
?>