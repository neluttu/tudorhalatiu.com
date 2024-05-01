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
		$cookieOptions = [
			'expires' => time() + 3600, 
			'path' => '/', 
			'httponly' => true,
			'samesite' => 'strict'
		];

		setcookie($this->cookieName, json_encode($productViews), $cookieOptions);
	}
	
    private function incrementDatabaseCounter($productID) {
        $db = App::resolve(Database::class);
        if(!$db->query("SELECT product_id FROM product_views WHERE product_id = :productID AND date = :date", ["productID" => $productID, "date" => date("Y-m-d")])->get())
            $db->query("INSERT INTO product_views (product_id, date) VALUES (:productID, :date)", ["productID" => $productID, "date" => date('Y-m-d')]);
        else            
            $db->query("UPDATE product_views SET views = views + 1 WHERE product_id = :productID AND date = :date", 
                    [
                        "productID" => $productID,
                        "date" => date('Y-m-d')
                    ]);
    }
}