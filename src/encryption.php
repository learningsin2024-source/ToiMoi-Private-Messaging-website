<?php
require 'config.php';

function derive_key($passphrase) {
    return hash('sha256', $passphrase, true);
}

function encrypt_message($plaintext) {
    $key = derive_key(ENCRYPTION_PASSPHRASE);
    $iv = openssl_random_pseudo_bytes(16);
    $cipher = openssl_encrypt($plaintext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv) . ':' . base64_encode($cipher);
}

function decrypt_message($stored) {
    $key = derive_key(ENCRYPTION_PASSPHRASE);
    $parts = explode(':', $stored);
    if (count($parts) !== 2) return '';
    $iv = base64_decode($parts[0]);
    $ciphertext = base64_decode($parts[1]);
    return openssl_decrypt($ciphertext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
}
?>