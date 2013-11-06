<?php
define('NGS_UPDATE', null);
require_once __DIR__.'/../../dsl/generated/php/public/index.php';

function greska($kod, $poruka) {
	http_response_code($kod);
	die(json_encode(array(
		'status' => false,
		'poruka' => $poruka
	)));
}

define('URI', 'http://emajliramokade.com:10080');

if (!isset($_FILES['slika'])) {
	greska(400, 'POST parameter "slika" nije poslan!');
}

$file = $_FILES['slika'];
$filename = $file['tmp_name'];

if (!is_uploaded_file($filename)) {
	greska(400, 'Ne mogu ucitati poslanu datoteku.');
}

$eventData = array();
$nosqlData = new ImageSave\Zahtjev();

try {
	$slika = new Imagick($filename);
	$slika->setImageFormat('jpeg');
} catch (\Exception $e) {
	greska(400, 'Ne mogu ucitati poslanu datoteku: '.$e->getMessage());
}

try {
	$presets = Resursi\MaxDimenzije::findAll();
} catch (\Exception $e) {
	greska(400, 'Platforma javlja gresku: '.$e->getMessage());
}

$original = array_filter($presets, function($preset) { return $preset->URI === 'original'; });
$original = array_pop($original);

$geo = $slika->getImageGeometry();
if ($geo['width'] > $original->width || $geo['height'] > $original->height) {
	greska(400, 'Prevelika slika!');
}

try {
	$pathinfo = pathinfo($file['name']);
	foreach ($presets as $preset) {
		$presetName = strtolower($preset->URI);

		$tmpslika = $slika->clone();
		if ($preset->URI !== 'original')
			$tmpslika->adaptiveResizeImage($preset->width, $preset->height, true);

		$geo = $tmpslika->getImageGeometry();
		$format = strtolower($tmpslika->getImageFormat());
		$blob = $tmpslika->getImageBlob();
		$tmpslika->destroy();

		$nosqlData->$presetName = base64_encode($blob);
		$eventData[$presetName] = array(
			'ime' => $pathinfo['filename'],
			'format' => $format,
			'width' => $geo['width'],
			'height' => $geo['height'],
			'size' => strlen($blob)
		);
	}
} catch (\Exception $e) {
	greska(400, 'Greska pri smanjivanju slika: ' . $e->getMessage());
}

/*
$pixels = $slika->exportImagePixels(0, 0, $geo['width'], $geo['height'], "RGBA", imagick::PIXEL_CHAR);
$strPixels = '';
foreach ($pixels as $pixel)
	$strPixels .= chr($pixel);
$sha1Pixels = sha1($strPixels);
*/
$sha1Bytes = sha1_file($filename, true);

$uuid = new NGS\UUID();

$nosqlData->kadaID = $uuid;

try {
	$eventData['kadaID'] = $uuid;
	$eventData['digest'] = new Resursi\Fingerprint(array(
		'sha1Bytes' => base64_encode($sha1Bytes),
		//'sha1Pixels' => base64_encode($sha1Pixels)
	));

	$KadaDodana = new PopisKada\KadaDodana($eventData);
	$KadaDodana->submit();
} catch (\Exception $e) {
	greska(400, 'Greska prilikom spremanja podataka o podacima (aka metadata): ' . $e->getMessage());
}

try {
	$uri = URI . '/crud/Kada/' . $uuid . '/Slike';
	$http = new NGS\Client\HttpRequest($uri, 'PUT', $nosqlData->toJson());
	$http->send();
} catch (\Exception $e) {
	greska(400, 'Greska prilikom spremanja slike: ' . $e->getMessage());
}

echo json_encode(array(
	'status' => true,
	'poruka' => 'Zaprimili smo kadu, thanks! Stavit ćemo je gore ako nije NSFW ili stock'
));

/*
header('Content-type: image/jpeg');
echo file_get_contents('http://emajliramokade.com:10080/public/Slike/'.$uuid.'/Web');
 */

