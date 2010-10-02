<?php
require_once 'XML/FastCreate.php';
error_reporting(E_ALL);

// You can also use the factory() method to make this object
$x =& XML_FastCreate::factory('Text',
    array(
        // Use the XHTML 1.0 Strict Doctype
        'doctype'    => XML_FASTCREATE_DOCTYPE_XHTML_1_0_STRICT,
        
        // Add DTD control with the XHTML 1.0 Strict DTD file
        'dtd'       => '../dtd/xhtml_1_0_strict.dtd',
    )
);

$x->html(

    $x->head(
        $x->title('Example 2 - XML_FastCreate'),

        $x->style(array('type'=>'text/css', 'media'=>'all'),
			$x->cdata("@import url('example.css');")
        )
    ),
    
	$x->body(

        $x->div(
        
            $x->h1("XML_FastCreate - Example 2"),
            
            $x->h3("Driver : ".$x->_driver),
            
            $x->h3("Control XML with a DTD file"),
            
            $x->p(
                $x->a(array('href'=>$_SERVER['PHP_SELF'].'s'), 
					"PHP source file")
            ),
            
            $x->p(
                $x->a(array('href'=>'./'), "Others examples")
            )
        ),
		
        $x->div(

            // This attribute doesn't exist in the <span> tag 
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
    echo "<div id='dtd_errors'>"
        .nl2br(htmlSpecialChars($err->getMessage()))
        ."</div>";
}

?>
