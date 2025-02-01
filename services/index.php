<h1 class="pageTitle text-center">Our Services</h1>
<hr class="mx-auto bg-primary border-primary opacity-100" style="width:50px">
<div class="container-sm">
    <?php 
    // Fetch all categories
    $categories = $conn->query("SELECT DISTINCT `category` FROM `service_list` WHERE `status` = 1 ORDER BY `category` ASC")->fetch_all(MYSQLI_ASSOC);
    // Fetch all services
    $services = $conn->query("SELECT * FROM `service_list` WHERE `status` = 1 ORDER BY `name` ASC")->fetch_all(MYSQLI_ASSOC);
    ?>

    <!-- Categories -->
    <div id="categories" class="mb-4 text-center">
        <?php foreach($categories as $cat): ?>
            <button class="btn btn-outline-primary category-btn" data-category="<?= htmlspecialchars($cat['category']) ?>">
                <?= htmlspecialchars($cat['category']) ?>
            </button>
        <?php endforeach; ?>
    </div>

    <!-- Services -->
    <div id="service-list">
        <?php if(count($services) > 0): ?>
        <?php foreach($services as $row): ?>
        <a href="<?= base_url.'?page=services/view&id='.$row['id'] ?>" 
           class="service-item text-decoration-none text-reset" 
           data-category="<?= htmlspecialchars($row['category']) ?>">
            <div class="card mb-3">
                <div class="service-card-img">
                    <img src="<?= validate_image($row['image_path']) ?>" alt="">
                </div>
                <div class="card-body pt-3">
                    <h4 class="card-title"><?= htmlspecialchars($row['name']) ?></h4>
                    <p class="truncate-3"><?= strip_tags(htmlspecialchars_decode($row['description'])) ?></p>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if(count($services) <= 0): ?>
        <div class="text-muted text-center">No Service Listed Yet</div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const categoryButtons = document.querySelectorAll(".category-btn");
        const serviceItems = document.querySelectorAll(".service-item");

        categoryButtons.forEach(button => {
            button.addEventListener("click", () => {
                const selectedCategory = button.getAttribute("data-category");

                // Filter services based on the selected category
                serviceItems.forEach(item => {
                    if (item.getAttribute("data-category") === selectedCategory) {
                        item.style.display = "block";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });
    });
</script>




<!-- prev code -->
<!-- <h1 class="pageTitle text-center">Our Services</h1>
<hr class="mx-auto bg-primary border-primary opacity-100" style="width:50px">
<div class="container-sm">
    <?php 
    $services = $conn->query("SELECT * FROM `service_list` where `status` = 1 order by `name` asc")->fetch_all(MYSQLI_ASSOC);

    ?>
    <div id="service-list">
        <?php if(count($services) > 0): ?>
        <?php foreach($services as $row): ?>
        <a href="<?= base_url.'?page=services/view&id='.$row['id'] ?>" class="service-item text-decoration-none text-reset">
            <div class="card">
                <div class="service-card-img">
                    <img src="<?= validate_image($row['image_path']) ?>" alt="">
                </div>
                <div class="card-body pt-3">
                    <h4 class="card-title"><?= $row['name'] ?></h4>
                    <p class="truncate-3"><?= strip_tags(htmlspecialchars_decode($row['description'])) ?></p>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php if(count($services) <= 0): ?>
        <div class="text-muted text-center">No Service Listed Yet</div>
    <?php endif; ?>

</div> -->