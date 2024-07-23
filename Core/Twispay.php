<?
namespace Core;

class Twispay
{
    public static function getBase64JsonRequest(array $orderData)
    {
        return base64_encode(json_encode($orderData));
    }

    public static function getBase64Checksum(array $orderData, $secretKey)
    {
        $hmacSha512 = hash_hmac('sha512', json_encode($orderData), $secretKey, true);
        return base64_encode($hmacSha512);
    }

    public static function getKey() {
        return 'f0b8b70eadc6d16a34ffeccbfc8f619b';
    }

    public static function getSiteID() {
        return 8117;
    }

    public static function getOrder($id = '') {
        $ch = curl_init();
        $url = $id ? "https://api-stage.twispay.com/order/" . $id : "https://api-stage.twispay.com/order";

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . self::getKey(),
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            // Gestionarea erorilor cURL
            $error_msg = curl_error($ch);
            curl_close($ch);
            throw new \Exception("cURL Error: " . $error_msg);
        }
    
        curl_close($ch);
    
        $decodedResponse = json_decode($response, true);
        if(json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("JSON error: " . json_last_error_msg());
        }
    
        return $decodedResponse;
    }
} 