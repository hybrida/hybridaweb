<?php
class ProfileController extends Controller{
    
    
    public function actionIndex(){
        $this->actionView(Yii::app()->user->id);
    }
    
    public function actionView($id){
        
            /*$sub = ( isset($_GET['sub']) ? $_GET['sub'] : "0");
            $id = ( isset($_GET['id']) ? $_GET['id'] : $selfId );		//Id vil være brukerid til profilen vi ønsker å vise
        */
            //$rbc->setUserImage($id);

        if(Yii::app()->user->isGuest){
            $this->render('view/guest');
        }
        else 
        {
            //Edit link:
            /*if($id == $selfId){
                echo "<div id='edit'><a href='?site=edit&type=".$site."'>endre</a></div>";
            }*/

            //$profile = Profile::model()->findByPk($id);
            $profile = new Profile();
            $data['info'] = $profile->info($id);
            $data['id'] = $id;
            //$data['sub'] = $sub;

            if(!isset($sub) || $sub == 0) {
                $this->render('index',$data);

            } else if( $sub == 1 ) {
                $this->render('view/comment',$data);				//Viser kommentarfelt og feed


            } else if ( $sub == 2 ) {

                //Annet
            }
        }  
    }
}

?>
