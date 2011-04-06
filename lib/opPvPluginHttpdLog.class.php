<?php

/**
 * @package    OpenPNE
 * @author     Shingo Yamada <s.yamada@tejimaya.com>
 */
class opPvPluginHttpdLog
{
  static public function outputAccessLog(sfEvent $event, $content = '')
  {
    if (!function_exists('apache_note'))
    {
      return $content;
    }

    $response = sfContext::getInstance()->getResponse();
    $apps = sfContext::getInstance()->getConfiguration()->getApplication();
    if (('pc_frontend' === $apps || 'mobile_frontend' === $apps)
        && 200 === $response->getStatusCode())
    {
      $memberId = (int)sfContext::getInstance()->getUser()->getMemberId();
      $domain = sfContext::getInstance()->getRequest()->getHost();
      apache_note('originallog', sprintf('PV %s %s %s %d', $apps, $domain, memory_get_peak_usage(), $memberId));
    }
    else
    {
      apache_note('originallog', sprintf('OT %s %s %s %d', $apps, '-', memory_get_peak_usage(), 0));
    }

    return $content;
  }
}
