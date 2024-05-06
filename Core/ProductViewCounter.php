<?php

namespace Core;

use Core\Database;
use Core\App;

class ProductViewCounter {
    private $cookieName = 'page_views';
    private $expiryTime = 1800;

    public function incrementPageView($productID) {
        $pageViews = $this->getPageViews();

        if (!isset($pageViews[$productID]) || $this->isExpired($pageViews[$productID])) {
            $pageViews[$productID] = time();

            $this->setPageViews($pageViews);
            $this->incrementDatabaseCounter($productID);
        }
    }

    private function getPageViews() {
        if (isset($_COOKIE[$this->cookieName])) {
            return json_decode($_COOKIE[$this->cookieName], true);
        }
        return [];
    }

    private function setPageViews($pageViews) {
        $cookieOptions = [
            'expires' => time() + $this->expiryTime,
            'path' => '/',
            'httponly' => true,
            'secure' => true,
            'samesite' => 'strict'
        ];

        setcookie($this->cookieName, json_encode($pageViews), $cookieOptions);
    }

    private function isExpired($timestamp) {
        return (time() - $timestamp) >= $this->expiryTime;
    }

    private function incrementDatabaseCounter($productID) {
        $db = App::resolve(Database::class);
        $date = date('Y-m-d');

        // Verificăm dacă există o înregistrare pentru acest produs în aceeași zi
        $existingRecord = $db->query("SELECT * FROM product_views WHERE product_id = :productID AND date = :date", ["productID" => $productID, "date" => $date])->get();

        if (!$existingRecord) {
            // Nu există o înregistrare, inserăm una nouă
            $db->query("INSERT INTO product_views (product_id, date, views) VALUES (:productID, :date, 1)", ["productID" => $productID, "date" => $date]);
        
        } else {
            // Actualizăm numărul de vizualizări existent
            $db->query("UPDATE product_views SET views = views + 1 WHERE product_id = :productID AND date = :date", ["productID" => $productID, "date" => $date]);
        }
    }
}
