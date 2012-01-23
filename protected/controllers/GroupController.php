<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupController
 *
 * @author sigurd
 */
class GroupController extends Controller {

	public function actionIndex() {

		$data = array();

		// Henter kommiteer
		$query = "SELECT g.id, g.title, menu.title AS menuTitle FROM groups AS g
                  LEFT JOIN 
                  (SELECT s.title, mg.group 
                  FROM menu_group AS mg 
                  LEFT JOIN site AS s ON s.siteId = mg.site 
                  WHERE mg.sort = (SELECT MIN(sort) FROM menu_group as mg)) AS menu
                  ON menu.group = g.id
                  WHERE committee = 'true'";

		$command = $this->pdo->prepare($query);
		$command->execute();

		$data['committee'] = $command->fetchAll(PDO::FETCH_ASSOC);

		// Henter grupper
		$query = "SELECT g.id, g.title, menu.title AS menuTitle FROM groups AS g
                  LEFT JOIN 
                  (SELECT s.title, mg.group 
                  FROM menu_group AS mg 
                  LEFT JOIN site AS s ON s.siteId = mg.site 
                  WHERE mg.sort = (SELECT MIN(sort) FROM menu_group as mg)) AS menu
                  ON menu.group = g.id
                  WHERE committee = 'false'" ;

        
		$command = $this->pdo->prepare($query);
		$command->execute();

       
		$data['groups'] = $command->fetchAll(PDO::FETCH_ASSOC);

		$this->render("index", $data);
	}

    public function actionView($id, $title) {

        $data = array();
        $group = new Group($id);
        $data['id'] = $id;
        $data['model'] = $group;
        $data['title'] = $group->getTitle();
        $data['menu'] = $group->getMenu();

        $content = $group->getGroupContentType($title);

        if($content=="article"){
           $data['content'] = $group->getArticle($title);
        }

        if($content == "members"){
            $data['content'] = $group->getMembers();
            $data['date'] = date('Y');

            //Henter ut alle tidligere medlemmer av gruppen siden 2003
            //Bør gjøres ved hjelp av feed med en egen stil
            $former = array();
            $i = 0;
            for( $year = date('Y'); $year > 2003; $year--){
                for( $s = 1; $s <= 2; $s++ ) { 
                    if(sizeof($group->getFormerMembers($year,$s))>0){
                        $former[$i++] = $group->getFormerMembers($year,$s);
                    }
                }
            }

            $data['former'] = $former;
            print_r($former);
        }

        if($content == "news"){
            $data['id'] = $group->id;
        }



        $this->render("view/" . $content, $data);
    }

    public function actions() {
            return array(
                                            //'view' => 'application.controllers.group.ViewAction',
            );
    }
    
    public function actionEdit($id){
        $group = new Group($id);
        $data['title'] = $group->getTitle();
        $data['groups'] = $group->getAdminMenu();
        $data['members'] = $group->getMembers();
        $data['menu'] = $group->getMenu();
        $this->render("edit",$data);
        
    }
}
