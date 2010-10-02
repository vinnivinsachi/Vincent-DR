<?php /* Smarty version 2.6.19, created on 2010-08-29 16:42:19
         compiled from account/messages.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/header.tpl", 'smarty_include_vars' => array('lightbox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="leftContainer" style="width:20%; float:left;">	
	
<ul id="qm0" class="qmmc" style="width:100%;">
    <li><a class="qmparent" href="javascript:void(0)">Messages( )</a>
    	<ul>
        	<li><a>Inbox( )</a></li>
            <li><a>Sent </a></li>
        </ul>
    </li>
</ul>
    
 <!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top)--> 
<?php echo '
<script type="text/javascript">qm_create(0,true,0,500,\'all\',false,false,false,false);</script>
'; ?>

</div>
<div id="rightContainer" style="width:80%; float:right;">
     <?php if ($this->_tpl_vars['user']->generalInfo->user_type == 'generalSeller' || $this->_tpl_vars['user']->generalInfo->user_type == 'storeSeller'): ?> 
            <div class='titleBarBig'>My public shout box messages</div>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/account/publicShoutBoxMessages.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
     <?php endif; ?>
    <div class='titleBarBig'>My private messages</div>
        <div id="messageboxNavigation" class='box'>
        <a class="productTagHeaderButton currentSelection" id="anchorInboxSelection">Inbox</a>
            <a class="productTagHeaderButton" id="anchorOutboxSelection">Outbox</a>
<!--<a class="productTagHeaderButton" id="anchorComposeSelection">Compose</a>-->        
	</div>
       
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'partials/account/privateMessages.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<?php echo '
<script type="text/javascript">

new toggleClass(\'accountInboxMessage\', \'privateMessageForm\', \'accountDetailShoutOutFromRespond\', \'PrivateMessage\');

new individualToggle(\'anchorInboxSelection\', \'accountInboxMessage\', \'currentSelection\', Array(\'accountOutboxMessage\'), Array(\'anchorOutboxSelection\'));

new individualToggle(\'anchorOutboxSelection\', \'accountOutboxMessage\', \'currentSelection\', Array(\'accountInboxMessage\'), Array(\'anchorInboxSelection\'));

//new orderToggle(\'.anchorOrderMessageSeller\', \'.anchorTrackingStatus\',\'.anchorReturnTrackingStatus\',\'.anchorReturnItem\',\'.anchorTrackingForm\', \'.anchorOrderCancelled\',\'.anchorProductReview\', \'currentSelection\');

																										
</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layouts/".($this->_tpl_vars['layout'])."/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>