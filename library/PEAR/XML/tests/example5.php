<?php
require_once 'XML/FastCreate.php';
require_once 'XML/FastCreate/tags/XHTML_1_0_STRICT.php';
error_reporting(E_ALL);

// Create XML
$x =& XML_FastCreate::factory('Text',
    array(
        // Add the DocType for XHTML 1.0 Strict
        'doctype'   => XML_FASTCREATE_DOCTYPE_XHTML_1_0_STRICT,
    )
);

$x->html(

    $x->head(

        $x->title('Example 5 - XML_FastCreate'),

       $x->style(array('type'=>'text/css', 'media'=>'all'),
           $x->cdata("@import url('example.css');")
       )
    ),

    $x->body(
	
		$x->div(
				
			$x->h1("XML_FastCreate - Example 5"),
            
            $x->h3("Use the same syntax without overloading"),

			$x->p(
				$x->a(array('href'=>$_SERVER['PHP_SELF'].'s'), 
					"PHP source file")
			),

			$x->p(
				$x->a(array('href'=>'./'), "Others examples")
			),
			
                
            $x->p(array('class'=>'require'),
                "With Zend Optimizer, the overload system will crash !"),
                
            $x->p("But you can disable overloading and keep the same syntax."),
            $x->p(" You must define the list of tags before include() into "
                ."\$GLOBAALS['XML_FASTCREATE_NO_OVERLOAD']  :"),
                
            $x->p(array('class'=>'code'), 
                $x->noquote(nl2br(
                    "\$GLOBAALS['XML_FASTCREATE_NO_OVERLOAD'] = array(  
                        'html', 'head', 'title', 'body', 'style', 'div',  
                        'h1', 'h3', 'p', 'a', 'br', 'hr', 'img', 'pre'
                    );  
                    require_once 'XML/FastCreate/Text.php';  
                    \$x = new XML_FastCreate_Text();"))
            ),

            $x->p("If you use translation tags, add them to the list."),

            $x->p("If a tag is a PHP reserved word, prefix it by underscore in"
                ." the tags list and when you call it."),

            $x->p("Tags lists exists for HTML 4.01 and XHTML 1.0, you can "
                ." include the list like this :"),
                
            $x->p(array('class'=>'code'), 
                $x->noquote(nl2br(
                    "require_once 'XML/FastCreate/tags/XHTML_1_0_STRICT.php';  
                    require_once 'XML/FastCreate/Text.php';  
                    \$x = new XML_FastCreate_Text();"))
            )
        )
    )
);

$x->toXML();

?>
