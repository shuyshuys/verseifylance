<?php
class AlertMessage {
    public static function displayAlert($type, $message) {
        echo '<div class="alert alert-' . $type . ' d-flex align-items-center" role="alert">';
        echo '    <svg class="bi flex-shrink-0 me-2" width="24" height="24">';
        echo '        <use xlink:href="#info-fill" />';
        echo '    </svg>';
        echo '    <div>';
        echo $message;
        echo '    </div>';
        echo '</div>';
    }
}
