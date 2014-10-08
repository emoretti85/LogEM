<?php
/**
 * Require the log class
 */
require_once 'class/LogEM.php';

/**
 * Get Log singleton instance
 */
$L=LogEM::getIstanza();


/**
 * Example uses log 
 */
$L->log("Prova di debug senza type");
$L->log("Prova di debug","Debug");
$L->log("Prova di error","Error");
$L->log("Prova di warning","Warning");
$L->log("Prova di applicationLog","ApplicationLog");
