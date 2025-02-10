<h1 class="pageTitle text-center">Our Services</h1>
<hr class="mx-auto bg-primary border-primary opacity-100" style="width:50px">
<div class="container-sm">
    <?php 
    $categories = $conn->query("SELECT DISTINCT `category` FROM `service_list` WHERE `status` = 1 ORDER BY `category` ASC")->fetch_all(MYSQLI_ASSOC);
    $services = $conn->query("SELECT * FROM `service_list` WHERE `status` = 1 ORDER BY `name` ASC")->fetch_all(MYSQLI_ASSOC);
    ?>

    <!-- Filters Container -->
    <div class="row mb-4">
        <!-- Category Filter -->
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
        
        <!-- Price Filter -->
        <div class="col-md-3">
            <select class="form-select" id="priceFilter">
                <option value="all">All Prices</option>
                <option value="0-1000">$0 - $1,000</option>
                <option value="1001-5000">$1,001 - $5,000</option>
                <option value="5001-10000">$5,001 - $10,000</option>
                <option value="10001+">$10,001+</option>
            </select>
        </div>

        <!-- Price Type Filter -->
        <div class="col-md-3">
            <select class="form-select" id="priceTypeFilter">
                <option value="all">All Price Types</option>
                <option value="fixed">Fixed</option>
                <option value="negotiable">Negotiable</option>
            </select>
        </div>
    </div>

    <!-- Services -->
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
                    <p><strong>Price:</strong> <?= htmlspecialchars($row['price_details']) ?></p>
                    <p><strong>Price Type:</strong> <?= ucfirst(htmlspecialchars($row['price_type'])) ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <!-- Message for no matching services after filtering -->
        <p id="noResultsMessage" class="text-muted text-center" style="display: none;">No services match your selected filters.</p>
    </div>

    <?php if(count($services) <= 0): ?>
        <div class="text-muted text-center">No Service Listed Yet</div>
    <?php endif; ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const serviceItems = document.querySelectorAll(".service-item");
    const categoryFilter = document.getElementById("categoryFilter");
    const priceFilter = document.getElementById("priceFilter");
    const priceTypeFilter = document.getElementById("priceTypeFilter");
    
    function filterServices() {
        const selectedCategory = categoryFilter.value;
        const selectedPriceRange = priceFilter.value;
        const selectedPriceType = priceTypeFilter.value;
        let visibleCount = 0;

        serviceItems.forEach(item => {
            const itemCategory = item.getAttribute("data-category");
            const itemPrice = parseFloat(item.getAttribute("data-price-amount")) || 0;
            const itemPriceType = item.getAttribute("data-price-type");
            
            let showByCategory = selectedCategory === "all" || itemCategory === selectedCategory;
            let showByPrice = true;
            let showByPriceType = selectedPriceType === "all" || itemPriceType === selectedPriceType;

            if (selectedPriceRange !== "all") {
                const [min, max] = selectedPriceRange.split("-").map(num => 
                    num.endsWith("+") ? Infinity : parseFloat(num)
                );
                showByPrice = itemPrice >= min && (max === Infinity || itemPrice <= max);
            }

            if (showByCategory && showByPrice && showByPriceType) {
                item.style.display = "block";
                visibleCount++;
            } else {
                item.style.display = "none";
            }
        });

        document.getElementById("noResultsMessage").style.display = visibleCount === 0 ? "block" : "none";
    }

    // Add event listeners for all filters
    categoryFilter.addEventListener("change", filterServices);
    priceFilter.addEventListener("change", filterServices);
    priceTypeFilter.addEventListener("change", filterServices);

    // Initial filter on page load
    filterServices();

    // Service item click handler (for modal)
    serviceItems.forEach(item => {
        item.addEventListener("click", () => {
            document.getElementById("serviceModalLabel").innerText = item.getAttribute("data-name");
            document.getElementById("serviceDescription").innerHTML = item.getAttribute("data-description");
            document.getElementById("serviceAddress").innerText = item.getAttribute("data-address");
            document.getElementById("serviceContact").innerText = item.getAttribute("data-contact");
            document.getElementById("serviceEmail").innerText = item.getAttribute("data-email");
            document.getElementById("servicePrice").innerText = item.getAttribute("data-price");
            document.getElementById("servicePriceType").innerText = ucfirst(item.getAttribute("data-price-type"));

            var serviceModal = new bootstrap.Modal(document.getElementById('serviceModal'));
            serviceModal.show();
        });
    });
});
</script>
