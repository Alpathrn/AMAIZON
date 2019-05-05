<?php
$prix = $tmp['promotion'] == '0' ? $tmp['prix'] : $tmp['prix'] - ($tmp['prix'] * $tmp['promotion'] / 100);
if ($tmp['visible'] or $_SESSION['utilisateur']['admin']) { ?>
    <div class="col-lg-3 article" <?php if (!$tmp['visible']) { ?>style="opacity: 0.15;" <?php } ?>>
        <a href="article.php?id=<?php echo ($tmp['id']) ?>">
            <div class="center-container" style="height:250px;">
                <img alt="" src="<?php echo (chemin_photo('images/articles/', $tmp['id'])) ?>" />
            </div>
            <div class="info">
                <div class="nom"><?php echo ($tmp['nom']) ?></div>
                <div class="custom"><?php echo $custom ?></div>
                <div class="prix">
                    <?php echo $prix ?>€
                    <?php if ($tmp['promotion'] != '0') { ?><span style="text-decoration:line-through; font-size: 14px; color: gray;"><?php echo $tmp['prix'] ?>€</span><?php } ?>
                </div>

            </div>
        </a>
    </div>
<?php }
?>