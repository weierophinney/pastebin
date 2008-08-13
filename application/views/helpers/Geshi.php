<?php
require_once 'geshi.php';

class Zend_View_Helper_Geshi extends Zend_View_Helper_Abstract
{
    public function geshi($code, $language)
    {
        $lines = preg_split('/(\r[\n]?|\n)/', $code);
        foreach ($lines as $key => $line)  {
            if (preg_match('/^(([ ]{4})+)/', $line, $matches)) {
                $numTabs     = strlen($matches[1]) / 4;
                $tabs        = str_repeat("\t", $numTabs);
                $lines[$key] = str_replace($matches[1], $tabs, $line);
            }
        }
        $code = implode("\n", $lines);

        $geshi = new GeSHi($code, $language);
        $geshi->set_header_type(GESHI_HEADER_PRE);
        $geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
        $geshi->set_overall_class('formatted');

        return $geshi->parse_code();
    }
}
