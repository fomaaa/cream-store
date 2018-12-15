
  <li> SubTOtal: <strong data-subtotal="<?php echo  WC()->cart->subtotal ?>"><?php echo WC()->cart->get_cart_subtotal(); ?> USD</strong>
  </li>
  <li> Shipping: <strong data-shipping><?php echo WC()->cart->get_cart_shipping_total() ?></strong>
  </li>
  <li> TOTAL: <strong data-total><?php echo WC()->cart->get_cart_total(); ?> USD</strong>
  </li>
