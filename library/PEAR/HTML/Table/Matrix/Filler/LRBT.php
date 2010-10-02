<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
require_once 'HTML/Table/Matrix/Filler.php';

/**
 * Fill left-to-right, bottom-to-top.
 *
 * @author Arpad Ray <arpad@rajeczy.com>
 * @package HTML_Table_Matrix
 */
class HTML_Table_Matrix_Filler_LRBT extends HTML_Table_Matrix_Filler {
    /**
     * Constructor
     *
     * @param Object $matrix Reference to the HTML_Table_Matrix instance we are
     *                       filling data for.
     * @param array $options Options for this Filler
     * @return void
     */
    function HTML_Table_Matrix_Filler_LRBT(&$matrix, $options = false) {
        $this->setOptions($options);
        $this->matrix = &$matrix;
    }

    /**
     * Get the next cell.
     *
     * @param int $index Where we're at in the data-set
     * @return array 1-dimensional array in the form of (row, col) containing the
     *               coordinates to put the data for this loop iteration
     */
    function next($index) {
        if ($index == 0) {
            $this->row = $this->matrix->_rows - 1;
            $this->col = $this->matrix->_fillStartCol;
        } else {
            $this->col++;
            if ($this->col >= $this->matrix->_cols) {
                $this->col = $this->matrix->_fillStartCol;
                $this->row--;
            }
        }

        return array($this->row, $this->col);
    }
}
?>
