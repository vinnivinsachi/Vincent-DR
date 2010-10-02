<?php
require_once 'XML/FastCreate.php';
error_reporting(E_ALL);

// Create XML with the XML_Tree Driver
$x =& XML_FastCreate::factory('XML_Tree',

    array(

        // Add the doctype of XHTML 1.0 Strict
        'doctype'    => XML_FASTCREATE_DOCTYPE_XHTML_1_0_STRICT,
        
        // Export XML to a file (default : /tmp/XML_FastCreate.xml)
        'file'		=> XML_FASTCREATE_FILE,

        // Check validity with an external program (default: xmllint)
        'exec'      => XML_FASTCREATE_EXEC,

		// Make indentation
		'indent'	=> true,
    )
);



$x->html(

    $x->head(
        $x->title('Example 3 - XML_FastCreate')
    ),
    
	$x->body(

        $x->div(
        
            $x->h1("XML_FastCreate - Example 3"),
            
            $x->h3("Driver : ".$x->_driver),
            
            $x->h3("Control XML with an external DTD validator"),
            
            $x->h3("Make output indentation"),

            $x->p(
                $x->a(array('href'=>$_SERVER['PHP_SELF'].'s'), 
					"PHP source file")
            ),
            
            $x->p(
                $x->a(array('href'=>'./'), "Others examples")
            )
        ),
		
        $x->div(

            // This attributes doesn't exist in the DTD
            $x->span(array('hello'=>'world'),
                "Examples of errors DTD validation"
            ),
            
            // This tag doesn't exist in the DTD
            $x->foo()
        ),
            
        $x->div(

			// Footer
			$x->hr(),
			$x->a(array('href'=>'http://pear.php.net'),
				$x->img(array('src'=>'http://pear.php.net/gifs/pear-power.png',
							'alt'=>'PEAR Logo'))
			)
        )
	)
);

$err = $x->toXML();

// Print DTD errors 
if (PEAR::isError($err)) {
    echo nl2br(htmlSpecialChars($err->getMessage()));
}

?>
