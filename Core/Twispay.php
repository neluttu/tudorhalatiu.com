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
        return '7c952ebc1a6a529e0baadc6368d5ffec';
    }

    public static function getSiteID() {
        return 689;
    }

    public static function code($code) {
        $codes = [
            844 => 'Răspuns invalid.',
            840 => 'Nu am primit un răspuns ferm de la procesatorul de plăți superior. Considerați tranzacția eșuată.',
            838 => 'Eroare de comunicare, vă rugăm reîncercați.',
            837 => 'Transacție respinsă de furnizorul de plăți.',
            836 => 'Tranziacție respinsă de către bancă.',
            835 => 'Tranziacție respinsă, fonduri insuficiente.',
            834 => 'Tranziacție suspectată de fraudă.',
            830 => 'Tranzacție respinsă: status invalid.',
            825 => 'Tranziacția există deja.',
        ];
        return '#' . $code . ' - ' . $codes[$code];
    }

    public static function getOrder($id = '') {
        $ch = curl_init();
        $url = $id ? "https://api-stage.xmoney.com/order/" . $id : "https://api-stage.xmoney.com/order";

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