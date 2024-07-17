const proto = {
    init () {
        const filterButton = document.querySelectorAll('.woo--archive-filter-button .button--filter .button--main')[0];
        const filterContainer = document.querySelectorAll('.woo--archive .filters-wrapper')[0];
        const body = document.querySelectorAll('body')[0];
        filterButton && filterButton.addEventListener('click', () => {
            filterContainer.classList.add('show');
            body.classList.add('block-scroll');
        });
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('archive-filters--backdrop')) {
                filterContainer.classList.remove('show');
                body.classList.remove('block-scroll');
            }
        });
    }
};

export default Object.create(proto);
