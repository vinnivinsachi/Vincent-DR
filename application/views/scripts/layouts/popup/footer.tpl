
<!-- set up all rollover images -->
		<script type='text/javascript' src='{$jsDir}/jquery/rolloverImages.jquery.js'></script>

<!-- set up links that show the loading image -->
<script type='text/javascript' src='{$jsDir}/jquery/loadingImageLinks.jquery.js'></script>

<!-- make anchor tags target _top -->
	{include file='helpers/linksTargetTop.tpl'}

</page>

</body>

<!-- INLINE JAVASCRIPTS FOR AJAX CALLS -->
	{$this->inlineScript()}

</html>
