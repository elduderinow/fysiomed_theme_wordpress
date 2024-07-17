const proto = {
    init () {
        const buttons = [...document.querySelectorAll('.accordion--comp .faq-title')];
        const listContainers = [...document.querySelectorAll('.list-item--inner')];
        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                const thisContainer = button.closest('.list-item--inner');
                const allContainers = [...listContainers.filter((cont) => cont !== thisContainer)];
                allContainers.forEach(cont => cont.classList.remove('open'));
                thisContainer.classList.toggle('open');
            });
        });
    }
};

export default Object.create(proto);
