<?php

namespace Common;

class Convert
{
    /*
     * Transform array to the xml representation
     */
    public static function to_xml( $data, &$xml_data )
    {
        foreach( $data as $key => $value ) {

            if( is_numeric($key) ){

                $key++;

                $key = 'item-'.$key; //dealing with <0/>..<n/> issues
            }

            if( is_array($value) ) {

                $subnode = $xml_data->addChild($key);

                self::to_xml($value, $subnode);

            } else {

                $xml_data->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}