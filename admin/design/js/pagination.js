function initializePagination(data, rowsPerPage, tableId, paginationId, renderTable) {
    let currentPage = 1;

    function displayData() {
        const tableBody = document.getElementById(tableId).querySelector('tbody');
        tableBody.innerHTML = '';
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedData = data.slice(start, end);

        tableBody.insertAdjacentHTML('beforeend', renderTable(paginatedData, start));
        displayPagination();
    }

    function displayPagination() {
        const pagination = document.getElementById(paginationId);
        pagination.innerHTML = '';
        const totalPages = Math.ceil(data.length / rowsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const pageItem = `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link me-2" onclick="changePage(${i})">${i}</a>
                </li>
            `;
            pagination.insertAdjacentHTML('beforeend', pageItem);
        }
    }

    function changePage(page) {
        currentPage = page;
        displayData();
    }

    window.changePage = changePage;  // Expose changePage to global scope
    displayData();
}
