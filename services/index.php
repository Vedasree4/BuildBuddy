<h1 class="pageTitle text-center">Our Services</h1>
<hr class="mx-auto bg-primary border-primary opacity-100" style="width:50px">
<div class="container-sm">
    <?php 
    // Fetch all categories
    $categories = $conn->query("SELECT DISTINCT `category` FROM `service_list` WHERE `status` = 1 ORDER BY `category` ASC")->fetch_all(MYSQLI_ASSOC);

    // Fetch all distinct service types
    $service_types = $conn->query("SELECT DISTINCT `price_type` FROM `service_list` WHERE `status` = 1 ORDER BY `price_type` ASC")->fetch_all(MYSQLI_ASSOC);

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

    <!-- Service Type Dropdown Filter -->
    <div id="service-type-filter" class="mb-4 text-center">
        <label for="serviceTypeDropdown" class="form-label">Select Service Type:</label>
        <select class="form-select" id="serviceTypeDropdown">
            <option value="All">All Types</option>
            <?php foreach($service_types as $type): ?>
                <option value="<?= htmlspecialchars($type['price_type']) ?>">
                    <?= htmlspecialchars($type['price_type']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Services -->
    <div id="service-list">
        <?php if(count($services) > 0): ?>
        <?php foreach($services as $row): ?>
        <div class="service-item text-decoration-none text-reset" 
           data-category="<?= htmlspecialchars($row['category']) ?>"
           data-name="<?= htmlspecialchars($row['name']) ?>"
           data-description="<?= htmlspecialchars($row['description']) ?>"
           data-address="<?= htmlspecialchars($row['company_address']) ?>"
           data-contact="<?= htmlspecialchars($row['company_contact']) ?>"
           data-email="<?= htmlspecialchars($row['company_email']) ?>"
           data-price="<?= htmlspecialchars($row['price_details']) ?>"
           data-price-type="<?= htmlspecialchars($row['price_type']) ?>">
            <div class="card mb-3">
                <div class="service-card-img">
                    <img src="<?= validate_image($row['image_path']) ?>" alt="">
                </div>
                <div class="card-body pt-3">
                    <h4 class="card-title"><?= htmlspecialchars($row['name']) ?></h4>
                    <p class="truncate-3"><?= strip_tags(htmlspecialchars_decode($row['description'])) ?></p>
                    <p><strong>Price:</strong> <?= htmlspecialchars($row['price_details']) ?></p>
                    <p><strong>Price Type:</strong> <?= htmlspecialchars($row['price_type']) ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if(count($services) <= 0): ?>
        <div class="text-muted text-center">No Service Listed Yet</div>
    <?php endif; ?>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="serviceModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="serviceDescription"></p>
        <hr>
        <h6>Company Details:</h6>
        <p><strong>Address:</strong> <span id="serviceAddress"></span></p>
        <p><strong>Contact:</strong> <span id="serviceContact"></span></p>
        <p><strong>Email:</strong> <span id="serviceEmail"></span></p>
        <hr>
        <p><strong>Price:</strong> <span id="servicePrice"></span></p>
        <p><strong>Price Type:</strong> <span id="servicePriceType"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const categoryButtons = document.querySelectorAll(".category-btn");
        const serviceTypeDropdown = document.getElementById("serviceTypeDropdown");
        const serviceItems = document.querySelectorAll(".service-item");

        let selectedCategory = null;
        let selectedServiceType = "All"; // Default to showing all types

        // Category filter
        categoryButtons.forEach(button => {
            button.addEventListener("click", () => {
                selectedCategory = button.getAttribute("data-category");

                // Apply the filter logic
                filterServices();
            });
        });

        // Service Type dropdown filter
        serviceTypeDropdown.addEventListener("change", () => {
            selectedServiceType = serviceTypeDropdown.value;

            // Apply the filter logic
            filterServices();
        });

        // Filter services based on both category and service type
        function filterServices() {
            serviceItems.forEach(item => {
                const itemCategory = item.getAttribute("data-category");
                const itemServiceType = item.getAttribute("data-price-type");

                // Show item if it matches the selected filters
                if ((selectedCategory === null || itemCategory === selectedCategory) &&
                    (selectedServiceType === "All" || itemServiceType === selectedServiceType)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        }

        // Handle service item click (show modal with service details)
        serviceItems.forEach(item => {
            item.addEventListener("click", () => {
                document.getElementById("serviceModalLabel").innerText = item.getAttribute("data-name");
                document.getElementById("serviceDescription").innerHTML = item.getAttribute("data-description");
                document.getElementById("serviceAddress").innerText = item.getAttribute("data-address");
                document.getElementById("serviceContact").innerText = item.getAttribute("data-contact");
                document.getElementById("serviceEmail").innerText = item.getAttribute("data-email");
                document.getElementById("servicePrice").innerText = item.getAttribute("data-price");
                document.getElementById("servicePriceType").innerText = item.getAttribute("data-price-type");

                // Show Bootstrap modal
                var serviceModal = new bootstrap.Modal(document.getElementById('serviceModal'));
                serviceModal.show();
            });
        });
    });
</script>
