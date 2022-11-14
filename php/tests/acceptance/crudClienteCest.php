<?php

class crudClienteCest
{
    public function tryBotonCrearNouClientTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->fillField('username', 'admin');
        $I->fillField('password', 'admin');
        $I->click('submit');
        $I->seeInCurrentUrl('/mainAdmin.php');
        $I->seeInSource('<a id="Crear" class="btn btn-primary" href="formCreateCliente.php">Crear nou client</a>');
        $I->click('#Crear');
        $I->seeInCurrentUrl('formCreateCliente.php');
    }

    public function tryNewClienteSuccessTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->fillField('username', 'admin');
        $I->fillField('password', 'admin');
        $I->click('submit');
        $I->amOnPage('formCreateCliente.php');
        $I->fillField('nombre', 'Ignasi Gomis');
        $I->fillField('username', 'igomis');
        $I->fillField('password', '1234');
        $I->click('submit');
        $I->seeInCurrentUrl('/mainAdmin.php');
        $I->see('igomis');
        $I->see('Ignasi Gomis');
    }

    public function tryNewClienteFailTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->fillField('username', 'admin');
        $I->fillField('password', 'admin');
        $I->click('submit');
        $I->amOnPage('formCreateCliente.php');
        $I->fillField('nombre', 'Ignasi Gomis');
        $I->fillField('username', 'amancio');
        $I->fillField('password', '1234');
        $I->click('submit');
        $I->seeInCurrentUrl('/formCreateCliente.php');
        $I->see("Usuari ja donat d'alta");
        $I->amOnPage('formCreateCliente.php');
        $I->fillField('nombre', 'Ignasi Gomis');
        $I->fillField('username', 'pepe');
        $I->click('submit');
        $I->seeInCurrentUrl('/formCreateCliente.php');
        $I->see("Camp password buid");
    }

    public function tryNewClienteRemainsLogoutTest(AcceptanceTester $I){
        $I->amOnPage('/index.php');
        $I->fillField('username', 'admin');
        $I->fillField('password', 'admin');
        $I->click('submit');
        $I->amOnPage('formCreateCliente.php');
        $I->fillField('nombre', 'Ignasi Gomis');
        $I->fillField('username', 'igomis');
        $I->fillField('password', '1234');
        $I->click('submit');
        $I->amOnPage('/logout.php');
        $I->seeInCurrentUrl('/index.php');
        $I->fillField('username', 'admin');
        $I->fillField('password', 'admin');
        $I->click('submit');
        $I->seeInCurrentUrl('/mainAdmin.php');
        $I->see('igomis');
        $I->see('Ignasi Gomis');
    }

    public function tryBotonUpdateClientTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->fillField('username', 'admin');
        $I->fillField('password', 'admin');
        $I->click('submit');
        $I->seeInCurrentUrl('/mainAdmin.php');
        $I->seeInSource('<a id="mod_amancio" class="btn btn-info" href="formUpdateCliente.php?socio=amancio">Modificar Perfil</a>');
        $I->click('#mod_amancio');
        $I->seeInCurrentUrl('formUpdateCliente.php');
    }

    public function tryBotonDeleteClientTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->fillField('username', 'admin');
        $I->fillField('password', 'admin');
        $I->click('submit');
        $I->seeInCurrentUrl('/mainAdmin.php');
        $I->seeInSource('<a id="del_amancio" class="btn btn-danger" href="removeCliente.php?socio=amancio"');
        $I->click('#del_amancio');
        $I->seeInCurrentUrl('mainAdmin.php');
        $I->dontSee('amancio');
        $I->dontSee('Amancio Ortega');
    }

    public function tryUpdateClienteSuccessTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->fillField('username', 'admin');
        $I->fillField('password', 'admin');
        $I->click('submit');
        $I->amOnPage('formUpdateCliente.php?socio=amancio');
        $I->seeInSource('value="amancio"');
        $I->fillField('nombre', 'Marta Ortega');
        $I->fillField('username', 'marta');
        $I->click('submit');
        $I->seeInCurrentUrl('/mainAdmin.php');
        $I->see('marta');
        $I->dontSee('amancio');
        $I->see('Marta Ortega');
    }

    public function tryUpdateClienteFailTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->fillField('username', 'admin');
        $I->fillField('password', 'admin');
        $I->click('submit');
        $I->amOnPage('formUpdateCliente.php?socio=pablo');
        $I->fillField('username', 'amancio');
        $I->click('submit');
        $I->seeInCurrentUrl('/formUpdateCliente.php');
        $I->see("Usuari ja donat d'alta");
    }

    public function tryBotonUpdateClienteTest(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php');
        $I->fillField('username', 'amancio');
        $I->fillField('password', '1234');
        $I->click('submit');
        $I->seeInCurrentUrl('/mainCliente.php');
        $I->seeInSource('<a id="perfil" class="btn btn-info" href="formUpdateCliente.php?socio=amancio">Modificar Perfil</a>');
        $I->click('#perfil');
        $I->seeInCurrentUrl('formUpdateCliente.php');
        $I->fillField('nombre', 'Marta Ortega');
        $I->fillField('username', 'marta');
        $I->click('submit');
        $I->seeInCurrentUrl('/mainCliente.php');
        $I->see('marta');

    }


}