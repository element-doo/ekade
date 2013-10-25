<?php
require_once __DIR__.'/../../dsl/generated/php/public/index.php';

define('URI', 'http://emajliramokade.com:10080');

$file = $_FILES['slika'];
$filename = $file['tmp_name'];

if (!is_uploaded_file($filename))
	die();

$eventData = array();
$nosqlData = new ImageSave\Zahtjev();

$slika = new Imagick($filename);
$slika->setImageFormat('jpeg');

$presets = Resursi\MaxDimenzije::findAll();
$original = array_filter($presets, function($preset) { return $preset->URI === 'original'; });
$original = array_pop($original);

$geo = $slika->getImageGeometry();
if ($geo['width'] > $original->width || $geo['height'] > $original->height) {
	header (':', true, 400);
	die ('Prevelika slika!');
}

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
$eventData['kadaID'] = $uuid;
$eventData['digest'] = new Resursi\Fingerprint(array(
	'sha1Bytes' => base64_encode($sha1Bytes),
	//'sha1Pixels' => base64_encode($sha1Pixels)
));

$KadaDodana = new PopisKada\KadaDodana($eventData);
$KadaDodana->submit();

$uri = URI . '/crud/Kada/' . $uuid . '/Slike';
$http = new NGS\Client\HttpRequest($uri, 'PUT', $nosqlData->toJson());
$http->send();

/*
header('Content-type: image/jpeg');
echo file_get_contents('http://emajliramokade.com:10080/public/Slike/'.$uuid.'/Web');
 */

