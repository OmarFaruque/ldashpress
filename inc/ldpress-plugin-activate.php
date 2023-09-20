<?php

class LdpressPluginActivate
{
  public static function activate() {
    flush_rewrite_rules();
  }
}
