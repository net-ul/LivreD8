<?php

namespace Drupal\vehicule\Examples;

class ObjetSerializable implements \Serializable {

  /**
   * {@inheritdoc}
   */
  public function serialize() {
    return serialize();
  }

  /**
   * {@inheritdoc}
   */
  public function unserialize($serialized) {
    return unserialize();
  }

}
