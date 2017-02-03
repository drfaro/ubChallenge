<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php

Yii::app()->clientScript->registerScript('cron', "
$(document).ready(function(){

	var listActive = [];
	var count = 0;

	function appendLinst(data){
		count += 1;
		$.each( data, function( key, emailObj ) {
			$( '#list-emails thead:last' ).after( '<tbody class=response_'+count+'><tr><td>'+emailObj.id+'</td><td>'+emailObj.email+'</td></tr></tbody>' );
		});
	  	
	}

	function cron(){
		$.get( '?r=emails/last', function( data ) {
			if (data !=  null) {

				var init = false;
				if (listActive.length == 0){
					init = true;
					listActive = data;
				}
				
				if (listActive[0].email != data[0].email || init == true){
					$('#list-emails tbody.response_'+count).remove();
					listActive = data 
					appendLinst(data);
				}
			}
			
		});
	}

	setInterval(function(){
		cron();
	},1000)
	
});
");
?>

<table style="width:100%" id="list-emails">
	<thead>
		<tr>
			<th>id</th>
			<th>Email</th> 
		</tr>
	</thead>

</table>