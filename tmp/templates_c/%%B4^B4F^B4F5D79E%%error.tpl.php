<?php /* Smarty version 2.6.26, created on 2010-11-19 08:09:47
         compiled from error/error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'var_dump', 'error/error.tpl', 19, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'layouts/error/header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


  <h1>An error occurred</h1>
  <h2><?php echo $this->_tpl_vars['this']->message; ?>
</h2>

  <?php if (isset ( $this->_tpl_vars['this']->exception )): ?>

  <h3>Exception information:</h3>
  <p>
      <b>Message:</b> <?php echo $this->_tpl_vars['this']->exception->getMessage(); ?>

  </p>

  <h3>Stack trace:</h3>
  <pre><?php echo $this->_tpl_vars['this']->exception->getTraceAsString(); ?>

  </pre>

  <h3>Request Parameters:</h3>
  <pre><?php echo ((is_array($_tmp=$this->_tpl_vars['this']->request->getParams())) ? $this->_run_mod_handler('var_dump', true, $_tmp) : var_dump($_tmp)); ?>

  </pre>
  <?php endif; ?>
  

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'layouts/error/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>