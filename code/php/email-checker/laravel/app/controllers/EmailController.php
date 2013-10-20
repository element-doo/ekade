<?php

class EmailController extends Controller
{
    protected function check($email)
    {
        $checkDNS = true;
        $errorLevel = 0;
        $result = is_email($email, $checkDNS, $errorLevel, $parseData);

        $status = $result === ISEMAIL_VALID;
        switch($result) {
            case ISEMAIL_DNSWARN_NO_MX_RECORD:
                $poruka = 'Ova domena ne prima emailove: ' . $parseData[1];
                break;

            case ISEMAIL_DNSWARN_NO_RECORD:
                $poruka = 'Ova domena ne postoji: ' . $parseData[1];
                break;

            case ISEMAIL_VALID:
                $poruka = 'Sve OK!';
                break;

            default:
                $poruka = 'Neispravan email!';
        }

        return Response::json(array('status' => $status, 'poruka' => $poruka));
    }
}