{include file="layouts/$layout/header.tpl"}

<div id='content-wide'>
	
	<fieldset>
    	<legend>Basic Info</legend>

    	<!-- DETAILS FORM -->
    		{include file='account/forms/basicInfoForm.tpl'}
        
        <!-- CHANGE YOUR PASSWORD -->
	        <fieldset>
	        	<legend>Change Your Password</legend>
	        	{include file='account/forms/changePasswordForm.tpl'}
	        </fieldset>
        
    </fieldset>

</div>


{include file="layouts/$layout/footer.tpl"}
