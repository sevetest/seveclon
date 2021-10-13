<?php
/*Función para cifrar con AES-256 */
function cifrar($mensaje,$llave){
  
  /*Vector de inicialización para generar el cifrado */
  $vector=openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));

  /*Método para cifrar la información */
  $mencriptado=openssl_encrypt($mensaje,"AES-256-CBC",$llave,0,$vector);
  
 /*  Regresa el mensaje cifrado */
  return base64_encode($mencriptado."::".$vector);
}


/*Función para descifrar con AES-256 */
function descrifrar($mensaje, $llave){

/*Decodificar los datos*/
list($datos_encriptados,$vector) = explode('::', base64_decode($mensaje),2);

/*Método para descifrar la información */
return openssl_decrypt($datos_encriptados,'AES-256-CBC',$llave,0,$vector);
}

?>