<div class="pagetitle">
    <h1><?php echo ucfirst($GLOBALS["page"]); ?></h1>
    <nav>
        <ol class="breadcrumb">
            <?php
            echo $GLOBALS["page"]=="dashboard" ? "" : "<li class='breadcrumb-item'><a href='?page=dashboard'>Dashboard</a></li>";
            ?>
            <li class="breadcrumb-item active"><?php echo ucfirst($GLOBALS["page"]); ?></li>
        </ol>
    </nav>
</div><!-- End Page Title -->