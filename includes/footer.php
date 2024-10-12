    
    <div class="footer">
        <?php
        $sql = "SELECT * from tblpage where PageType='contactus'";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            foreach ($results as $row) { ?>

                <div>
                    <p style="font-size:16px;">
                        <i aria-hidden="true"></i> <?php echo htmlentities($row->PageDescription); ?>.
                        &emsp;&emsp;|&emsp;&emsp;
                        <i aria-hidden="true"></i> <?php echo htmlentities($row->Email); ?>
                        &emsp;&emsp;|&emsp;&emsp;
                        <i aria-hidden="true"></i> +<?php echo htmlentities($row->MobileNumber); ?>
                    </p>
                    <p>© 2024 Perera Vehicle Service Centre &emsp;|&emsp; All rights reserved</p>
                </div>

            <?php }
        } ?>

    </div>