<?php

namespace App\Html;

/**
 * Just a class with multiple helper methods to build HTML
 * components/controls or format them to be used in tables
 * cells
 *
 * @author Eczek
 */
class Grid 
{
    /**
     * Renders HTML to output a bootstrap check icon or cross depending on
     * the value in $value. If true a green check will be rendered, otherwise
     * a red cross will be rendered
     * 
     * @param bool $value 
     * @return string
     */
    public static function booleanIcon($value) {
        $iconIdentifier = ($value) ? 'ok' : 'remove';
        $iconColor = ($value) ? 'green' : 'red';
        return "<span class='glyphicon glyphicon-$iconIdentifier' ".
               "aria-hidden='true' style='color:$iconColor'></span>";
    }
    
    /**
     * Outputs HTML for a URL with the given link text $linkText and
     * pointing to $url
     * 
     * @param string $linkText text for the link
     * @param string $url 
     * @param bool $newWindow
     * @return string
     */
    public static function makeLink($linkText, $url, $newWindow = false) {
        $target = $newWindow ? 'target="_blank"' : '';
        return "<a href='$url' $target >$linkText</a>";
    }
    
    /**
     * Processes the value from a Grid cell. If value is empty it will
     * return a label indicating the data for the cell is not present in the
     * DB. Otherwise, it will return the value in $processedValue
     * 
     * @param mixed $value
     * @param string $processedValue
     * @return string
     */
    public static function cellFormatter($value, $processedValue) {
        if($value === ''    || 
           is_null($value)  || 
           $value === '0000-00-00') {
            return "<span style='background-color: red; color: white'>Data Not Provided</span>";
        }
        return $processedValue;
    }
    
    /**
     * Renders links with icons for edit and delete
     * 
     * @param string $editUrl
     * @param string $deleteUrl
     * @return string
     */
    public static function actionsCell($editUrl, $deleteUrl) {
        return "<a title='Modify' href='$editUrl'><span class='glyphicon glyphicon-edit'></span></a>" .
               "<a class='text-danger' title='Delete' href='$deleteUrl'><span class='glyphicon glyphicon-trash'></span></a>";
    }
}
