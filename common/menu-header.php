<div class="bg-image px-4 py-5">
    <div class="py-5">
          <span class="display-5">
            <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                      <span class="display-5 text-white">Our Menu</span>
                  </li>
                </ol>
            </nav>
          </span>
    </div>
</div>

<!-- Menu Navigation -->
<div class="container my-4">
    <div class="row flex-nowrap overflow-auto py-3 m-auto">
        <div class='col text-center mb-2'>
            <a href='?page=menu' class='btn btn-primary w-100'>All</a>
        </div>
        <?php
        $categories = $category->getActiveCategories();
        foreach ($categories as $cat) {
            echo "<div class='col text-center mb-2'>
                    <a href='?page=menu&&action=filter&&categoryId=$cat[food_category_id]' class='btn btn-primary w-100'>$cat[food_category_name]</a>
                  </div>";
        }
        ?>
    </div>
</div>