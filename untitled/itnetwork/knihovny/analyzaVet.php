<?php
/**
* Knihovna pro analýzu vět
*/

/**
* Spočítá počet samohlásek v textu
*
* @param string $text Text
* @return int Počet samohlásek v textu
*/
function pocetSamohlasek(string $text)
{
$text = mb_strtoupper($text);
$delka = mb_strlen($text);
$samohlasky = array('A', 'E', 'I', 'O', 'U', 'Y');
$pocet = 0;
for ($i = 0; $i < $delka; $i++) {
$znak = mb_substr($text, $i, 1);
if (in_array($znak, $samohlasky))
$pocet++;
}
return $pocet;
}

/**
* Spočítá počet souhlásek v textu
*
* @param string $text Text
* @return int Počet souhlásek v textu
*/
function pocetSouhlasek(string $text)
{
$text = mb_strtoupper($text);
$delka = mb_strlen($text);
$souhlasky = array('B', 'C', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Z');
$pocet = 0;
for ($i = 0; $i < $delka; $i++) {
$znak = mb_substr($text, $i, 1);
if (in_array($znak, $souhlasky))
$pocet++;
}
return $pocet;
}