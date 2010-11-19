<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Zend Framework Default Application</title>
</head>
<body>
  <h1>An error occurred</h1>
  <h2>{$this->message}</h2>

  {if isset($this->exception)}

  <h3>Exception information:</h3>
  <p>
      <b>Message:</b> {$this->exception->getMessage()}
  </p>

  <h3>Stack trace:</h3>
  <pre>{$this->exception->getTraceAsString()}
  </pre>

  <h3>Request Parameters:</h3>
  <pre>{$this->request->getParams()|var_dump}
  </pre>
  {/if}

</body>
</html>
