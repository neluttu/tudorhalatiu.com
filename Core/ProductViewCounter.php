<?

namespace Core;

use Core\Database;
use Core\App;

class ProductViewCounter {
    private $cookieName = 'product_views';
    public function incrementProductView($productID) {
        $productViews = $this->getProductViews();

        if(!isset($productViews[$productID])) {
            $productViews[$productID] = 1;
            $this->setProductViews($productViews);
            $this->incrementDatabaseCounter($productID);
        }
    }

    private function getProductViews() {
        if(isset($_COOKIE[$this->cookieName]))
            return json_decode($_COOKIE[$this->cookieName], true);
    
        return [];
    }

    private function setProductViews($productViews) {
        setcookie($this->cookieName, json_encode($productViews), time()+3600, '/');
    }

    private function incrementDatabaseCounter($productID) {
        $db = App::resolve(Database::class);
        $db->query("UPDATE product_views SET views = views + 1 WHERE product_id = :productID", 
                    [
                        "productID" => $productID
                    ]);
    }
}