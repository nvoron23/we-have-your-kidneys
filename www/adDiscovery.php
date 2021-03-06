<?php
/**
 * Ad discovery
 *
 * Pick an ad at random so we can learn which segments over-index on CTR.
 * 
 * @author Dave Gardner <dave@cruft.co>
 *
 * This file is part of We Have Your Kidneys.
 *
 * We Have Your Kidneys is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * We Have Your Kidneys is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with We Have Your Kidneys.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

include_once dirname(__FILE__) . '/../thirdParty/phpcassa/columnfamily.php';
include_once dirname(__FILE__) . '/../lib/identify.php';
include_once dirname(__FILE__) . '/../lib/ads.php';

try {
    $ids = array_keys($adDefinitions);
    shuffle($ids);
    $adId = array_pop($ids);
    
    $ad = $adDefinitions[$adId];
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: text/plain');
    echo $e->getMessage();
}

?>
<div>
    <a href="http://www.wehaveyourkidneys.com/adClick.php?ad=<?=$adId?>" title="<?=htmlspecialchars($ad['title'])?>">
        <img src="<?=$ad['img']?>" alt="<?=htmlspecialchars($ad['title'])?>" />
    </a>
    <img src="http://pixel.wehaveyourkidneys.com/adImpression.php?ad=<?=$adId?>&r=<?=time()?>" width="1" height="1" />
</div>