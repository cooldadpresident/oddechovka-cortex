<?php
/*
 *  _____ _______         _                      _
 * |_   _|__   __|       | |                    | |
 *   | |    | |_ __   ___| |___      _____  _ __| | __  ___ ____
 *   | |    | | '_ \ / _ \ __\ \ /\ / / _ \| '__| |/ / / __|_  /
 *  _| |_   | | | | |  __/ |_ \ V  V / (_) | |  |   < | (__ / /
 * |_____|  |_|_| |_|\___|\__| \_/\_/ \___/|_|  |_|\_(_)___/___|
 *                   ___
 *                  |  _|___ ___ ___
 *                  |  _|  _| -_| -_|  LICENCE
 *                  |_| |_| |___|___|
 *
 *    REKVALIFIKAČNÍ KURZY  <>  PROGRAMOVÁNÍ  <>  IT KARIÉRA
 *
 * Tento zdrojový kód pochází z IT kurzů na WWW.ITNETWORK.CZ
 *
 * Můžete ho upravovat a používat jak chcete, musíte však zmínit
 * odkaz na http://www.itnetwork.cz
 */

mb_internal_encoding("UTF-8");

$hlaska = '';
if (isset($_GET['uspech']))
    $hlaska = 'Email byl úspěšně odeslán, brzy vám odpovíme.';
if ($_POST) { // V poli _POST něco je, odeslal se formulář
    if (
        isset($_POST['jmeno']) && $_POST['jmeno'] &&
        isset($_POST['email']) && $_POST['email'] &&
        isset($_POST['zprava']) && $_POST['zprava'] &&
        isset($_POST['rok']) && $_POST['rok'] == date('Y')
    ) {
        $hlavicka = 'From:' . $_POST['email'];
        $hlavicka .= "\nMIME-Version: 1.0\n";
        $hlavicka .= "Content-Type: text/html; charset=\"utf-8\"\n";
        $adresa = 'vas@email.cz';
        $predmet = 'Nová zpráva z mailformu';
        $uspech = mb_send_mail($adresa, $predmet, $_POST['zprava'], $hlavicka);
        if ($uspech) {
            $hlaska = 'Email byl úspěšně odeslán, brzy vám odpovíme.';
            header('Location: mailform.php?uspech=ano');
            exit;
        } else
            $hlaska = 'Email se nepodařilo odeslat. Zkontrolujte adresu.';
    } else
        $hlaska = 'Formulář není správně vyplněný!';
}

?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Kontaktní formulář</title>
</head>

<body>
    <p>Můžete mě kontaktovat pomocí formuláře níže.</p>

    <?php
    if ($hlaska)
        echo ('<p>' . htmlspecialchars($hlaska) . '</p>');

    $jmeno = (isset($_POST['jmeno'])) ? $_POST['jmeno'] : '';
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $zprava = (isset($_POST['zprava'])) ? $_POST['zprava'] : '';
    ?>

    <form method="POST">
        <table>
            <tr>
                <td>Vaše jméno</td>
                <td><input name="jmeno" type="text" value="<?= htmlspecialchars($jmeno) ?>" /></td>
            </tr>
            <tr>
                <td>Váš email</td>
                <td><input name="email" type="email" value="<?= htmlspecialchars($email) ?>" /></td>
            </tr>
            <tr>
                <td>Aktuální rok</td>
                <td><input name="rok" type="number" /></td>
            </tr>
        </table>
        <textarea name="zprava"><?= htmlspecialchars($zprava) ?></textarea>
        <br />

        <input type="submit" value="Odeslat" />
    </form>

</body>

</html>