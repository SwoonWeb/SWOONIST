<?php

class Simple_Nav_Walker extends Walker
{
  public function walk( $elements, $max_depth )
  {
    $list = array ();

    foreach ( $elements as $item )
    {
        if ( $item->current )
            $list[] = "<b title='You are here'>$item->title</b>";
        else
            $list[] = "<a href='$item->url'>$item->title</a>";
    }

    return join( "\n", $list );
  }
}