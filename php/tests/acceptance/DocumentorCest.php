<?php

class DocumentorCest
{
    public function _before(AcceptanceTester $I)
    {
    }


    public function try521WorksIndexTest(AcceptanceTester $I)
    {
        $I->amOnPage('/docs/api/packages/Application.html');
        $I->see('Resumible');
        $I->see('CintaVideo');
        $I->see('Classe per a guardar els socis del videoclub');
    }

    public function try521WorksClienteTest(AcceptanceTester $I)
    {
        $I->amOnPage('docs/api/classes/Dwes-ProyectoVideoClub-Cliente.html');
        $I->see('public alquilar');
        $I->see('CupoSuperadoException');

        $I->see('public getAlquileres() : array<string|int, mixed>');
        $I->see('public tienesAlquilado');

    }

}
