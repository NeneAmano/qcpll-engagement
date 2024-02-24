<!-- filter by today -->
<button type="button" class="btn btn-success mb-3 mt-3 me-2" data-bs-toggle="" data-bs-target=""><a href="clients.php?filter=today" class="text-decoration-none text-light">Today</a></button>

<!-- filter by 7 days -->
<button type="button" class="btn btn-success mb-3 mt-3 me-2" data-bs-toggle="" data-bs-target=""><a href="clients.php?filter=7days" class="text-decoration-none text-light">Past 7 Days</a></button>

<!-- filter by month -->
<div class="dropdown">
    <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Month</button>
    <div class="dropdown-content">
        <?php
            for ($month = 1; $month <= 12; $month++) {
                $month_name = date("F", mktime(0, 0, 0, $month, 1));
                echo '<a href="clients.php?filter=' . $month . '">' . $month_name . '</a>';
            }
        ?>
    </div>
</div>

<!-- filter by year -->
<div class="dropdown">
    <button class="btn btn-success dropdown-toggle mb-3 mt-3 me-2">Filter by Year</button>
    <div class="dropdown-content">
        <?php
            $sql_year = "SELECT DISTINCT YEAR(`created_at`) AS year FROM `client` ORDER BY year ASC";
            $result_year = mysqli_query($conn, $sql_year);

            while ($row_year = mysqli_fetch_assoc($result_year)) {
                $year = $row_year['year'];
                echo '<a href="clients.php?filter=' . $year . '" class="text-decoration-none text-dark">' . $year . '</a>';
            }
        ?>
    </div>
</div>