<?php
function chemin_photo($repertoire, $nomfichier)
{
	if (file_exists($repertoire . '/' . $nomfichier . '.jpg'))
		$ext = $repertoire . '/' . $nomfichier . '.jpg';
	if (file_exists($repertoire . '/' . $nomfichier . '.png'))
		$ext = $repertoire . '/' . $nomfichier . '.png';
	if (file_exists($repertoire . '/' . $nomfichier . '.jpeg'))
		$ext = $repertoire . '/' . $nomfichier . '.jpeg';
	if (file_exists($repertoire . '/' . $nomfichier . '.tiff'))
		$ext = $repertoire . '/' . $nomfichier . '.tiff';
	if (file_exists($repertoire . '/' . $nomfichier . '.gif'))
		$ext = $repertoire . '/' . $nomfichier . '.gif';
	if (file_exists($repertoire . '/' . $nomfichier . '.bmp'))
		$ext = $repertoire . '/' . $nomfichier . '.bmp';
	return $ext;
}
