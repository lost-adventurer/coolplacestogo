<?php
/**
 * Created by PhpStorm.
 * User: Rafe
 * Date: 06/01/2018
 * Time: 17:25
 */
?>
<h2>Location data for London</h2>

<?php
foreach($feed as $feed_data){
    echo '<div>';
    echo $feed_data['name'].'<br>';
    echo $feed_data['description'].'<br>';
    echo $feed_data['map'].'<br>';
    echo $feed_data['location_id'].'<br>';
    echo $feed_data['provider'].'<br>';
    echo $feed_data['link'].'<br>';
    echo '</div>';
}
?>