<?php 
$json = file_get_contents('https://enterkomputer.com/api/product/vga.json');


function searchJson( $obj, $value ) {
    foreach( $obj as $key => $item ) {
        if( !is_nan( intval( $key ) ) && is_array( $item ) ){
            if( in_array( $value, $item ) ) return $item;
        } else {
            foreach( $item as $child ) {
                if(isset($child) && $child == $value) {
                    return $child;
                }
            }
        }
    }
    return null;
}
$data = json_decode( $json );
$results = searchJson( $data , "name" );
print_r( $results );

?>