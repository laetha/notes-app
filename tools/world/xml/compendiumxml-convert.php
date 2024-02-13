<?php
// LOAD XML AND XSLT
$doc = new DOMDocument();
$doc->load('complete/races.xml');

$xsl = new DOMDocument;
$xsl->load('xml-conv-quests.xsl');

// CONFIGURE TRANSFORMER
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl);

// RUN TRANSFORMATION
$newXML = $proc->transformToXML($doc);

// OUTPUT TO CONSOLE
echo $newXML;

// OUTPUT TO FILE
file_put_contents('Output1.xml', $newXML);

?>