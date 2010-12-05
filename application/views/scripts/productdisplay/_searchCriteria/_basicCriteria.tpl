 <div class='box' style="width:95%;">
 	<form id='searchCriteriaForm' action='/productdisplay/index' method="get">
 		{if isset($tag)}
 		<input type='hidden' name='tag' value='{$tag}'/>
 		{/if}
 		{if isset($purchaseType)}
 		<input type='hidden' name='purchaseType' value='{$purchaseType}'/>
 		{/if}
    	<div class='titleBarBig marginTop20' style='margin-bottom:0px;'>Search criteria</div>
    	{if $searchCriteria!=''}
    	{include file="productdisplay/_searchCriteria/$searchCriteria"}
    	{/if}
    	<div class='fullTitleBarMid box marginTop20'>Color:</div>
    	
    	<div class='box'>
    		<div class='box' style='width:33%'>
    		<input class='searchInput' type='checkbox' name='color[Black]' value='1' {if $color.Black==1}checked='checked'{/if}/>Black</div>
    		<div class='box' style='width:33%'>
        	<input class='searchInput' type='checkbox' name='color[Brown]' value='1' {if $color.Brown==1}checked='checked'{/if}>Brown</div>
        	<div class='box' style='width:33%'>
        	<input class='searchInput' type='checkbox' name='color[Yellow]' value='1' {if $color.Yellow==1}checked='checked'{/if}>Yellow</div>
        	<div class='box' style='width:33%'>
        	<input class='searchInput' type='checkbox' name='color[Green]' value='1' {if $color.Green==1}checked='checked'{/if}>Green</div>
        	<div class='box' style='width:33%'>
        	<input class='searchInput' type='checkbox' name='color[Pink]' value='1' {if $color.Pink==1}checked='checked'{/if}>Pink</div>
        	<div class='box' style='width:33%'>
        	<input class='searchInput' type='checkbox' name='color[Red]' value='1' {if $color.Red==1}checked='checked'{/if}>Red</div>
        	<div class='box' style='width:40%'>
        	<input class='searchInput' type='checkbox' name='color[Pin_stripe]' value='1' {if $color.Pin_stripe==1}checked='checked'{/if}>Pin stripe</div>
    	</div>
    	<div class='fullTitleBarMid box marginTop20'>Condition:</div>
    	<div class='box'>
    		<div class='box' style='width:25%'>
    		<input type='checkbox' name='condition[New]' value=New {if $condition.New=='New'}checked=checked{/if}/>New</div>
    		<div class='box' style='width:41%'><input type='checkbox' name='condition[Like_new]' value='Like new' {if $condition.Like_new=='Like new'}checked=checked{/if}/>Like new</div>
    		<div class='box' style='width:33%'>
    		<input type='checkbox' name='condition[Good]' value='Good' {if $condition.Good=='Good'}checked=checked{/if}/>Good</div>
    	</div>
    	
    	<div class='fullTitleBarMid box marginTop20'>Price:</div>
    	<div class='box'>
			<div class='box' style='width:100%'>
    		<input type='checkbox' name='pricecat[price_category_1]' value=1 {if $pricecat.price_category_1==1}checked="checked"{/if}/>< $100</div>
			<div class='box' style='width:100%'>
    		<input type='checkbox' name='pricecat[price_category_2]' value=1 {if $pricecat.price_category_2==1}checked="checked"{/if}/>$100 - $200</div>
    		<div class='box' style='width:100%'>
    		<input type='checkbox' name='pricecat[price_category_3]' value=1 {if $pricecat.price_category_3==1}checked="checked"{/if}/>$200 - $500</div>
  			<div class='box' style='width:100%'>
    		<input type='checkbox' name='pricecat[price_category_4]' value=1 {if $pricecat.price_category_4==1}checked="checked"{/if}/>$500 - $1000</div>
    		<div class='box' style='width:100%'>
    		<input type='checkbox' name='pricecat[price_category_5]' value=1 {if $pricecat.price_category_5==1}checked="checked"{/if}/>$1000-$5000</div>
		</div>
		<button>Submit</button>
	</form>
 </div>
 

 {literal}
 <script type="text/javascript"><!--
 	var formElements = $('searchCriteriaForm').getElementsByTagName('input');
 	//alert('here');
 	var nodes = $A(formElements);
 	var timer = 0;
 	nodes.each(function(node){
			node.observe('change', function(){addTime(2000);});
 	 	}
 	);


	function addTime(sum){
		if(timer==0){
			timer+=sum;
			setTimeout("submitSearchCriteria('searchCriteriaForm')", timer);
		 	//submitSearchCriteria('searchCriteriaForm');
		}
	}
 	//submitSearchCriteria('searchCriteriaForm')

 	function submitSearchCriteria(formID){
 		var form = $(formID);

 		/*var options={
 				parameters: form.serialize(true),
 				method: form.method,
 				onLoaded: showloadingImage(), 
 				onSuccess: function(transport){
 							hideloadingImage();
 							timer=0;
 							
 				}
 			};*/

 		//alert('here');
 		showloadingImage();
 		form.submit();
 		//new Ajax.Request(form.action, options);
 	}

 --></script>
 {/literal}