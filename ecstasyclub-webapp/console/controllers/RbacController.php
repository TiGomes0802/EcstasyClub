<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
    
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        
    //---------------------------------- Role -------------------------------------//

        $admin      = $auth->createRole('admin');
        $gestor     = $auth->createRole('gestor');
        $rp         = $auth->createRole('rp');
        $cliente    = $auth->createRole('cliente');
        $seguranca  = $auth->createRole('seguranca');
       
    //------------------------------- Permission ----------------------------------//

        //Ver dados estatísticos do seu código permission
            $verdadosEstatisticosCodigo = $auth->createPermission('verdadosEstatisticosCodigo');
            $verdadosEstatisticosCodigo->description = 'Ver dados estatísticos do seu código de RP';
            $auth->add($verdadosEstatisticosCodigo);

        //Add Comprar permission
            //Comprar
                $comprarPulseira = $auth->createPermission('comprarPulseira');
                $comprarPulseira->description = 'Comprar pulseira/VIP para evento';
                $auth->add($comprarPulseira);


        //Gestão dos empregados permission
            //View
                $viewEmpregado = $auth->createPermission('viewEmpregado');
                $viewEmpregado->description = 'View a Empregado';
                $auth->add($viewEmpregado);
            //Create
                $createEmpregado = $auth->createPermission('createEmpregado');
                $createEmpregado->description = 'Create a Empregado';
                $auth->add($createEmpregado);
            //Update
                $updateEmpregado = $auth->createPermission('updateEmpregado');
                $updateEmpregado->description = 'Update a Empregado';
                $auth->add($updateEmpregado);
            //Delete
                $deleteEmpregado = $auth->createPermission('deleteEmpregado');
                $deleteEmpregado->description = 'Delete a Empregado';
                $auth->add($deleteEmpregado);


        //Evento permission
            //View
                $viewEvento = $auth->createPermission('viewEvento');
                $viewEvento->description = 'View a evento';
                $auth->add($viewEvento);
            //Create
                $createEvento = $auth->createPermission('createEvento');
                $createEvento->description = 'Create a evento';
                $auth->add($createEvento);
            //Update
                $updateEvento = $auth->createPermission('updateEvento');
                $updateEvento->description = 'Update a evento';
                $auth->add($updateEvento);
            //Delete
                $deleteEvento = $auth->createPermission('deleteEvento');
                $deleteEvento->description = 'Delete a evento';
                $auth->add($deleteEvento);


        //Add Ver dados dos eventos passados permission
            $verDadosEvento = $auth->createPermission('verDadosEventos');
            $verDadosEvento->description = 'Ver dados dos eventos passados';
            $auth->add($verDadosEvento);


        //Add Adicionar fotografias permission
            //View
                $viewGaleria = $auth->createPermission('viewGaleria');
                $viewGaleria->description = 'View fotografia';
                $auth->add($viewGaleria);
            //Create
                $adicionarGaleria = $auth->createPermission('adicionarGaleria');
                $adicionarGaleria->description = 'Adicionar fotografia';
                $auth->add($adicionarGaleria);
            //Delete
                $deleteGaleria = $auth->createPermission('deleteGaleria');
                $deleteGaleria->description = 'Delete a fotografia';
                $auth->add($deleteGaleria);


        //Add Noticia permission
            //View
                $viewNoticia = $auth->createPermission('viewNoticia');
                $viewNoticia->description = 'View Noticia';
                $auth->add($viewNoticia);
            //Create
                $createNoticia = $auth->createPermission('createNoticia');
                $createNoticia->description = 'Create Noticia';
                $auth->add($createNoticia);
            //Update
                $updateNoticia = $auth->createPermission('updateNoticia');
                $updateNoticia->description = 'Update Noticia';
                $auth->add($updateNoticia);
            //Delete
                $deleteNoticia= $auth->createPermission('deleteNoticia');
                $deleteNoticia->description = 'Delete Noticia';
                $auth->add($deleteNoticia);

        //Add GestaoRp´s permission
            //View
                $viewRP = $auth->createPermission('viewRP');
                $viewRP->description = 'View RP';
                $auth->add($viewRP);
            //Create
                $createRP = $auth->createPermission('createRP');
                $createRP->description = 'Create RP';
                $auth->add($createRP);
            //Update
                $updateRP = $auth->createPermission('updateRP');
                $updateRP->description = 'Update RP';
                $auth->add($updateRP);
            //Delete
                $deleteRP = $auth->createPermission('deleteRP');
                $deleteRP->description = 'Delete RP';
                $auth->add($deleteRP);


        //Add Bebida permission
            //View
                $viewBebida = $auth->createPermission('viewBebida');
                $viewBebida->description = 'View Bebida';
                $auth->add($viewBebida);
            //Create
                $createBebida = $auth->createPermission('createBebida');
                $createBebida->description = 'Create Bebida';
                $auth->add($createBebida);
            //Update
                $updateBebida = $auth->createPermission('updateBebida');
                $updateBebida->description = 'Update Bebida';
                $auth->add($updateBebida);
            //Delete
                $deleteBebida = $auth->createPermission('deleteBebida');
                $deleteBebida->description = 'Delete Bebida';
                $auth->add($deleteBebida);

    //----------------------------- Add Permission --------------------------------//

        $auth->add($gestor);
        $auth->addChild($gestor, $viewEvento);
        $auth->addChild($gestor, $createEvento);
        $auth->addChild($gestor, $updateEvento);
        $auth->addChild($gestor, $deleteEvento);
        $auth->addChild($gestor, $viewNoticia);
        $auth->addChild($gestor, $createNoticia);
        $auth->addChild($gestor, $deleteNoticia);
        $auth->addChild($gestor, $updateNoticia);
        $auth->addChild($gestor, $viewBebida);
        $auth->addChild($gestor, $createBebida);
        $auth->addChild($gestor, $updateBebida);
        $auth->addChild($gestor, $deleteBebida);
        $auth->addChild($gestor, $viewRP);
        $auth->addChild($gestor, $createRP);
        $auth->addChild($gestor, $updateRP);
        $auth->addChild($gestor, $deleteRP);
        $auth->addChild($gestor, $verDadosEvento);
        $auth->addChild($gestor, $viewGaleria);
        $auth->addChild($gestor, $adicionarGaleria);
        $auth->addChild($gestor, $deleteGaleria);

        $auth->add($admin);
        $auth->addChild($admin, $gestor);
        $auth->addChild($admin, $viewEmpregado);
        $auth->addChild($admin, $createEmpregado);
        $auth->addChild($admin, $updateEmpregado);
        $auth->addChild($admin, $deleteEmpregado);

        $auth->add($rp);
        $auth->addChild($rp, $verdadosEstatisticosCodigo);

        $auth->add($cliente);
        $auth->addChild($cliente, $comprarPulseira);

        $auth->add($seguranca);
        
    //-----------------------------------------------------------------------------//

        $auth->assign($admin, 1);

    }
}