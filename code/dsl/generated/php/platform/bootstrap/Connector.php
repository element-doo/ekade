<?php
namespace NGS;

abstract class Connector
{
    const URL = 'https://api.dsl-platform.com/alpha/';

    private static function curlSend($data, $action, $params = '')
    {
        $curl = curl_init(self::URL.$action.'/'.Project::$ID.$params);

        $body = json_encode($data, JSON_FORCE_OBJECT);

        if (Config::$html)
            $headers = array(
                'Accept: text/html; charset=UTF-8',
                'Content-type: application/json; charset=UTF-8'
            );
        else
            $headers = array(
                'Accept: text/plain; charset=UTF-8',
                'Content-type: application/json; charset=UTF-8'
            );

        $headers[] = 'X-Token-Auth: '.Login::getToken();

        if (Login::inProcess()) {
            $headers[] = "X-Log-Errors: plain";
        }

        if (\Bootstrap::canCompress()) {
            $body = gzdeflate($body);
            curl_setopt($curl, CURLOPT_ENCODING, 'deflate');
            $headers[] ='Content-Encoding: deflate';
        }

        curl_setopt_array($curl, array(
            CURLOPT_CAINFO => \Bootstrap::ensureCertPath(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_POST => true,
            CURLOPT_HEADERFUNCTION => array('\NGS\Connector', 'headerParser')
        ));

        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);

        $ok = $status >= 200 && $status < 300;
        if (strlen($error) > 0) {
            $response = $error;
        }

        return array(
            'ok' => $ok,
            'status' => $status,
            'data' => $response
        );
    }

    public static function headerParser($curl, $header) {
        $len = strlen($header);

        if ($len > 13 && substr($header, 0, 13) === 'X-Token-Auth:') {
            $token = trim(substr($header, 13));
            if (strlen($token) === 0) $token = null;
            Login::setToken($token);
        }

        return $len;
    }

    public static function call(array $dsls, $confirmUnsafe = false)
    {
        return self::curlSend($dsls, 'update', $confirmUnsafe === true
            ? '?target=PHP&migration=unsafe'
            : '?target=PHP');
    }

    public static function diff(array $dsls)
    {
        $params = '';
        if (!file_exists(__DIR__.'/../modules/NGS/Requirements.php') && Config::$html)
            $params = '?firstCompilation';

        return self::curlSend($dsls, 'diff', $params);
    }
}
