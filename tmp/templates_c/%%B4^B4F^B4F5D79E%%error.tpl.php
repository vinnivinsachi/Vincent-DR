<?php /* Smarty version 2.6.26, created on 2010-11-08 08:14:22
         compiled from error/error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'var_dump', 'error/error.tpl', 23, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Zend Framework Default Application</title>
</head>
<body>
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

</body>
</html>