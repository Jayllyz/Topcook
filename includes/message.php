<?php
    if (isset($_GET['message']) && !empty($_GET['message'])) {
      if(isset($_GET['type']) && !empty($_GET['type'])) {
        echo '<p class="alert alert-'.htmlspecialchars($_GET['type']).'">' . htmlspecialchars($_GET['message']) . '</p>';
      }
      
    }
?>