/* This javascript goes with the likeThis plugin written by Rosemarie Pritchard.
http://lifeasrose.ca
*/

var $j = jQuery.noConflict();

function likeScript(){ 

	function reloadLikes(who) {
		var text = $j("#" + who).text();
		var patt= /(\d)+/;
		
		var num = patt.exec(text);
		num[0]++;
		text = text.replace(patt,num[0]);
		$j("#" + who).text(text);
	} //reloadLikes


	$j(".likeThis").click(function() {
		var classes = $j(this).attr("class");
		classes = classes.split(" ");
		
		if(classes[1] == "done") {
			return false;
		}
		var classes = $j(this).addClass("done");
		var id = $j('.likes-amount',this).attr("id");
		id = id.split("like-");
		$j.ajax({
		  type: "POST",
		  url: forte_home+'/index.php',
		  data: "likepost=" + id[1],
		  success: reloadLikes("like-" + id[1])
		}); 
		
		
		return false;
	});

}

$j(document).ready(function(){ 
	likeScript();
    $j('body').ajaxSuccess(function() {
		likeScript();
    });
});
