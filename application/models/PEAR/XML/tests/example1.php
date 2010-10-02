<?php
require_once 'XML/FastCreate.php';
error_reporting(E_ALL);

// Create XML without DTD control (no dependencies)
$x =& XML_FastCreate::factory('Text',
    array(
        // Use the XHTML 1.0 Strict Doctype
        'doctype'   => XML_FASTCREATE_DOCTYPE_XHTML_1_0_STRICT,
    )
);  

$x->html(

    $x->head(
        $x->title('Example 1 - XML_FastCreate'),
        
        $x->style(array('type'=>'text/css', 'media'=>'all'),
            $x->cdata("@import url('example.css');")
        )
    ),

    $x->body(

$x->div(
        
    $x->h1("XML_FastCreate - Example 1"),

    $x->h3("Driver : ".$x->_driver),
	
    $x->h3("Package overview"),

    $x->comment("Example of 'comment()'",
        $x->span("Hello")
    ),

    $x->p(
        $x->a(array('href'=>$_SERVER['PHP_SELF'].'s'), "PHP source file")
    ),

    $x->p(
        $x->a(array('href'=>'./'), "Others examples")
    ),
    
    // Each elements are seperated by comma
    $x->ul(
    
        $x->li(
            $x->h3("Fast creation of valid XML contents :"),
            
            $x->h4("Simply use the method of the tag name :"),
            $x->p(array('class'=>'code'), 
				'$x->span("hi")'),
			$x->p(array('class'=>'html'),
				'= <span>hi</span>'),
            
            $x->h4("This is an 'overload' mapping of xml() method :"),
            $x->p(array('class'=>'code'),
				'$x->xml("span", "hi")'),
            // You can directly use the xml() method like this :
            $x->xml('p', array('class'=>'html'),
				'= <span>hi</span>'),

            $x->h4("You can add attributes on the 1st parameter :"),
            $x->p(array('class'=>'code'),
				'$x->span(array(\'class\'=>\'test\'), "hi")'),
            $x->p(array('class'=>'html'),
                '= <span class="test">hi<span>'),
            
            $x->h4("You can add tags inside your tag :"),
            $x->p(array('class'=>'code'),
                '$x->span("XML", ',
                $x->br(), $x->noquote('&nbsp;&nbsp;'), 
                '$x->i("Fast"),',
                $x->br(), $x->noquote('&nbsp;&nbsp;'), 
                '$x->b("Create")',
                $x->br(),
                ')'),
            $x->p(array('class'=>'html'),
                '= <span>XML<i>Fast</i><b>Create</b></span>'),
            
            $x->h4('Make empty tag or alone tag :'),
            $x->p(array('class'=>'code'),
				'$x->span(\'\')'),
			$x->p(array('class'=>'html'),
				'= <span></span>'),
            $x->p(array('class'=>'code'),
            	'$x->br()'),
			$x->p(array('class'=>'html'),
				'= <br />'),
            
            $x->h4("You can make multiples parts and gather them later :"),
            $x->p(array('class'=>'code'),
				'$body = $x->div( $x->p("hello") );',
				$x->br(),
            	'$x->body($body);'),

            $x->h4('List of methods :'),
            $x->p($x->span(array('class'=>'code'), 
					'$x->quote("a > b")'),
				' To convert HTML special tags (if quote option is false)'),
            $x->p($x->span(array('class'=>'code'), 
					'$x->noquote("&nbsp;")'),
				' To not convert HTML special tags (if quote option is true)'),
            $x->p($x->span(array('class'=>'code'), 
					'$x->comment( $x->p("hello") )'),
				' To make XML comments'),
            $x->p($x->span(array('class'=>'code'), 
                    '$x->cdata("alert(\"Let\'s Go !\");")'),
				' To make CDATA section'),
            $x->p($x->span(array('class'=>'code'), 
					'$x->getXML()'),
				' To get the XML output'),
            $x->p($x->span(array('class'=>'code'), 
					'$x->isValid()'),
				' To control your XML with the DTD'),
            $x->p($x->span(array('class'=>'code'), 
					'$x->toXML()'),
				' To write and control XML'),
            $x->p($x->span(array('class'=>'code'), 
					'$x->importXML()'),
				' To convert XML text to XML driver format'),
            $x->p($x->span(array('class'=>'code'), 
					'$x->exportXML()'),
				' To convert XML driver format to XML text')
        ),

        $x->li(
            $x->h3("XML conform to the DTD option"),

            $x->h4("Choose your DTD tool :"),
            $x->p("Use the internal tool",
				$x->span(array('class'=>'require'),
				"( Require XML_DTD package )")),
            $x->p("Or define an external program (like xmllint)")
        ),

        $x->li(
            $x->h3("Independant output data"),

            $x->h4("Choose the output driver to use :"),
            $x->p("Text : return strings"),
            $x->p("XML_Tree : return XML_Tree objects",
				$x->span(array('class'=>'require'),
                	"( Require XML_Tree package )")),
            $x->p("Or make your own ! :-)")
        ),

        $x->li(
            $x->h3("XML Translation option"),
            
            $x->h4("You can define tags to translate :"),
            $x->p(array('class'=>'code'),
                '$x->news(', 
                $x->br(), $x->noquote('&nbsp;&nbsp;'), 
                '$x->title("Title"),',
                $x->br(), $x->noquote('&nbsp;&nbsp;'), 
                '$x->desc("Description")',
                $x->br(),
                ')'
            ),
            $x->p('Replaced by :'),
            $x->p(array('class'=>'html'),
                '<div class="news">', 
                $x->br(), $x->noquote('&nbsp;&nbsp;'), 
				'<h1><span>Title</span></h1>', 
                $x->br(), $x->noquote('&nbsp;&nbsp;'), 
                '<p>Description</p>', 
                $x->br(),
                '</div>'
            ),
            
            $x->h4("Translate declaration is very easy :"),
            $x->p(array('class'=>'code'),
                "'translate' => array(", 
                $x->br(), $x->noquote('&nbsp;&nbsp;'), 
				"'news' => array('<div class=\"news\">', '</div>'),",
                $x->br(), $x->noquote('&nbsp;&nbsp;'), 
                "'title' => array('<h1><span>', '</span></h1>'),",
                $x->br(), $x->noquote('&nbsp;&nbsp;'), 
                "'desc' => array('<p>', '</p>'),",
                $x->br(), ')'
            ),
            $x->p("You can also use shortcuts :"),
            $x->p(array('class'=>'code'),
                "'news' => array('<div class=\"news\">', '</div>')",
                $x->br(),
				"shortcut : ",
                "'news' => array()"),
            $x->p(array('class'=>'code'),
                "'desc' => array('<p>', '</p>')",
                $x->br(),
				"shortcut : ",
                "'desc' => array('p')"
            ),
            
            $x->h4("Prefix tag by '_' to ignore translation :"),
            $x->p(array('class'=>'code'),
                '$x->title("Title")'),
            $x->p(array('class'=>'html'),
                '= <h1><span>Title</span></h1>'),
            $x->p(array('class'=>'code'),
                '$x->_title("Title")'),
            $x->p(array('class'=>'html'),
                '= <title>Title</title>'
            )
        ),
        
		$x->li(
            $x->h3("Others options"),

            $x->h4("Auto-quote attributes and contents"),
            $x->p("Attributes and contents are automatically quoted, but you "
                .'can set option \'quote\' to false and use $x->quote()'),


            $x->h4("Indentation option"),
			$x->p("Set the 'indent' option to true to make XML indentation",
				$x->span(array('class'=>'require'),
					'( Require XML_Beautifier package )')
			),
			
			$x->h4("Write your XML output into a file"),
			$x->p("Set the the destination file in the 'file' option"),
 
			$x->h4("Driver output options"),
			$x->p("Each driver has these basic options :"),
			$x->p("'version' To set the xml version (default = '1.0')"),
			$x->p("'encoding' To set the xml encoding (default = 'UTF-8')"),
			$x->p("'standalone' To set the xml standalone (default = 'no')"),
			$x->p("'doctype' To set the doctype (doctype constants exists)"),
			$x->p("'quote' To quote attributes and contents (default = true)"),
            
            $x->h4("With Zend Optimizer, the overload system will crash !"),
            $x->p("But you can replace overloading by a tags list",
                $x->a(array('href'=>'example5.php'), "(see Example 5)")
            )
		),

        $x->li(
            $x->h3("Convert your HTML easily to FastCreate syntax !"),

            $x->h4("The script can convert HTML file to FastCreate syntax"),
            $x->p("Give the name of the HTML file and the output file"),

            $x->h4("Or just convert your HTML selection under your editor"),
            $x->p("Select the HTML text, call the macro and your selected"
                ." text will be rewrited to FastCreate syntax !")
        )
    ),

    // Footer
    $x->hr(),
	$x->a(array('href'=>'http://pear.php.net'),
	    $x->img(array('src'=>'http://pear.php.net/gifs/pear-power.png',
                    'alt'=>'PEAR Logo'))
	)
 )
	
	)
);

$x->toXML();

?>
