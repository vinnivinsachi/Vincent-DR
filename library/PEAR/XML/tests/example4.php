<?php
require_once 'XML/FastCreate.php';
error_reporting(E_ALL);

// Create XML with DTD control
$x =& XML_FastCreate::factory('Text',
    array(
        // Add the DocType for XHTML 1.0 Strict
        'doctype'   => XML_FASTCREATE_DOCTYPE_XHTML_1_0_STRICT,

		// Translation option
        'translate' => array(
        
            'news'  => array(),
            'desc'  => array('p'),
            'title' => array('<h1 class="title"><span>', '</span></h1>'),
            'date'  => array('<span class="date">', '</span>'),
        )
        
    )
);

$x->html(

    $x->head(

		// Bypass the translation for this title tag :
        $x->_title('Example 4 - XML_FastCreate'),

       $x->style(array('type'=>'text/css', 'media'=>'all'),
           $x->cdata("@import url('example.css');")
       )
    ),

    $x->body(
	
		$x->div(
				
			$x->h1("XML_FastCreate - Example 4"),
            
            $x->h3("Make XML Translations"),

			$x->p(
				$x->a(array('href'=>$_SERVER['PHP_SELF'].'s'), 
					"PHP source file")
			),

			$x->p(
				$x->a(array('href'=>'./'), "Others examples")
			),
			
			// Example of XML to translate :
			$x->news(
				$x->title('PHP 4.3.6 released!'),
				$x->date('[15-Apr-2004]'),
				$x->desc('The PHP Development Team is proud to announce the '
                    .'release of ',
                    $x->a(array('href'=>'http://www.php.net/downloads.php'),
                        'PHP 4.3.6'),
                    '. This is is a bug fix release whose primary goal is '
                    .'to address two bugs which may result in crashes in '
                    .'PHP builds with thread-safety enabled. All users of '
                    .'PHP in a threaded environment (Windows) are strongly '
                    .'encouraged to upgrade to this release.',
                    $x->br(), 
                    $x->br(),
                    'All in all this release fixes approximately 25 bugs '
                    .'that have been discovered since the 4.3.5 release. '
                    .'For a full list of changes in PHP 4.3.6, see the ',
                    $x->a(array(
                        'href'=>'http://www.php.net/ChangeLog-4.php#4.3.6'),
                        'ChangeLog.'
                    )
                )
			),

			$x->news(
				$x->title('Second PHP Marathon announced'),
				$x->date('[06-Apr-2004]'),
				$x->desc('DotGeek.org is proud to announce the',
                    $x->a(array('href'=>'http://marathon.dotgeek.org/'), 
                        'second PHP Programming Marathon'),
                    ' to be held on the 24 April 2004. Instead of receiving '
                    .'the problems and composing your solutions offline, it '
                    .'all takes place online and within a specific timeframe. '
                    .'The Marathon is kindly sponsored by Zend Technologies '
                    .'and will now feature a problem on PHP 5. Participation '
                    .'is free of charge.'
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
