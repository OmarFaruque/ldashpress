<?php

class LdpressPluginDeactivate
{
  public static function deactivate() {
    flush_rewrite_rules();
  }
}
