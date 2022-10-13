<?php

class IniciCest
{
    const INICI = '/inici.php';
    const INICI2 = '/inici2.php';

    public function try320Test(AcceptanceTester $I)
    {
        $I->amOnPage(self::INICI);
        $I->seeInSource('Tenet<br>3 € (IVA no incluido)');
    }

    public function try321Test(AcceptanceTester $I)
    {
        $I->amOnPage(self::INICI);
        $I->see('Duracion: 107 minutos');
    }

    public function try322Test(AcceptanceTester $I)
    {
        $I->amOnPage(self::INICI);
        $I->see('Idiomas: es,en,fr');
        $I->see('Formato de pantalla: 16:9');
    }

    public function try326Test(AcceptanceTester $I)
    {
        $I->amOnPage(self::INICI2);
        $I->see('El identificador del cliente 1 es: 23');
        $I->see('Alquilado soporte a: Bruce Wayne');
        $I->seeInSource('<p>No se ha podido encontrar el soporte en los alquileres de este cliente</p>');
        $I->seeInSource('<p>Este cliente tiene 3 elementos alquilados. No puede alquilar más en este videoclub hasta que no devuelva algo</p>');
        $I->seeInSource('<p>Este cliente no tiene alquilado ningún elemento</p>');

    }

}
