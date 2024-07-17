const proto = {
    handleSearchBarState: (state) => {
        const searchBar = document.querySelector('.global--search-bar--wrapper');
        const body = document.querySelector('body');
        const searchField = searchBar.querySelector('.wp-block-search__input');

        if (state === 'show') {
            searchBar.classList.add('show');
            body.classList.add('block-scroll');
            searchField.focus();
        } else if (state.target.classList.contains('search-bar--backdrop')) {
            searchBar.classList.remove('show');
            body.classList.remove('block-scroll');
        }
    },
    init () {
        const searchButton = document.querySelectorAll('.main-nav .search__icon')[0];
        const archiveSearchButton = document.querySelectorAll('.woo--archive .woo--archive-filter-button .button--search .button--main')[0];

        searchButton && searchButton.addEventListener('click', () => proto.handleSearchBarState('show'));
        archiveSearchButton && archiveSearchButton.addEventListener('click', () => proto.handleSearchBarState('show'));
        document.addEventListener('click', (e) => proto.handleSearchBarState(e));
    }
};

export default Object.create(proto);
