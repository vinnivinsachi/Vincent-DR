{include file='layouts/error/header.tpl'}


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
  

{include file='layouts/error/footer.tpl'}
