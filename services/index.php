<h1 class="pageTitle text-center">Our Services</h1>
<hr class="mx-auto bg-primary border-primary opacity-100" style="width:50px">
<div class="container-sm">
    <?php 
    $categories = $conn->query("SELECT DISTINCT `category` FROM `service_list` WHERE `status` = 1 ORDER BY `category` ASC")->fetch_all(MYSQLI_ASSOC);
    $locations = $conn->query("SELECT DISTINCT `company_address` FROM `service_list` WHERE `status` = 1 ORDER BY `company_address` ASC")->fetch_all(MYSQLI_ASSOC);
    $services = $conn->query("SELECT * FROM `service_list` WHERE `status` = 1 ORDER BY `name` ASC")->fetch_all(MYSQLI_ASSOC);
    ?>

    <!-- Filters Container -->
    <div class="row mb-4">
        <div class="col-md-3">
            <select class="form-select" id="categoryFilter">
                <option value="all">All Categories</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat['category']) ?>">
                        <?= htmlspecialchars($cat['category']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-3">
            <select class="form-select" id="priceFilter">
                <option value="all">All Prices</option>
                <option value="0-1000">$0 - $1,000</option>
                <option value="1001-5000">$1,001 - $5,000</option>
                <option value="5001-10000">$5,001 - $10,000</option>
                <option value="10001+">$10,001+</option>
            </select>
        </div>

        <div class="col-md-3">
            <select class="form-select" id="priceTypeFilter">
                <option value="all">All Price Types</option>
                <option value="fixed">Fixed</option>
                <option value="negotiable">Negotiable</option>
            </select>
        </div>

        <!-- Location Filter -->
        <div class="col-md-3">
            <select class="form-select" id="locationFilter">
                <option value="all">All Locations</option>
                <?php foreach($locations as $loc): ?>
                    <option value="<?= htmlspecialchars($loc['company_address']) ?>">
                        <?= htmlspecialchars($loc['company_address']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Services List -->
    <div id="service-list">
        <?php if(count($services) > 0): ?>
        <?php foreach($services as $row): ?>
        <div class="service-item text-decoration-none text-reset" 
           data-category="<?= htmlspecialchars($row['category']) ?>"
           data-name="<?= htmlspecialchars($row['name']) ?>"
           data-price-amount="<?= htmlspecialchars(preg_replace('/[^0-9.]/', '', $row['price_details'])) ?>"
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
                    <p><strong>Location:</strong> <?= htmlspecialchars($row['company_address']) ?></p>
                    <p><strong>Price:</strong> <?= htmlspecialchars($row['price_details']) ?></p>
                    <p><strong>Price Type:</strong> <?= ucfirst(htmlspecialchars($row['price_type'])) ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        
        <p id="noResultsMessage" class="text-muted text-center" style="display: none;">No services match your selected filters.</p>
    </div>

    <?php if(count($services) <= 0): ?>
        <div class="text-muted text-center">No Service Listed Yet</div>
    <?php endif; ?>
</div>

<!-- Service Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Description:</strong> <span id="serviceDescription"></span></p>
                <p><strong>Location:</strong> <span id="serviceAddress"></span></p>
                <p><strong>Contact:</strong> <span id="serviceContact"></span></p>
                <p><strong>Email:</strong> <span id="serviceEmail"></span></p>
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
    const serviceList = document.getElementById("service-list");
    const categoryFilter = document.getElementById("categoryFilter");
    const priceFilter = document.getElementById("priceFilter");
    const priceTypeFilter = document.getElementById("priceTypeFilter");
    const locationFilter = document.getElementById("locationFilter");

    function filterServices() {
        const selectedCategory = categoryFilter.value;
        const selectedPriceRange = priceFilter.value;
        const selectedPriceType = priceTypeFilter.value;
        const selectedLocation = locationFilter.value;
        let visibleCount = 0;

        document.querySelectorAll(".service-item").forEach(item => {
            const itemCategory = item.getAttribute("data-category");
            const itemPrice = parseFloat(item.getAttribute("data-price-amount")) || 0;
            const itemPriceType = item.getAttribute("data-price-type");
            const itemLocation = item.getAttribute("data-address");

            let showByCategory = selectedCategory === "all" || itemCategory === selectedCategory;
            let showByPrice = true;
            let showByPriceType = selectedPriceType === "all" || itemPriceType === selectedPriceType;
            let showByLocation = selectedLocation === "all" || itemLocation === selectedLocation;

            if (selectedPriceRange !== "all") {
                const [min, max] = selectedPriceRange.split("-").map(num => num.endsWith("+") ? Infinity : parseFloat(num));
                showByPrice = itemPrice >= min && (max === Infinity || itemPrice <= max);
            }

            if (showByCategory && showByPrice && showByPriceType && showByLocation) {
                item.style.display = "block";
                visibleCount++;
            } else {
                item.style.display = "none";
            }
        });

        document.getElementById("noResultsMessage").style.display = visibleCount === 0 ? "block" : "none";
    }

    categoryFilter.addEventListener("change", filterServices);
    priceFilter.addEventListener("change", filterServices);
    priceTypeFilter.addEventListener("change", filterServices);
    locationFilter.addEventListener("change", filterServices);
    filterServices();
    document.querySelectorAll(".service-item").forEach(item => {
    item.addEventListener("click", () => {
        document.getElementById("serviceModalLabel").textContent = item.getAttribute("data-name");
        document.getElementById("serviceDescription").textContent = item.getAttribute("data-description");
        document.getElementById("serviceAddress").textContent = item.getAttribute("data-address");
        document.getElementById("serviceContact").textContent = item.getAttribute("data-contact");
        document.getElementById("serviceEmail").textContent = item.getAttribute("data-email");
        document.getElementById("servicePrice").textContent = item.getAttribute("data-price");
        document.getElementById("servicePriceType").textContent = item.getAttribute("data-price-type");

        var serviceModal = new bootstrap.Modal(document.getElementById("serviceModal"));
        serviceModal.show();
    });
});

});
</script>
