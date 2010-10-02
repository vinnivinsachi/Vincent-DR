<?php
 /**
  * XML_FastCreate : Simple Example 
  *
  * This is the little example describe in the documentation
  *
  */
 require_once 'XML/FastCreate.php';

 $x =& XML_FastCreate::factory('Text');

 $x->html(
    $x->head(
         $x->title("A simple XHTML page")
    ),
    $x->body(
        $x->div(
            $x->h1('Example'),
            $x->br(),
            $x->a(array('href' => 'http://pear.php.net'), 'PEAR WebSite')
        )
    )
 );

 // Write output
 $x->toXML();
?>
