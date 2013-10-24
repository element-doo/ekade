<?php

class ZahtjevController extends Controller
{
    protected function check()
    {
        $request = Request::instance();
        $body = $request->getContent();
        $zahtjev = \EmailProvjera\ZahtjevJsonConverter::fromJson($body);

        $email = $zahtjev->email;
        $checkDNS = true;
        $errorLevel = 0;
        $result = is_email($email, $checkDNS, $errorLevel, $parseData);

        $odgovor = new \EmailProvjera\Odgovor();
        $odgovor->status = $result === ISEMAIL_VALID;

        switch($result) {
            case ISEMAIL_DNSWARN_NO_MX_RECORD:
                $odgovor->poruka = 'Ova domena ne prima emailove: ' . $parseData[1];
                break;

            case ISEMAIL_DNSWARN_NO_RECORD:
                $odgovor->poruka = 'Ova domena ne postoji: ' . $parseData[1];
                break;

            case ISEMAIL_VALID:
                $odgovor->poruka = 'Sve OK!';
                break;

            default:
                $odgovor->poruka = 'Neispravan email!';
        }

        return Response::json($odgovor->toArray());
    }
}