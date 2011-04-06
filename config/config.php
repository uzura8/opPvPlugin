<?php
// PVログ出力
$this->dispatcher->connect(
  'response.filter_content', 
  array('opPvPluginHttpdLog', 'outputAccessLog')
);
