<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
/**
 * A Gtk GUI frontend for the PEAR_PackageFileManager class.
 *
 * A PHP-GTK 1 frontend for the PEAR_PackageFileManager class.
 * It makes it easier for developers to create and maintain
 * PEAR package.xml files.
 *
 * Features:
 * - Update existing package files or create new ones
 * - Import values from an existing package file
 * - Drag-n-Drop package directory into the application for easy
 *   loading (requires PEAR::Gtk_FileDrop)
 * - Set package level information (package name, description, etc.)
 * - Set release level information (version, release notes, etc.)
 * - Easily add maintainers
 * - Browse package files as a tree and click to add a dependency
 * - Add install time global and file replacements
 * - Package file preview window
 * - Package the package using the new package file
 *
 * Example:
 * More detail can be found in 
 * doc/PEAR_PackageFileManager_GUI_Gtk/example.php
 * 
 * <code>
 * if (!extension_loaded('gtk')) {
 *     dl( 'php_gtk.' . PHP_SHLIB_SUFFIX);
 * }
 *
 * require_once 'PEAR/PackageFileManager/GUI/Gtk.php';
 * $pfmGtk =& new PEAR_PackageFileManager_GUI_Gtk();
 * $pfmGtk->show();
 * gtk::main();
 * </code>
 *
 * @todo Allow other (non-package) dependencies (Maybe)
 *
 * @category   PEAR
 * @package    PEAR_PackageFileManager_GUI_Gtk
 * @author     Scott Mattocks
 * @copyright  &copy; (c) Copyright 2005 Scott Mattocks
 * @license    PHP 3.0
 * @version    API: 1.0.1 CVS: $Id: Gtk.php,v 1.2 2005/04/13 13:41:56 scottmattocks Exp $
 * @link       http://pear.php.net/package/PEAR_PackageFileManager_GUI_Gtk
 */
class PEAR_PackageFileManager_GUI_Gtk {

    /**
     * PEAR_PackageFileManager instance.
     * @var    object
     * @access private
     */
    var $_packageFileManager;
    /**
     * PEAR_PackageFileManager options array
     * @var    array
     * @access private
     */
    var $_options = array();
    /**
     * The main gtk window.
     * @var object
     */
    var $widget;
    /**
     * The GtkNotebook used to display the different tasks.
     * @var object
     */
    var $notebook;
    /**
     * The GtkText that will display the warnings.
     * @var object
     */
    var $warningsArea;
    /**
     * The GtkWindow that will hold the preview information.
     * @var object
     */
    var $previewWindow;
    /**
     * Keep track of whether or not the file has been previewed
     * in its current state.
     * @var boolean
     */
    var $previewed = false;
    /**
     * Keep track of whether or not the file has been saved in
     * its current state.
     * @var boolean
     */
    var $saved = false;

    /**
     * Constructor.
     * 
     * Creates the package file manager and then calls the 
     * method to create the rest of the application.
     *
     * @param  boolean $isMain Whether or not this class is the
     *                         main application for this Gtk loop
     * @return void
     * @access public
     */
    function PEAR_PackageFileManager_GUI_Gtk($isMain = true)
    {
        // Instantiate the package file manager.
        require_once 'PEAR/PackageFileManager.php';
        $this->_packageFileManager =& new PEAR_PackageFileManager();

        // Create the application.
        $this->_createApplication($isMain);
    }
    
    /**
     * Shows all widgets.
     *
     * Please note: The regular issues associated with show_all()
     * still apply. show_all() does not always trickle all of the
     * way down to the very last child widget. For more info please
     * see the PHP-GTK website {@link http://gtk.php.net}
     * 
     * @return void
     * @access public
     */
    function show()
    {
        $this->widget->show_all();
    }

    /**
     * Returns the main application window.
     *
     * This is a standard PEAR-PHP-GTK method. It has
     * been added for consistency. It would be useful if 
     * the PEAR_Frontend_Gtk class had a "New Package"
     * feature. The PEAR_Frontend_Gtk code could just 
     * instantiate this class and call getWidget(). It 
     * could then show the window when ever it wanted or
     * make some changes to the window itself. It could
     * even pull the child from the window and embed the
     * rest of this application in itself.
     * 
     * @return &object
     * @access public
     */
    function &getWidget()
    {
        return $this->widget();
    }

    /**
     * Creates and shows an about window.
     *
     * The about window contains the package name, current 
     * package version number, the list of developers and where
     * to find the latest information for the package.
     *
     * It would be nice if this window also told the user what
     * version of PEAR_PackageFileManager was being used but I
     * don't know that that information is necessarily part of
     * this package. 
     *
     * @return void
     * @access public
     */
    function about()
    {
        // Create the window.
        $aboutWin =& new GtkWindow();
        $aboutWin->set_title('PEAR_PackageFileManager');

        // Add a pretty frame.
        $aboutFrame =& new GtkFrame('About');
        $aboutWin->add($aboutFrame);
        
        // Add the data in an organized manner.
        // The best way is probably with a GtkTable.
        $table =& new GtkTable();
        $table->set_col_spacings(3);

        // Create an array of row labels.
        $labels = array('Package', 
                        'Version', 
                        'Maintainers',
                        'Summary',
                        'Additional Info'
                        );
        
        // Attach each child in the first column.
        foreach ($labels as $row => $label) {
            $label =& new GtkLabel($label . ':');
            $label->set_alignment(0, 0);
            $table->attach($label, 0, 1, $row, $row + 1);
        }

        // Create an array of values.
        $values = array('PEAR_PackageFileManager_GUI_Gtk',
                        '1.0.1',
                        'Scott Mattocks',
                        'A PHP-GTK frontend for the PEAR_PackageFileManager class.',
                        'http://pear.php.net/'
                        );
        
        // Add the values in the second column.
        foreach ($values as $row => $value) {
            $label =& new GtkLabel($value);
            $label->set_alignment(0, 0);
            $table->attach($label, 1, 2, $row, $row + 1);
        }

        // Add a close button.
        $closeBox    =& new GtkHBox();
        $closeButton =& new GtkButton('Close');
        $closeButton->connect_object('clicked', array(&$aboutWin, 'destroy'));

        $closeBox->pack_end($closeButton, false, false, 3);
        $table->attach($closeBox, 0, 2, count($labels), count($labels) + 1);

        // Add the table and show everything.
        $aboutFrame->add($table);
        $aboutWin->show_all();
    }

    /**
     * Shows the warnings in the text area.
     * 
     * Each warning will be displayed on its own line.
     * 
     * @param  string $message Optional message to add to the warnings.
     * @return void
     * @access public
     */
    function showWarnings($message = NULL)
    {
        if (!empty($message)) {
            $this->warningsArea->insert_text($message . "\n",
                                             $this->warningsArea->get_length());
        }

        foreach ($this->_packageFileManager->getWarnings() as $warning) {
            $this->warningsArea->insert_text($warning['message'] . "\n----\n",
                                             $this->warningsArea->get_length());
        }
    }

    /**
     * Checks to see if the file has been saved before destroying the
     * main window.
     * 
     * The user should save their file before the application closes.
     * If they have not, they will be prompted to save or close any
     * way.
     *
     * This method will also kill the main gtk loop if told to. If 
     * this class is imbedded in another class, you probably don't
     * want to do that. Pass false to the constructor to prevent 
     * this from happening.
     *
     * @param  boolean $killMainLoop
     * @return void
     * @access public
     */
    function checkBeforeQuit($killMainLoop)
    {
        // Check to see if the file was saved.
        if (!$this->saved) {
            // Prompt the user with a GtkDialog window.
            $dialog =& new GtkDialog();
            
            $vBox = $dialog->vbox;
            $vBox->pack_start(new GtkLabel('Your package file has not been saved.' . 
                                           ' Would you like to save it now?'));
            
            $dialog->show_all();
            gtk::main();
        }

        // Kill the main loop if requested.
        if ($killMainLoop) {
            return gtk::main_quit();
        } else {
            return true;
        }
    }

    /**
     * Creates the main PHP-GTK application.
     *
     * @param  boolean $isMain Whether or not this class is the
     *                         main application for this Gtk loop
     * @return void
     * @access private
     */
    function _createApplication($isMain)
    {
        // Build the main window
        $this->widget =& new GtkWindow();
        $this->widget->set_title('PackageFileManager');
        //$this->widget->connect_object('destroy', array(&$this, 'checkBeforeQuit'), $isMain);
        $this->widget->connect_object('destroy', array('gtk', 'main_quit'));
        
        // The main container for the window.
        $vBox =& new GtkVBox();
        $this->widget->add($vBox);
        
        // Add the menu.
        $vBox->pack_start($this->_buildMenu(), false, true, 3);

        // Add the notebook.
        $vBox->pack_start($this->_buildNotebook());
    }

    /**
     * Builds the application's menu.
     *
     * The menu is used for such things as the open and save
     * dialogs. The menu should also have an about option and
     * an exit option.
     * 
     * @return object  A container holding the menu.
     * @access private
     */
    function &_buildMenu()
    {
        // Create the menu bar.
        $menuBar =& new GtkMenuBar();
        $accel   =& new GtkAccelGroup();
        $this->widget->add_accel_group($accel);

        // Create the main (only) menu item.
        $fileHeader =& new GtkMenuItem('File');
        $helpHeader =& new GtkMenuItem('Help');

        // Add the menu item to the menu bar.
        $menuBar->append($fileHeader);
        $menuBar->append($helpHeader);

        // Create the file menu
        $fileMenu =& new GtkMenu();
        $helpMenu =& new GtkMenu();

        // Add the menu items
        // Allow users to preview the package file (debugPackageFile)
        $preview      =& new GtkMenuItem('');
        $previewLabel =  $preview->child;
        $previewKey   =  $previewLabel->parse_uline('_Preview');
        $preview->add_accelerator('activate', $accel, $previewKey,
                                  GDK_CONTROL_MASK, GTK_ACCEL_VISIBLE);
        $preview->lock_accelerators();
        $preview->connect_object('activate', array(&$this, '_previewFile'));
        $fileMenu->append($preview);
        
        // Allow users to save the package file (writePackageFile)
        $save      =& new GtkMenuItem('');
        $saveLabel =  $save->child;
        $saveKey   =  $saveLabel->parse_uline('_Save');
        $save->add_accelerator('activate', $accel, $saveKey,
                               GDK_CONTROL_MASK, GTK_ACCEL_VISIBLE);
        $save->lock_accelerators();
        $save->connect_object('activate', array(&$this, '_writePackageFile'));
        $fileMenu->append($save);

        // Allow users to package the package.
        $package      =& new GtkMenuItem('');
        $packageLabel =  $package->child;
        $packageKey   =  $packageLabel->parse_uline('P_ackage');
        $package->add_accelerator('activate', $accel, $packageKey,
                                  GDK_CONTROL_MASK, GTK_ACCEL_VISIBLE);
        $package->lock_accelerators();
        $package->connect_object('activate', array(&$this, '_packagePackage'));
        $fileMenu->append($package);

        // Allow users to exit.
        $exit =& new GtkMenuItem('Exit');
        $exit->connect_object('activate', array('gtk', 'main_quit'));
        $fileMenu->append($exit);

        $about =& new GtkMenuItem('About...');
        $about->connect('activate', array(&$this, 'about'));
        $helpMenu->append($about);        
        
        // Complete the menu.
        $fileHeader->set_submenu($fileMenu);
        $helpHeader->set_submenu($helpMenu);

        return $menuBar;
    }

    /**
     * Builds the main display widget.
     *
     * To make the user interface more navigable, a GtkNotebook
     * is used. This lets the user appear to be working through
     * a wizard when they are actually just changing pages.
     *
     * @return &object
     * @access private
     */
    function &_buildNotebook()
    {
        // Create the notebook.
        $this->notebook =& new GtkNotebook();
        $this->notebook->set_scrollable(true);
        $this->notebook->popup_enable();

        // Add the package info page.
        $this->_addNotebookPage($this->_createPackagePage());

        // Add the release info page.
        $this->_addNotebookPage($this->_createReleasePage());

        // Add the addMaintainer page.
        // This can't happen until the options are set!
        //$this->_addNotebookPage($this->_createAddMaintainerPage());

        // Add the addDependencies page.
        // This can't happen until the options are set!
        //$this->_addNotebookPage($this->_createAddDependenciesPage());

        // Add the addReplacements page.
        // This can't happen until the options are set!
        //$this->_addNotebookPage($this->_createAddReplacementsPage());

        // Add the warnings page.
        $this->_addNotebookPage($this->_createWarningsPage());

        // When the page is switched, get any new warnings.
        $this->notebook->connect_object('switch-page', array(&$this, 'showWarnings'));

        // Return the notebook.
        return $this->notebook;
    }

    /**
     * Appends the given container to the notebook.
     *
     * @param  array   $page array(container, label)
     * @param  boolean $last Whether this page should be the last page or not
     * @return integer
     * @access private
     */
    function _addNotebookPage($page, $last = true)
    {
        // Add the container and the tab label.
        if ($last) {
            $this->notebook->append_page($page[0], $page[1]);
        } else {
            // Make this the second to last page.
            $position = count($this->notebook->children()) - 1;
            $this->notebook->insert_page($page[0], $page[1], $position);
            $this->notebook->show_all();
        }
    }

    /**
     * Creates the page for displaying the package file manager
     * options that relate to the entire package, regardless of
     * the release.
     *
     * Package options are those such as: base install directory,
     * the license, the package name, etc.
     *
     * @return array
     * @access private
     */
    function _createPackagePage()
    {
        // Create some containers.
        $mainVBox =& new GtkVBox();

        // Create the hbox for the file selection.
        $packageDirHBox =& new GtkHBox();

        // We need an entries for the file.
        $packageDirEntry  =& new GtkEntry();
        $packageDirButton =& new GtkButton('Select');

        // Allow users to drop files in the entry box if possible.
        @include_once 'Gtk/FileDrop.php';
        if (class_exists('Gtk_FileDrop')) {
            Gtk_FileDrop::attach($packageDirEntry, array('inode/directory'));
        }

        // Create the file selection.
        $packageDirFS =& new GtkFileSelection('Package Directory');
        $packageDirFS->set_position(GTK_WIN_POS_CENTER);

        // Set the default path to the pear directory.
        require_once 'PEAR/Config.php';
        $pearConfig =& new PEAR_Config();
        $packageDirFS->set_filename($pearConfig->get('php_dir'));

        // Make the ok button set the entry value.
        $okButton = $packageDirFS->ok_button;
        $okButton->connect_object('clicked', array(&$this, '_setPackageDirEntry'),
                                  $packageDirEntry, $packageDirFS);

        // Make the cancel button hide the selection.
        $cancelButton = $packageDirFS->cancel_button;
        $cancelButton->connect_object('clicked', array(&$packageDirFS, 'hide'));

        // Make the button show the file selection.
        $packageDirButton->connect_object('clicked', array(&$packageDirFS, 'show'));
        
        // Pack the package file directory pieces.
        $packageDirLabel =& new GtkLabel('Package File Directory');
        $packageDirLabel->set_usize(140, -1);
        $packageDirLabel->set_alignment(0, .5);

        $packageDirHBox->pack_start($packageDirLabel, false, false, 3);
        $packageDirHBox->pack_start($packageDirEntry,  false, false, 3);
        $packageDirHBox->pack_start($packageDirButton, false, false, 3);

        // We need an entry for the package name.
        $packageNameEntry =& new GtkEntry();
        $packageNameBox   =& new GtkHBox();
        $packageNameLabel =& new GtkLabel('Package Name');
        $packageNameLabel->set_usize(140, -1);
        $packageNameLabel->set_alignment(0, .5);
        $packageNameBox->pack_start($packageNameLabel, false, false, 3);
        $packageNameBox->pack_start($packageNameEntry, false, false, 3);

        // We need a simple entry box for the base install directory.
        $baseEntry =& new GtkEntry();
        $baseBox   =& new GtkHBox();
        $baseLabel =& new GtkLabel('Base Install Dir');
        $baseLabel->set_usize(140, -1);
        $baseLabel->set_alignment(0, .5);
        $baseBox->pack_start($baseLabel, false, false, 3);
        $baseBox->pack_start($baseEntry, false, false, 3);

        // We need an entry for the summary.
        $summaryEntry =& new GtkEntry();
        $summaryBox   =& new GtkHBox();
        $summaryLabel =& new GtkLabel('Package Summary');
        $summaryLabel->set_usize(140, -1);
        $summaryLabel->set_alignment(0, .5);
        $summaryBox->pack_start($summaryLabel, false, false, 3);
        $summaryBox->pack_start($summaryEntry, false, false, 3);

        // We need a text area for the description.
        $descriptionText =& new GtkText();
        $descriptionBox   =& new GtkVBox();
        $descriptionLabel =& new GtkLabel('Package Description');

        $descriptionLabel->set_usize(140, -1);
        $descriptionLabel->set_alignment(0, .5);
        $descriptionText->set_editable(true);
        $descriptionText->set_line_wrap(true);
        $descriptionText->set_word_wrap(true);
        $descriptionText->set_usize(-1, 100);

        $descriptionBox->pack_start($descriptionLabel, false, false, 3);
        $descriptionBox->pack_start($descriptionText, true, true, 3);

        // We need a button to do the work.
        $submitButton =& new GtkButton('Submit');
        $submitButton->connect_object('clicked', array(&$this, '_setPackageOptions'),
                                      $packageDirEntry, $packageNameEntry, $baseEntry,
                                      $summaryEntry, $descriptionText);

        $submitBox =& new GtkHBox();
        $submitBox->pack_end($submitButton, false, false, 5);

        // Import the options if there is a package.xml file
        // in the package directory.
        $packageDirEntry->connect('changed', array(&$this, '_importPackageOptions'),
                                  $packageNameEntry, $baseEntry, $summaryEntry,
                                  $descriptionText);

        // Pack everything away.
        $mainVBox->pack_start($packageDirHBox, false, false, 3);
        $mainVBox->pack_start($packageNameBox, false, false, 3);
        $mainVBox->pack_start($baseBox,        false, false, 3);
        $mainVBox->pack_start($summaryBox,     false, false, 3);
        $mainVBox->pack_start($descriptionBox, true,  true,  3);
        $mainVBox->pack_start($submitBox,      false, false, 3);

        return array(&$mainVBox, new GtkLabel('Package'));
    }

    /**
     * Creates the page for displaying the package file 
     * manager release options fields.
     *
     * The release options consist of features including, the 
     * release date, the package version and state, and the
     * release notes. 
     * 
     * Options that do not relate to individual releases are
     * covered on a seperate page. 
     * 
     * @return array
     * @access private
     */
    function _createReleasePage()
    {
        // Create some containers.
        $mainVBox =& new GtkVBox();
        
        // We need a combo list for the version.
        $stateCombo =& new GtkCombo();

        // Set up the combo.
        $stateList  =  $stateCombo->list;
        $stateEntry =  $stateCombo->entry;
        $stateList->set_selection_mode(GTK_SELECTION_SINGLE);
        $stateEntry->set_text('Select One');
        $stateEntry->set_editable(false);

        // Add the states to the select box.
        $states = array('alpha', 'beta', 'stable');
        for ($i = 0; $i < count($states); $i++) {
            $item  =& new GtkListItem();
            $box   =& new GtkHBox();
            $label =& new GtkLabel($states[$i]);
            $box->pack_start($label, false, false, 10);
            $item->add($box);
            $stateCombo->set_item_string($item, $states[$i]);
            $item->set_data('state', $states[$i]);
            $stateList->add($item);
            $item->show_all();
        }

        // Put the state combo in a box.
        $stateBox =& new GtkHBox();
        $stateLabel =& new GtkLabel('State');
        $stateLabel->set_usize(140, -1);
        $stateLabel->set_alignment(0, .5);
        $stateBox->pack_start($stateLabel, false, false, 3);
        $stateBox->pack_start($stateCombo, false, false, 3);

        // We need a simple entry box for the version.
        $verEntry =& new GtkEntry();
        $verBox   =& new GtkHBox();
        $verLabel =& new GtkLabel('Version');
        $verLabel->set_usize(140, -1);
        $verLabel->set_alignment(0, .5);
        $verBox->pack_start($verLabel, false, false, 3);
        $verBox->pack_start($verEntry, false, false, 3);

        // Create a text box for the release notes.
        $notes =& new GtkText();
        $notes->set_word_wrap(false);
        $notes->set_line_wrap(true);
        $notes->set_editable(true);
        
        // Put the notes stuff in a box with a label.
        $notesBox   =& new GtkVBox();
        $notesLabel =& new GtkLabel('Release Notes');
        $notesLabel->set_alignment(0, .5);

        $notesBox->pack_start($notesLabel, false, false, 3);
        $notesBox->pack_start($notes,      false, false, 3);

        // We need a button to do the work.
        $submitButton =& new GtkButton('Submit');
        $submitButton->connect_object('clicked', array(&$this, '_setReleaseOptions'),
                                      $stateCombo, $verEntry, $notes);

        $submitBox =& new GtkHBox();
        $submitBox->pack_end($submitButton, false, false, 5);

        // Pack the containers into the main container.
        $mainVBox->pack_start($stateBox,       false, false, 3);
        $mainVBox->pack_start($verBox,         false, false, 3);
        $mainVBox->pack_start($notesBox,       false, false, 6);
        $mainVBox->pack_start($submitBox,      false, false, 6);

        return array($mainVBox, new GtkLabel('Release'));
    }

    /**
     * Creates a page for displaying (and clearing) warnings.
     *
     * The warnings page consists of a text area and a button.
     * The text area should be set to wrap text but not be 
     * editable. The button should clear the text area of any
     * warnings.
     *
     * @return array
     * @access private
     */
    function _createWarningsPage()
    {
        // Pack everything in a vBox.
        $vBox =& new GtkVBox();
        $sWin =& new GtkScrolledWindow();
        $sWin->set_policy(GTK_POLICY_AUTOMATIC, GTK_POLICY_AUTOMATIC);

        // Set up the warnings area.
        $this->warningsArea =& new GtkText();
        $this->warningsArea->set_editable(false);
        $this->warningsArea->set_word_wrap(true);
        $sWin->add($this->warningsArea);

        // Add a button to clear the warnings area.
        $hBox   =& new GtkHBox();
        $button =& new GtkButton('Clear');
        $button->connect_object('clicked', array(&$this->warningsArea, 'delete_text'), 0, -1);
        $hBox->pack_end($button, false, false, 5);
        
        // Pack everything in.
        $vBox->pack_start($sWin, true, true, 10);
        $vBox->pack_start($hBox, false, true);

        return array($vBox, new GtkLabel('Warnings'));
    }

    /**
     * Creates a page for gathering information about developers.
     *
     * The add maintainer page needs to get the developer's name,
     * handle, email address and role. The role should be a 
     * GtkCombo which doesn't allow the user to enter anything
     * that is not a valid role.
     *
     * @return array
     * @access private
     */
    function _createAddMaintainersPage()
    {
        // To lay things out, use a combination of h and v boxes.
        $mainVBox  =& new GtkVBox();
        $mainHBox  =& new GtkHBox();
        $leftVBox  =& new GtkVBox();
        $rightVBox =& new GtkVBox();
        $subHBox   =& new GtkHBox();

        // We need to display the current maintainers in a cList
        $currentList =& new GtkCList(3, array('Developer', 'Email', 'Role'));

        // Make the first two columns auto resize and sort
        // the list.
        $currentList->set_column_auto_resize(0, true);
        $currentList->set_column_auto_resize(1, true);
        $currentList->set_auto_sort(true);

        // Add the current maintainers to the list.
        $this->_listDevelopers($currentList);
        
        // We need three entries and three labels.
        $handleEntry =& new GtkEntry();
        $handleLabel =& new GtkLabel('Handle');
        $nameEntry   =& new GtkEntry();
        $nameLabel   =& new GtkLabel('Name');
        $emailEntry  =& new GtkEntry();
        $emailLabel  =& new GtkLabel('Email');
        
        // We also need a combo for the developer role.
        $roleLabel =& new GtkLabel('Role');
        $roleCombo =& new GtkCombo();

        // Set up the combo.
        $roleList  =  $roleCombo->list;
        $roleEntry =  $roleCombo->entry;
        $roleList->set_selection_mode(GTK_SELECTION_SINGLE);
        $roleEntry->set_text('Select One');
        $roleEntry->set_editable(false);

        // Add the roles to the select box.
        $roles = array('Contributor', 'Developer', 'Helper', 'Lead');
        for ($i = 0; $i < count($roles); $i++) {
            $item  =& new GtkListItem();
            $box   =& new GtkHBox();
            $label =& new GtkLabel($roles[$i]);
            $box->pack_start($label, false, false, 10);
            $item->add($box);
            $roleCombo->set_item_string($item, $roles[$i]);
            $item->set_data('role', $roles[$i]);
            $roleList->add($item);
            $item->show_all();
        }

        // We need a button to do the work.
        $button =& new GtkButton('Add Maintainer');
        $button->connect_object('clicked', array(&$this, '_addMaintainer'),
                                $handleEntry, $roleCombo, $nameEntry,
                                $emailEntry, $currentList);

        // Put it all together.
        // All of the labels should be aligned.
        $handleLabel->set_alignment(1, .5);
        $nameLabel->set_alignment(1, .5);
        $emailLabel->set_alignment(1, .5);
        $roleLabel->set_alignment(1, .5);

        // The left VBox is for the labels.
        $leftVBox->pack_start($handleLabel, false, true, 3);
        $leftVBox->pack_start($nameLabel,   false, true, 3);
        $leftVBox->pack_start($emailLabel,  false, true, 3);
        $leftVBox->pack_start($roleLabel,   false, true, 3);
        
        // The right VBox is for the entries and the combo.
        $rightVBox->pack_start($handleEntry, false, false, 0);
        $rightVBox->pack_start($nameEntry,   false, false, 0);
        $rightVBox->pack_start($emailEntry,  false, false, 0);
        $rightVBox->pack_start($roleCombo,   false, false, 0);

        // The two VBoxes go in the main HBox.
        $mainHBox->pack_start($leftVBox,  true, true, 2);
        $mainHBox->pack_start($rightVBox, true, true, 20);
        
        // The subHBox holds the button.
        $subHBox->pack_end($button, false, false, 20);

        // The label and the two HBoxes go in the main VBox.
        $mainVBox->pack_start($mainHBox,    false, false, 10);
        $mainVBox->pack_start($subHBox,     false, false, 2);
        $mainVBox->pack_start($currentList, false, false, 2);
        
        // Return the page information.
        return array(&$mainVBox, new GtkLabel('Maintainers'));
    }

    /**
     * Add the widgets that make up the dependencies page.
     *
     * The dependencies page consists of one widget to 
     * display installed packages, one widget to display
     * packages selected as dependencies, a button to clear
     * the selected list and a button to add the dependencies.
     *
     * @return array
     * @access private
     */
    function _createAddDependenciesPage()
    {
        // An HBox holds everything.
        $mainVBox =& new GtkVBox();
        
        // Two VBoxes hold the tree and list.
        $topVBox    =& new GtkVBox();
        $bottomVBox =& new GtkVBox();
        $buttonHBox =& new GtkHBox();

        // We need a label to make to tell people to click
        // the package make it optional.
        $instructions =& new GtkLabel('Click a package to make it an optional dependency.');

        // Put the tree in a scrolling window.
        $treeScrolledWindow =& new GtkScrolledWindow();
        $treeScrolledWindow->set_policy(GTK_POLICY_NEVER, GTK_POLICY_AUTOMATIC);
        $listScrolledWindow =& new GtkScrolledWindow();
        $listScrolledWindow->set_policy(GTK_POLICY_AUTOMATIC, GTK_POLICY_AUTOMATIC);
        $treeScrolledWindow->set_usize(200, 150);
        $listScrolledWindow->set_usize(200, 150);

        // Create the tree.
        $cTree =& new GtkCTree(1, 0);
        $cTree->set_line_style(GTK_CTREE_LINES_SOLID);
        $root  =& $cTree->insert_node(NULL, NULL, array('Packages'), 0,
                                      NULL, NULL, NULL, NULL, NULL, NULL);

        // Use PEAR_Registry to build the tree.
        require_once 'PEAR/Registry.php';
        $reg = new PEAR_Registry();

        // Loop through the packages and add a node for each
        // package with a child for the version.
        foreach ($reg->packageInfo() as $package) {
            // I don't know why but some return info from PEAR_Registry
            // has no package name. That aint cool!
            if (empty($package['package'])) {
                continue;
            }

            $name    =& $cTree->insert_node($root, NULL, array($package['package']),
                                            0, NULL, NULL, NULL, NULL, NULL, NULL);
            $version =& $cTree->insert_node($name, NULL, array($package['version']),
                                            0, NULL, NULL, NULL, NULL, NULL, NULL);

            // Set some data so that we can tell what the user
            // selected later.
            $cTree->node_set_row_data($version, array($package['package'],
                                                      $package['version'],
                                                      ''));
            
            // Add the older versions if there are any.
            if (count($package['changelog'])) {
                foreach($package['changelog'] as $change) {
                    if ($change['version'] != $package['version']) {
                        $oldVersion =& $cTree->insert_node($name, NULL,
                                                           array($change['version']),
                                                           0, NULL, NULL, NULL,
                                                           NULL, NULL, NULL);
                        $cTree->node_set_row_data($oldVersion, 
                                                  array($package['package'],
                                                        $change['version'],
                                                        ''));
                    }
                }
            }
        }
        
        // Organize the list.
        $cTree->sort();

        // Create a GtkCList to show the added dependencies.
        $cList =& new GtkCList(3, array('Package', 'Version', 'Optional'));

        // Make the first column automatically adjust to
        // the needed width.
        $cList->set_column_auto_resize(0, true);
        
        // Automatically sort the entries.
        $cList->set_auto_sort(true);

        // When the user selects a package we want to toggle
        // its optional status.
        $cList->connect('select-row', array(&$this, '_toggleOptional'));

        // Connect the tree-select-row so that the user
        // can add information.
        $cTree->connect('tree-select-row', array(&$this, '_treeToCList'), $cList);

        // Show dependencies from import in cList.
        $this->_getDependencies($cList);

        // Add some buttons to make things a little easier to
        // work with.
        $clearButton =& new GtkButton('Clear');
        $addButton   =& new GtkButton('Add Dependencies');

        // We also want an auto detect button.
        $autoButton  =& new GtkButton('Auto Detect');

        // The clear but should clear out the cList.
        // Clearing dependencies already in a package file
        // is not possible.
        $clearButton->connect_object('clicked', array(&$cList, 'clear'));
        $clearButton->connect_object('clicked',
                                     array(&$this->_packageFileManager, 'setOptions'),
                                     $this->_options + array('deps' => array()));

        // The auto detect button should be connected to the PFM
        // detectDependencies method.
        $autoButton->connect_object('clicked',
                                    array(&$this->_packageFileManager, 'detectDependencies'));

        // We need to let the user know that it did something.
        $autoButton->connect_object_after('clicked',
                                          array(&$this, '_getDependencies'),
                                          $cList);

        // The add button should add the dependencies from the cList
        // to the package. 
        $addButton->connect_object('clicked',
                                   array(&$this, '_addDependencies'),
                                   $cList);

        // Pack everything away.
        $treeScrolledWindow->add($cTree);
        $topVBox->pack_start($treeScrolledWindow);

        $listScrolledWindow->add($cList);
        $bottomVBox->pack_start($listScrolledWindow);

        $buttonHBox->pack_start($clearButton, false, false, 3);
        $buttonHBox->pack_start($autoButton, false, false, 3);
        $buttonHBox->pack_end($addButton, false, false, 3);

        $mainVBox->pack_start($topVBox);
        $mainVBox->pack_start($bottomVBox);
        $mainVBox->pack_start($instructions);
        $mainVBox->pack_start($buttonHBox);

        return array(&$mainVBox, new GtkLabel('Depenedencies'));
    }

    /**
     * Creates the container and label for the add replacements
     * page. 
     *
     * Replacements are install time search and replace strings
     * that can be used to set certain package variables to 
     * values found on the user's system or that are specific
     * to the version of the installed package. 
     *
     * This package uses a replacement to put the proper version
     * number in the about window so that I don't have to go and
     * recode that every time.
     *
     * @return array   The page container and a label for the tab.
     * @access private
     */
    function _createAddReplacementsPage()
    {
        // Create the main box.
        $mainVBox    =& new GtkVBox();

        // And the sub boxes
        $globalVBox  =& new GtkVBox();
        $globalHBox0 =& new GtkHBox();
        $globalHBox1 =& new GtkHBox();
        $globalHBox2 =& new GtkHBox();
        $globalHBox3 =& new GtkHBox();

        $fileVBox    =& new GtkVBOX();
        $fileHBox0   =& new GtkHBox();
        $fileHBox1   =& new GtkHBox();
        $fileHBox2   =& new GtkHBox();
        $fileHBox3   =& new GtkHBox();
        $fileHBox4   =& new GtkHBox();

        // Create two success/failure labels.
        $globalSuccess =& new GtkLabel('');
        $fileSuccess   =& new GtkLabel('');

        // There are two types of replacements: Global and file.
        // First we will set up the global replacements.
        // We can do this with a few combo boxes. We will use 
        // one for the type and one for the to value. The to 
        // values are basically predefined sets that won't 
        // change much. I am not concerned about hard coding 
        // these values into the application. 
        
        // We need to work kind of backwards and create the many
        // to widgets first. Then we can create the type combo.
        $globalToPHP     =& new GtkEntry();
        $globalToPEAR    =& new GtkCombo();
        $globalToPackage =& new GtkCombo();
        $globalToWidgets = array('php-const'    => &$globalToPHP,
                                 'pear-config'  => &$globalToPEAR,
                                 'package-info' => &$globalToPackage
                                 );

        // We need a box for the to widgets so that we can swap
        // them out.
        $globalToWidgetBox =& new GtkHBox();

        // The PHP widget is easy. It is just an entry because
        // there are way to many constants to list.
        
        // The PEAR widget on the other hand has a shorter list
        // of valid values. We will get them using PEAR_Config.
        $globalToPEARList  = $globalToPEAR->list;
        $globalToPEAREntry = $globalToPEAR->entry;
        $globalToPEARList->set_selection_mode(GTK_SELECTION_SINGLE);
        $globalToPEAREntry->set_text('Select One');
        $globalToPEAREntry->set_editable(false);

        // Add the valid values to the list.
        require_once 'PEAR/Config.php';
        $pearConfig =& new PEAR_Config();
        foreach ($pearConfig->getKeys() as $pearConfigKey) {
            $item  =& new GtkListItem();
            $box   =& new GtkHBox();
            $label =& new GtkLabel($pearConfigKey);
            $box->pack_start($label, false, false, 10);
            $item->add($box);
            $globalToPEAR->set_item_string($item, $pearConfigKey);
            $item->set_data('type', $pearConfigKey);
            $globalToPEARList->add($item);
            $item->show_all();
        }

        // The package-info widget is a little different. I can't 
        // find a method to get the legal values for this set of
        // replacements. Therefore, I have to hard code the array.
        // It will also serve as the array for the file replacements.
        $globalToPackageList  = $globalToPackage->list;
        $globalToPackageEntry = $globalToPackage->entry;
        $globalToPackageList->set_selection_mode(GTK_SELECTION_SINGLE);
        $globalToPackageEntry->set_text('Select One');
        $globalToPackageEntry->set_editable(false);

        $packageOptions = array('name', 'summary', 'description', 'version',
                                'license', 'state', 'notes', 'date');
        foreach ($packageOptions as $option) {
            $item  =& new GtkListItem();
            $box   =& new GtkHBox();
            $label =& new GtkLabel($option);
            $box->pack_start($label, false, false, 10);
            $item->add($box);
            $globalToPackage->set_item_string($item, $option);
            $item->set_data('type', $option);
            $globalToPackageList->add($item);
            $item->show_all();
        }


        // The globalType combo will not change.
        $globalTypeCombo =& new GtkCombo();

        // Set up the combo.
        $globalTypeList  =  $globalTypeCombo->list;
        $globalTypeEntry =  $globalTypeCombo->entry;
        $globalTypeList->set_selection_mode(GTK_SELECTION_SINGLE);
        $globalTypeEntry->set_text('Select One');
        $globalTypeEntry->set_editable(false);

        // When the entry's value changes, we want to change the
        // to widget.
        $globalTypeEntry->connect('changed',
                                  array(&$this, '_switchToWidget'),
                                  $globalToWidgets, $globalToWidgetBox);

        // Add the globalTypes to the select box.
        $globalTypes = array('php-const', 'pear-config', 'package-info');
        for ($i = 0; $i < count($globalTypes); $i++) {
            $item  =& new GtkListItem();
            $box   =& new GtkHBox();
            $label =& new GtkLabel($globalTypes[$i]);
            $box->pack_start($label, false, false, 10);
            $item->add($box);
            $globalTypeCombo->set_item_string($item, $globalTypes[$i]);
            $item->set_data('type', $globalTypes[$i]);
            $globalTypeList->add($item);
            $item->show_all();
        }

        // The last part of the global puzzle is the from widget.
        // This is just an entry that will hold the value in the
        // package files that should be replaced.
        // Example: 0.11.0
        $globalFromEntry =& new GtkEntry();

        // It also helps to have buttons to do the actual work.
        $globalButtonBox =& new GtkHBox();
        $globalAddButton =& new GtkButton('Add Replacement');
        
        $globalAddButton->connect_object('clicked',
                                         array($this, '_addReplacement'),
                                         NULL, $globalTypeCombo,
                                         $globalToWidgetBox, $globalFromEntry,
                                         $globalSuccess);
        
        $globalButtonBox->pack_end($globalAddButton, false, false, 5);

        // Next we will set up the file specific replacments.
        // For this we will need a way to get all of the files
        // that are to be included in the packaging. If PFM 
        // doesn't have a public method for getting these files
        // then we will not be able to do this. It will be up to
        // the developer to edit the file manually.
        // Until there is a public method, we can use the
        // PEAR_PackageFileManager_File class to get all of the
        // files.
        
        // Start by creating the widgets for each field.
        $fileFileCombo   =& new GtkCombo();
        $fileTypeCombo   =& new GtkCombo();
        $fileFromEntry   =& new GtkEntry();
        $fileToWidgetBox =& new GtkHBox();
        $fileToPHP       =& new GtkEntry();
        $fileToPEAR      =& new GtkCombo();
        $fileToPackage   =& new GtkCombo();
        $fileToWidgets   =  array('php-const'    => &$fileToPHP,
                                  'pear-config'  => &$fileToPEAR,
                                  'package-info' => &$fileToPackage
                                  );

        // Next fill the file combo list.
        $fileFileList  =  $fileFileCombo->list;
        $fileFileEntry =  $fileFileCombo->entry;
        $fileFileList->set_selection_mode(GTK_SELECTION_SINGLE);
        $fileFileEntry->set_text('Select One');
        $fileFileEntry->set_editable(false);
        
        // Create a file list generator.
        // We can't do this until after we have the package options.
        require_once 'PEAR/PackageFileManager/File.php';
        $pfmFile = new PEAR_PackageFileManager_File($this->_packageFileManager, $this->_options);
        foreach ($pfmFile->dirList($this->_options['packagedirectory']) as $file) {
            if (PEAR::isError($file)) {
                $this->_pushWarning($result->getCode(), array());
                break;
            }
            // Shorten file to a relative path from the package directory.
            $shortFile = substr($file, strlen($this->_options['packagedirectory']));

            $item  =& new GtkListItem();
            $box   =& new GtkHBox();
            $label =& new GtkLabel($shortFile);
            $box->pack_start($label, false, false, 10);
            $item->add($box);
            $fileFileCombo->set_item_string($item, $shortFile);
            $item->set_data('type', $file);
            $fileFileList->add($item);
            $item->show_all();
        }

        // The PHP widget is easy. It is just an entry because
        // there are way to many constants to list.
        
        // The PEAR widget on the other hand has a shorter list
        // of valid values. We will get them using PEAR_Config.
        $fileToPEARList  = $fileToPEAR->list;
        $fileToPEAREntry = $fileToPEAR->entry;
        $fileToPEARList->set_selection_mode(GTK_SELECTION_SINGLE);
        $fileToPEAREntry->set_text('Select One');
        $fileToPEAREntry->set_editable(false);

        // Add the valid values to the list.
        foreach ($pearConfig->getKeys() as $pearConfigKey) {
            $item  =& new GtkListItem();
            $box   =& new GtkHBox();
            $label =& new GtkLabel($pearConfigKey);
            $box->pack_start($label, false, false, 10);
            $item->add($box);
            $fileToPEAR->set_item_string($item, $pearConfigKey);
            $item->set_data('type', $pearConfigKey);
            $fileToPEARList->add($item);
            $item->show_all();
        }

        // The package-info widget is a little different. I can't 
        // find a method to get the legal values for this set of
        // replacements. Therefore, I have to hard code the array.
        // It will also serve as the array for the file replacements.
        $fileToPackageList  = $fileToPackage->list;
        $fileToPackageEntry = $fileToPackage->entry;
        $fileToPackageList->set_selection_mode(GTK_SELECTION_SINGLE);
        $fileToPackageEntry->set_text('Select One');
        $fileToPackageEntry->set_editable(false);

        $packageOptions = array('name', 'summary', 'description', 'version',
                                'license', 'state', 'notes', 'date');
        foreach ($packageOptions as $option) {
            $item  =& new GtkListItem();
            $box   =& new GtkHBox();
            $label =& new GtkLabel($option);
            $box->pack_start($label, false, false, 10);
            $item->add($box);
            $fileToPackage->set_item_string($item, $option);
            $item->set_data('type', $option);
            $fileToPackageList->add($item);
            $item->show_all();
        }


        // The fileType combo will not change.
        $fileTypeCombo =& new GtkCombo();

        // Set up the combo.
        $fileTypeList  =  $fileTypeCombo->list;
        $fileTypeEntry =  $fileTypeCombo->entry;
        $fileTypeList->set_selection_mode(GTK_SELECTION_SINGLE);
        $fileTypeEntry->set_text('Select One');
        $fileTypeEntry->set_editable(false);

        // When the entry's value changes, we want to change the
        // to widget.
        $fileTypeEntry->connect('changed', array(&$this, '_switchToWidget'),
                                $fileToWidgets, $fileToWidgetBox);

        // Add the fileTypes to the select box.
        $fileTypes = array('php-const', 'pear-config', 'package-info');
        for ($i = 0; $i < count($fileTypes); $i++) {
            $item  =& new GtkListItem();
            $box   =& new GtkHBox();
            $label =& new GtkLabel($fileTypes[$i]);
            $box->pack_start($label, false, false, 10);
            $item->add($box);
            $fileTypeCombo->set_item_string($item, $fileTypes[$i]);
            $item->set_data('type', $fileTypes[$i]);
            $fileTypeList->add($item);
            $item->show_all();
        }

        // The last part of the file puzzle is the from widget.
        // This is just an entry that will hold the value in the
        // package files that should be replaced.
        // Example: 0.11.0
        $fileFromEntry =& new GtkEntry();

        // It also helps to have buttons to do the actual work.
        $fileButtonBox =& new GtkHBox();
        $fileAddButton =& new GtkButton('Add Replacement');
        
        $fileAddButton->connect_object('clicked', array($this, '_addReplacement'),
                                       $fileFileCombo, $fileTypeCombo, $fileToWidgetBox,
                                       $fileFromEntry, $fileSuccess);
        
        $fileButtonBox->pack_end($fileAddButton, false, false, 5);

        // Pack every thing up.
        $globalHBox0->pack_start($globalSuccess, true ,true, 5);
        $globalHBox1->pack_start(new GtkLabel('Type:'), false ,false, 5);
        $globalHBox1->pack_end($globalTypeCombo, false ,false, 5);
        $globalHBox2->pack_start(new GtkLabel('From: (ex: @php_bin@)'), false ,false, 5);
        $globalHBox2->pack_end($globalFromEntry, false ,false, 5);
        $globalHBox3->pack_start(new GtkLabel('To:'), false ,false, 5);
        $globalHBox3->pack_end($globalToWidgetBox, false ,false, 5);

        // The global to widget box starts off the php-const entry.
        $globalToWidgetBox->pack_start($globalToPHP, false, false, 0);
        
        // Put the hBoxes in the vBox.
        $globalVBox->pack_start($globalHBox0,     false, false, 5);
        $globalVBox->pack_start($globalHBox1,     false, false, 5);
        $globalVBox->pack_start($globalHBox2,     false, false, 5);
        $globalVBox->pack_start($globalHBox3,     false, false, 5);
        $globalVBox->pack_start($globalButtonBox, false, false, 5);

        // Pack up the file pieces.
        $fileHBox0->pack_start($fileSuccess, true ,true, 5);
        $fileHBox1->pack_start(new GtkLabel('File:'), false ,false, 5);
        $fileHBox1->pack_end($fileFileCombo, false ,false, 5);
        $fileHBox2->pack_start(new GtkLabel('Type:'), false ,false, 5);
        $fileHBox2->pack_end($fileTypeCombo, false ,false, 5);
        $fileHBox3->pack_start(new GtkLabel('From: (ex: @php_bin@)'), false ,false, 5);
        $fileHBox3->pack_end($fileFromEntry, false ,false, 5);
        $fileHBox4->pack_start(new GtkLabel('To:'), false ,false, 5);
        $fileHBox4->pack_end($fileToWidgetBox, false ,false, 5);

        // The file to widget box starts off the php-const entry.
        $fileToWidgetBox->pack_start($fileToPHP, false, false, 0);
        
        // Put the hBoxes in the vBox.
        $fileVBox->pack_start($fileHBox0,     false, false, 5);
        $fileVBox->pack_start($fileHBox1,     false, false, 5);
        $fileVBox->pack_start($fileHBox2,     false, false, 5);
        $fileVBox->pack_start($fileHBox3,     false, false, 5);
        $fileVBox->pack_start($fileHBox4,     false, false, 5);
        $fileVBox->pack_start($fileButtonBox, false, false, 5);

        // Create a pretty frame for the global and file pieces.
        $globalFrame =& new GtkFrame('Global Replacements');
        $fileFrame   =& new GtkFrame('File Replacements');
        
        $globalFrame->set_shadow_type(GTK_SHADOW_OUT);
        $fileFrame->set_shadow_type(GTK_SHADOW_OUT);

        // Add the global and file boxes to the frames.
        $globalFrame->add($globalVBox);
        $fileFrame->add($fileVBox);

        // Put the global and file frames in the main box.
        $mainVBox->pack_start($globalFrame, false, false, 5);
        $mainVBox->pack_start($fileFrame, false, false, 5);

        return array(&$mainVBox, new GtkLabel('Replacements'));
    }

    /**
     * Updates the package file directory entry with the value
     * from the file selection.
     *
     * Takes the value of the file selection and assigns it to
     * the entry widget. We have to use a helper method because
     * we need the value in real time. After the value is set,
     * the file selection is hidden.
     *
     * @param  object &$entry         The GtkEntry that should get the value.
     * @param  object &$fileSelection The GtkFileSelection holding the value.
     * @return void
     * @access private
     */
    function _setPackageDirEntry(&$entry, &$fileSelection)
    {
        $entry->set_text($fileSelection->get_filename());
        $fileSelection->hide();
    }

    /**
     * Sets that relate to the entire package, regardless of
     * the release.
     *
     * Package options are those such as: base install directory,
     * the license, the package name, etc. We can't set the options
     * until we have the rest from the release page. Therefore we
     * must temporarily store them in the _options member.
     *
     * If all goes well, the user will be taken to the next page.
     *
     * @param  object  $dirEntry    The GtkEntry holding the package directory.
     * @param  object  $nameEntry   The GtkEntry holding the package name.
     * @param  object  $baseInstall The GtkEntry holding the base install directory.
     * @return void
     * @access private
     * @see    _setReleaseOptions()
     */
    function _setPackageOptions($dirEntry, $nameEntry, $baseInstall,
                                $summaryEntry, $descriptionText)
    {
        // Create an array to hold the information.
        $options = array();
        
        // Check to see of a package directory was given.
        if ($dirEntry->get_text()) {
            $options['packagedirectory'] = $dirEntry->get_text();
        }

        // Check to see if a package name was given.
        if ($nameEntry->get_text()) {
            $options['package'] = $nameEntry->get_text();
        }

        // Check to see fi a baseinstall directory was given.
        if ($baseInstall->get_text()) {
            $options['baseinstalldir'] = $baseInstall->get_text();
        }

        // Check to see if a package summary was given.
        if ($summaryEntry->get_text()) {
            $options['summary'] = $summaryEntry->get_text();
        }

        // Check to see if a package description was given.
        if ($descriptionText->get_chars(0, -1)) {
            $options['description'] = $descriptionText->get_chars(0, -1);
        }
        
        // Add to the options array. After we get the release 
        // options, these options array will be passed to the
        // package file manager.
        $this->_options += $options;
        $this->notebook->next_page();
    }

    /**
     * Sets the package file anager release options.
     *
     * The release options consist of features including, the 
     * release date, the package version and state, and the
     * release notes. 
     * 
     * Options that do not relate to individual releases are
     * adde with {@link _setPackageOptions}.
     * 
     * This method sets all the options including the package
     * options. If there are errors, the user will be taken to
     * the warnings page. If there are no errors the user will
     * be taken to the add maintainers page.
     *
     * @param  object  $state     The GtkCombo holding the state.
     * @param  object  $verEntry  The GtkEntry holding the version.
     * @param  object  $notesArea The GtkText holding the release notes.
     * @return void
     * @access private
     * @see    _setPackageOptions()
     */
    function _setReleaseOptions($state, $verEntry, $notesArea)
    {
        $options = array();

        $stateItem = $state->list->selection[0];        
        if (isset($stateItem)) {
            $options['state'] = $stateItem->get_data('state');
        }
        
        if ($verEntry->get_text()) {
            $options['version'] = $verEntry->get_text();
        }

        if ($notesArea->get_chars(0, -1)) {
            $options['notes'] = $notesArea->get_chars(0, -1);
        }
        
        // Add to the options array. When the file is saved,
        // the options array will be passed to the package
        // file manager.
        $this->_options += $options;

        // Set the options so that other things can be done.
        $result = $this->_packageFileManager->setOptions($this->_options);

        // Check for errors.
        if (PEAR::isError($result)) {
            $this->_pushWarning($result->getCode(), array());
            return;
        }
        
        // Now that the options are set, we can create some of 
        // the other pages.
        $this->_addNotebookPage($this->_createAddMaintainersPage(),  false);
        $this->_addNotebookPage($this->_createAddDependenciesPage(), false);
        $this->_addNotebookPage($this->_createAddReplacementsPage(), false);

        $this->notebook->next_page();
    }

    /**
     * Calls the package file manager's debug method.
     *
     * The file should always be previewed before it is saved.
     * 
     * @return void
     * @access private
     * @see    _writePackageFile()
     */
    function _previewFile()
    {
        // Create the window.
        $previewWindow =& new GtkWindow();
        $previewWindow->set_title('Preview');

        // Create some containers for layout.
        $frame =& new GtkFrame('package.xml');
        $vBox  =& new GtkVBox();
        $sWin  =& new GtkScrolledWindow();
        $text  =& new GtkText();
        
        // Set some display properties.
        $sWin->set_policy(GTK_POLICY_AUTOMATIC, GTK_POLICY_AUTOMATIC);
        $text->set_editable(false);
        $text->set_line_wrap(false);
        $text->set_usize(200, 200);
        
        // Add everything together.
        $previewWindow->add($vBox);
        $vBox->pack_start($frame);
        $frame->add($sWin);
        $sWin->add($text);
    
        // Get the preview and check for errors.
        ob_start();

        // I am calling writePackageFile with cli interface directly
        // because I don't ever want the user to see entities. It
        // is possible that they are running this app with PHP 
        // reporting as cgi. This accomplishes the same thing as
        // debugPackageFile() in command line mode.
        $result  = $this->_packageFileManager->writePackageFile(false);
        $preview = ob_get_contents();

        ob_end_clean();

        // Check for errors.
        if (PEAR::isError($result)) {
            $this->_pushWarning($result->getCode(), array());

            // Get rid of the widgets to conserve resources.
            unset($text);
            unset($sWin);
            unset($frame);
            unset($vBox);
            unset($preiewWindow);
            return;
        }

        // Clear out any text that may be left over.
        $text->delete_text(0, -1);
        
        // Add the preview text.
        $text->insert_text($preview, 0);
        
        // Add a close button and a save button.
        $bottomBox   =& new GtkHBox();
        $closeButton =& new GtkButton('Close');
        $saveButton  =& new GtkButton('Save');
        
        $saveButton->connect_object('clicked', array(&$this, '_writePackageFile'));
        $saveButton->connect_object_after('clicked', array(&$previewWindow, 'destroy'));
        $closeButton->connect_object('clicked', array(&$previewWindow, 'destroy'));

        // Pack the buttons together and add it to the window.
        $bottomBox->pack_start($closeButton, false, false, 3);
        $bottomBox->pack_end($saveButton, false, false, 3);
        $vBox->pack_start($bottomBox, false, false, 3);

        // Show the window.
        $previewWindow->show_all();

        // Track that the file has been previewed.
        $this->previewed = true;
    }

    /**
     * Writes the package file to package.xml.
     *
     * The package file should be tested first using the 
     * {@link _previewFile} method. The file is written to the
     * directory given as the package file directory on the
     * package page. 
     *
     * If there are problems writing the file, the user will 
     * be taken to the warnings page.
     * 
     * @return void
     * @access private
     * @see    _previewPackageFile()
     */
    function _writePackageFile()
    {
        // Check that the file has been previewed first.
        if (!$this->previewed) {
            $this->showWarnings('You must preview the file before you can save it.');
            $this->notebook->set_page(-1);
            return;
        }
        
        $result = $this->_packageFileManager->writePackageFile();

        // Check for errors.
        if (PEAR::isError($result)) {
            $this->_pushWarning($result->getCode(), array());
            return;
        }
        
        // Update the saved state.
        $this->saved = true;
    }

    /**
     * Uses PEAR to package the package.
     *
     * Does the same thing that calling $ pear package package.xml
     * would do but doesn't require the user to use the command
     * line. 
     * 
     * @return void
     * @access private
     */
    function _packagePackage()
    {
        // Check the saved state.
        // Don't need to check previewed because you can't save
        // unless you preview.
        if (!$this->saved) {
            $this->showWarnings('You must save the file before you can package it.');
            $this->notebook->set_page(-1);
            return;
        }

        // Include PEAR_Packager
        require_once 'PEAR/Packager.php';
        
        // Package the file.
        $packager =& new PEAR_Packager();
        $retVal = $packager->package($this->_options['packagedirectory'] . '/' . 'package.xml');

        // Check for errors.
        if (PEAR::isError($result)) {
            $this->_pushWarning($result->getCode(), array());
            return;
        }
    }

    /**
     * Adds the dependencies from the package file to the cList.
     *
     * This method adds the dependencies currently listed in the
     * package file to the cList. This will not retrieve any real
     * time additions.
     *
     * @param  object  $cList The list that should display the packages.
     * @return void
     * @access private
     */
    function _getDependencies($cList)
    {
        $options = $this->_packageFileManager->getOptions();
        foreach ($options['deps'] as $dep) {
            $this->_addToCList($cList, array($dep['name'], $dep['version'],
                                             ($dep['optional'] == 'yes' ? 'optional' : '')
                                             )
                               );
        }

    }

    /**
     * Swaps out the current to widget with the needed one.
     *
     * The to widget gets changed to a widget that will let
     * the user enter an appropriate value. This can be either
     * an entry or a combo. 
     *
     * This method can be used for both the global and file
     * replacements.
     * 
     * @param  object  $entry      The GtkEntry whose value was changed.
     * @param  array   &$toWidgets The possible to widgets.
     * @param  object  $toBox      The box that will hold the widget.
     * @return void
     * @access private
     */
    function _switchToWidget($entry, &$toWidgets, $toBox)
    {
        // Figure out what the selected value is.
        $selection = $entry->get_text();

        // Make sure something was selected.
        if (isset($selection)) {
            // Unparent the box's current child.
            $boxChild = $toBox->children[0];
            $child    = $boxChild->widget;
            if (isset($child)) {
                $toBox->remove($child);
            }

            // Add the correct widget to the box.
            $toBox->pack_start($toWidgets[$selection], false, false, 0);
            $toBox->show_all();
        }
    }

    /**
     * Adds the replacement information to the package file manager.
     *
     * Both the global and file replacements use this method. The
     * difference is that global replacements do not supply a file
     * path.
     *
     * @param  object  $pathWidget The widget holding the file path.
     * @param  object  $typeWidget The widget holding the replace type.
     * @param  object  $toWidget   The widget holding the to value.
     * @param  object  $fromWidget The widget holding the from value.
     * @param  object  $status     The label that will inform success.
     * @return void
     * @access private
     */
    function _addReplacement($pathWidget, $typeWidget, $toWidget, $fromWidget, $success)
    {
        // Reset the previewed and saved states.
        $this->previewed = false;
        $this->saved     = false;

        // Check to see if a widget was passed for the path.
        if (!isset($pathWidget)) {
            $path = NULL;
        } else {
            $pathItem = $pathWidget->list->selection[0];

            // Make sure something was selected.
            if (isset($pathItem)) {
                $path = strtolower($pathItem->get_data('role'));
            } else {
                $path = '';
            }
        }

        // Collect the rest of the data.
        $typeItem = $typeWidget->list->selection[0];
        $type     = $typeItem->get_data('type');

        $toWidgetChild = $toWidget->children[0];
        $toWidget      = $toWidgetChild->widget;
        if (get_class($toWidget) == 'gtkentry') {
            $to = $toWidget->get_text();
        } else {
            $toItem = $toWidget->list->selection[0];
            $to     = $toItem->get_data('type');
        }

        $from = $fromWidget->get_text();
        
        // Make sure something was selected.
        if (!isset($type) || !isset($to) || !isset($from)) {
            $this->showWarnings((isset($pathWidget) ? 'File' : 'Global') .
                                ' Replacement information is missing.' . 
                                ' Please make sure all fields are filled.');
        }

        // Figure out which type of replacement this is <global|file>.
        if (!isset($pathWidget)) {
            // If no file path widget, this must be global.
            $result = $this->_packageFileManager->addGlobalReplacement($type, $from, $to);
        } else {
            // If there is a file path widget this must be a file
            // replacement.
            $result = $this->_packageFileManager->addReplacement($path, $type, $from, $to);
        }

        // Check for errors.
        if (PEAR::isError($result)) {
            $this->_pushWarning($result->getCode(), array());

            // Make a note on the replacements page.
            $success->set_text('Replacement failed for ' . $from);

            // Then jump to the warnings.
            $this->notebook->set_page(-1);
        } else {
            // Make a note about successful replacement.
            $success->set_text($from . ' will be replaced with ' . $to);

            // Update the from widget as a second visual indication
            // of success.
            $fromWidget->set_text('');
        }
    }

    /**
     * Adds the data array to the GtkCList.
     *
     * First this method checks to see if the data is already 
     * present. (It only checks the first column.) Then it 
     * adds the data.
     *
     * @param  object  $cList The GtkCList to which data will be added.
     * @param  array   $data  The elements to be added to the list.
     * @access private
     */
    function _addToCList($cList, $data)
    {
        // Look for the same first data element and remove it if found.
        for ($i = 0; $i < $cList->rows; ++$i) {
            if ($data[0] == $cList->get_text($i, 0)) {
                $cList->remove($i);
            }
        }

        // Add the package to the clist.
        $cList->insert(0, $data);
    }

    /**
     * Takes data from the GtkCTree and puts it in the GtkCList.
     *
     * This is used to take the values from the dependency tree
     * and put them in the dependency list. Values are not added
     * as dependencies until the add dependencies button is 
     * pressed.
     * 
     * When a row is selected, the tree and node are passed to this
     * method. When the node is created, some data was stored with
     * it. That data is the package name and the version. After the
     * data is extracted, it is passed to the cList.
     *
     * @param  object  $tree    The GtkCTree containing the selected node.
     * @param  object  $node    The GtkCTree that was selected.
     * @param  mixed   $unknown Who knows. Seriously, if you do email me.
     *                          It gets passed by the event and we don't
     *                          know what it is. I will add it to the 
     *                          docs if you can tell me. Thanks.
     * @param  object  $list    The GtkCList that will hold the data from
     *                          the selected tree node.
     * @return void
     * @access private
     * @uses   _addToCList()
     */
    function _treeToCList($tree, $node, $unknown, $list)
    {
        // Get the data associated with this row.
        $data = $tree->node_get_row_data($node);
        
        // Only add if there is some data.
        // This will prevent package nodes from being
        // added. We only want version nodes.
        if (isset($data)) {
            $this->_addToCList($list, $data);
        }
    }

    /**
     * Toggles the optional status of a dependency when it is
     * selected.
     *
     * PFM lets you mark a package as an optional dependency.
     * This means that a given package will be used if it is
     * available but it is not required for proper operation.
     * This package is optionally dependent on Gtk_FileDrop
     * and also PHP_Compat. This package will work without 
     * them but if you have them it will add more features.
     *
     * @param  object  $cList The GtkClist that holds the data.
     * @param  integer $row   The row that was selected (starts at 0)
     * @param  integer $col   The column that was selected (starts at 0)
     * @param  object  $event The 'select-row' event
     * @return void
     * @access private
     */
    function _toggleOptional($cList, $row, $col, $event)
    {
        // Figure out the current status.
        $optional = $cList->get_text($row, 2);

        // Set the last column to be the oposite of what it is now.
        $cList->set_text($row, 2, ($optional == 'optional' ? '' : 'optional'));
    }
    
    /**
     * Adds the selected packages as dependencies.
     * 
     * All packages from the GtkCList are added as dependencies to
     * the package being built. As of 2005-03-18, only package 
     * dependencies may be added using this tool. Other types (php,
     * etc.) may be added at a later date. 
     *
     * @param  object  $cList The GtkCList holding the packages.
     * @return void
     * @access private
     */
    function _addDependencies($cList)
    {
        // Clear the previewed and saved states.
        $this->previewed = false;
        $this->saved     = false;

        // Loop through all of the packages in the list.
        for ($i = 0; $i < $cList->rows; ++$i) {
            // Get the optional status.
            $optional = $cList->get_text($i, 2);

            // Attempt to add the package as a dependency.
            $result = $this->_packageFileManager->addDependency($cList->get_text($i, 0),
                                                                $cList->get_text($i, 1),
                                                                'ge', 'pkg',
                                                                !empty($optional));
            
            // Check for errors.
            if (PEAR::isError($result)) {
                $this->_pushWarning($result->getCode(), array());
                // There is no need to stop adding the rest just
                // because one failed.
                //return;
            }
        }
    }

    /**
     * Adds a maintainer to the package file.
     *
     * Checks that all of the information was given then tries
     * to add the maintainer. If there is a problem, the user
     * will be taken to the warnings page. 
     *
     * @param  object  $handle The entry that has the developer's handle.
     * @param  object  $role   The combo that has the developer's role.
     * @param  object  $name   The entry that has the developer's name.
     * @param  object  $email  The entry that has the developer's email.
     * @param  object  $currentList The GtkCList that will show the developers.
     * @return void
     * @access private
     */
    function _addMaintainer($handle, $role, $name, $email, $currentList)
    {
        // Reset the previewed and saved states.
        $this->previewed = false;
        $this->saved     = false;

        // Grab the information.
        // The role is a little tricky.
        $handleText = $handle->get_text();
        $nameText   = $name->get_text();
        $emailText  = $email->get_text();
        $roleItem   = $role->list->selection[0];
        
        // Make sure something was selected.
        if (isset($roleItem)) {
            $roleText = strtolower($roleItem->get_data('role'));
        } else {
            $roleText = '';
        }

        // Check to make sure everything is there.
        if (empty($handleText) || empty($nameText) || empty($emailText) || empty($roleText)) {
            // Add the warning to the warning stack.
            $this->showWarnings('Maintainer information is missing. Please check all fields.');
            $this->notebook->set_page(-1);
            return;
        }
        
        // Add the maintainer.
        $result = $this->_packageFileManager->addMaintainer($handleText, $roleText,
                                                            $nameText, $emailText);
        
        // Check for errors.
        if (PEAR::isError($result)) {
            $this->_pushWarning($result->getCode(), array());
            return;
        }

        // Update the current list.
        $this->_addToCList($currentList, array($nameText, $emailText, $roleText));
    }

    /**
     * Adds the developers from the previous release to the given
     * GtkCList.
     *
     * This method is used when the developers page is created. It
     * puts the developers from the previous release into the cList.
     * Developers added as of this release are added by
     * {@link _addMaintainer()}.
     *
     * @param  object  $cList The GtkCList that will have the developer added.
     * @return void
     * @access private
     */
    function _listDevelopers($cList)
    {
        // Then add each developer.
        $options = $this->_packageFileManager->getOptions();
        foreach ($options['maintainers'] as $maintainer) {
            $this->_addToCList($cList, array($maintainer['name'],
                                             $maintainer['email'],
                                             $maintainer['role']
                                             )
                               );
        }            
    }

    /**
     * Imports the options from a previously created file.
     *
     * After importing the options, this method also updates the
     * values of some widgets. 
     * 
     * @param  object  $packageDirEntry  The GtkEntry holding the package directory.
     * @param  object  $pacakgeNameEntry The GtkEntry holding the package name.
     * @param  object  $baseEntry        The GtkEntry holding the base install directory.
     * @param  object  $summaryEntry     The GtkEntry holding the package summary.
     * @param  object  $descriptiontText The GtkText holding the package description.
     * @return void
     * @access private
     */
    function _importPackageOptions($packageDirEntry, $packageNameEntry,
                                   $baseEntry, $summaryEntry, $descriptionText)
    {
        // Figure out if there is a package file in the given
        // directory.
        if (@is_dir($packageDirEntry->get_text())) {
            $packageFile = $packageDirEntry->get_text() . '/package.xml';
        } elseif (strrpos($packageDirEntry->get_text(), 'package.xml')) {
            // Check if the path is straight to the file not the
            // directory.
            $packageFile = $packageDirEntry->get_text();
        } else {
            // No package file to load.
            return;
        }

        // If we can't read it, we can't load it.
        if (@!is_readable($packageFile)) {
            return;
        }

        // We have a readable package file. Hopefully it will
        // be valid.
        $result = $this->_packageFileManager->importOptions($packageFile);
        
        // Check for errors.
        if (PEAR::isError($result)) {
            /*
            // Try setting a bunch of garbage options first if 
            // PFM complains about running setOptions().
            // Please note, this is a dirty hack to make up for
            // some deficiencies in PFM-1.5.0
            if ($result->getCode() == PEAR_PACKAGEFILEMANAGER_RUN_SETOPTIONS) {
                $tmpOptions = array('packagedirectory' => '/tmp',
                                    'package'          => 'TEMP',
                                    'baseinstalldir'   => '',
                                    'summary'          => 'TEMP',
                                    'description'      => 'TEMP',
                                    'state'            => 'alpha',
                                    'version'          => '1.0.0a',
                                    'notes'            => 'temp notes'
                                    );
                $result2 = $this->_packageFileManager->setOptions($tmpOptions);
                // Check to see if our garbage was accepted.
                if (PEAR::isError($result2)) {
                    $this->_pushWarning($result2->getCode(), array());
                } else {
                    // Try again....
                    $result2 = $this->_packageFileManager->importOptions($packageFile);
                    if (PEAR::isError($result2)) {
                        // Still no luck. Give up.
                        $this->_pushWarning($result2->getCode(), array());
                        return;
                    }                         
                }
            } else {
            */
                // An error, but not about setting options.
                $this->_pushWarning($result->getCode(), array());
                return;
                //}
        }

        // No problems. Load the data into the widgets.
        $options = $this->_packageFileManager->getOptions();
        $packageNameEntry->set_text($options['package']);
        $baseEntry->set_text($options['baseinstalldir']);
        $summaryEntry->set_text($options['summary']);
        
        // First clear out any text in the description area.
        $descriptionText->delete_text(0, -1);
        $descriptionText->insert_text($options['description'], 0);
    }

    /**
     * Adds a warning to the warning stack.
     * 
     * After adding the error to the stack, the user is taken to the
     * warnings page. When the page is switched, warnings are popped
     * off of the stack.
     *
     * @param  integer $code
     * @param  array   $info Associative array of message replacement info.
     * @return void
     * @access private
     */
    function _pushWarning($code, $info)
    {
        // Add the warning to the package file manager warnings.
        $this->_packageFileManager->pushWarning($code, $info);
                
        // Then jump to the warnings page.
        $this->notebook->set_page(-1);
    }
}
?>