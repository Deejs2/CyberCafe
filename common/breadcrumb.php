
<div class="bg-image px-4 py-5">
    <div class="py-5">
          <span class="display-5">
            <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-white" href="<?php echo $GLOBALS["menuLink"] ?>">Menu</a></li>
                  <li class="breadcrumb-item active">
                      <span class="text-white">
                          <?php
                          if(ucfirst($page)=="Auth"){
                              echo ucfirst($action);
                          }else{
                              echo ucfirst($page);
                          }
                          ?>
                      </span>
                  </li>
                </ol>
            </nav>
          </span>
    </div>
</div>