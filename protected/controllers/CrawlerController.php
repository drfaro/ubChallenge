<?php

class CrawlerController extends Controller
{
	/**
	 * Declares class-based actions.
	 */

	private $host;
	private $cont;
	private $CONST_PATTERN = '(ufpr.br)';


	public function __construct(){
		
	}

	

	private function checkAndSaveEmail($listResultEmails){

			$arrayEmails = [];
			$arrayEmailsCriteria = [];

			//echo "Ajustando a lista de emails ".count($listResultEmails)."\n";
			foreach ($listResultEmails as $key => $arrayArrayEmail) {
				foreach ($arrayArrayEmail as $key2 => $arrayEmail) {
					if (is_array($arrayEmail)){
						$strEmail = implode("",$arrayEmail);	
					}else{
						$strEmail = $arrayEmail;
					}
					$check = array_search($strEmail, $arrayEmails);
					if ($check === false && $check == false){
						$arrayEmails[$key] = $strEmail;
						$arrayEmailsCriteria[$key] = array( 'email' => $strEmail);	
					}
				}

			}

			//check
			$Criteria = new CDbCriteria();
			$Criteria->addInCondition('email',$arrayEmails);
			$checkEmails = emails::model()->findAll($Criteria);

			if (count($checkEmails)){
				foreach ($checkEmails as $key => $objEmail) {
					echo "email ja adicionado -> ".$objEmail->email."\n";
					$key = array_search($objEmail->email, $arrayEmails);
					unset($arrayEmails[$key]);
					unset($arrayEmailsCriteria[$key]);
				}
			}
			
			if (count($arrayEmailsCriteria)){
				$this->saveList('emails',$arrayEmailsCriteria);
			}

			

	}

	
	private function checkAndSaveUrls($listResultUrls){

			$arrayUrls = [];
			$arrayUrlsCriteria = [];
			$pattern = '(pdf|odt|css|js|mp3|ico|file|jpg|png|xls|xlsx)';
			//echo "Ajustando a lista de Url ".count($listResultUrls)." \n";

			foreach ($listResultUrls as $key => $arrayArrayUrl) {
				foreach ($arrayArrayUrl as $key2 => $arrayUrl) {

					if (is_array($arrayUrl)){
						$strUrl = strtolower(implode("",$arrayUrl));
					}else{
						$strUrl = strtolower($arrayUrl);
					}
					
					preg_match($pattern,$strUrl , $matchesFile, PREG_OFFSET_CAPTURE);
					
					if (count($matchesFile) == 0 ){
						if (strpos($strUrl,"http") === false ){
							$strUrl = $this->host."".$strUrl;
						}
						//valida ultima barra 
						if (substr($strUrl, -1) != "/"){
							$checkPoint = substr($strUrl,(strripos($strUrl,"/") + 1), -1 );
							$checkPoint = strripos($checkPoint,".");
							if ($checkPoint === false && $checkPoint == false){
								$strUrl .= "/";
							}
						}
						
						preg_match($this->CONST_PATTERN,$strUrl , $matches, PREG_OFFSET_CAPTURE);
 	
 						if (count($matches) != 0){
	 						$check = array_search($strUrl, $arrayUrls);
							if ($check === false && $check == false){
								echo "Adicionando na fila ->".$strUrl."  \n";
								$arrayUrls[$key] = $strUrl;
								$arrayUrlsCriteria[$key] = array('url' => $strUrl,'visited' => 'no');
							}	
 						}else{
							echo "Url nao pertence ao host - ".$this->host."  url - ".$strUrl."\n";

 						}	
					}
				}
			}

			$Criteria = new CDbCriteria();
			$Criteria->addInCondition('url',$arrayUrls);
			$checkUrls = urls::model()->findAll($Criteria);
			
			if (count($checkUrls)){
				foreach ($checkUrls as $key => $objUrl) {
					echo "Url ja adicionada -> ".$objUrl->url."\n";
					$key = array_search($objUrl->url, $arrayUrls);
					unset($arrayUrls[$key]);
					unset($arrayUrlsCriteria[$key]);
				}
			}
			
			if (count($arrayUrls)){
				$this->saveList('urls',$arrayUrlsCriteria);
			}

	}


	private function openUrl($pObjUrl){

			$arrayLink = [];
			$arrayEmails = [];

			$objUrl=urls::model()->findbyPk($pObjUrl->id);
			$objUrl->visited='yes';
			$objUrl->save();
			
			try {
				$myfile = @fopen($pObjUrl->url,"r");
				if (!$myfile) {
					throw new Exception();
				}
				//Salvando a url 'pai'
				$this->host = $this->verifyPath($pObjUrl->url);

				preg_match($this->CONST_PATTERN,$this->host,$matches, PREG_OFFSET_CAPTURE);
				if (count($matches) == 0){
					throw new Exception("Url nao pertence ao host ".$pattern." - ".$this->host);
				}
				
				while(!feof($myfile)) {
					$str = fgets($myfile);
				
					preg_match_all('/href\=\"([a-zA-Z_\.0-9\/\-\! :\@\$]*)"/i', $str, $resultLink);
					
					if (count($resultLink[1]) != 0){
						array_push($arrayLink,$resultLink[1]);
					}else if (count($resultLink[0]) != 0){
						array_push($arrayLink,$resultLink[0]);
					}

					preg_match_all('/\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i', $str, $resulEmail);

					if (count($resulEmail[0]) != 0){
						array_push($arrayEmails,$resulEmail[0]);
					}
				  	
				}

				if (count($arrayLink)){
					$this->checkAndSaveUrls($arrayLink);
				}
				
				if (count($arrayEmails)){
					$this->checkAndSaveEmail($arrayEmails);
				}

			} catch (Exception $e) {
			    echo "\nErro ao acessar -> ".$pObjUrl->url." ".$e->getMessage();
			}

			
			$this->actionIndex();
			


	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.*/
	 
	public function actionIndex()
	{
		
		$dataProvider=new CActiveDataProvider('urls', array(
		    'criteria'=>array(
		        'order'=>'id ASC',
		        'condition'=>'visited="no"'
		    ),
		));
		$arrayWebsite = $dataProvider->getData();
		
		if (count($arrayWebsite)){
			foreach ($arrayWebsite as $dataObj){
				$this->openUrl($dataObj) ;
			}
		}else{
			echo '\n ************ \n finalizou \n ************ \n';
		}

		Yii::app()->end(); 
	}


	
	private function verifyPath($strUrl){
		if (substr($strUrl, -1) != "/"){
			return substr($strUrl,0,(strripos($strUrl,"/") +1));
		}else{
			return $strUrl;
		}

	}

	private function saveList($table,$arraylist){
		$builder = Yii::app()->db->schema->commandBuilder;
		$command=$builder->createMultipleInsertCommand($table, $arraylist);
		$command->execute();
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				echo $error['message'];
				//$this->render('error', $error);
		}
	}

	
}