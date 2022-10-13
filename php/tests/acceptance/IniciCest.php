<?php

class IniciCest
{
    const INICI = '/inici.php';

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

}
