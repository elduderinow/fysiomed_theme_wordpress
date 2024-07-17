import Choices from 'choices.js';

const proto = {
    init() {
        const choices = Array.from(document.querySelectorAll('.js-choice'));
        const gform = Array.from(document.querySelectorAll('.ginput_container_select select'));

        const dropdowns = [...choices, ...gform];

        dropdowns.forEach((dropdown) => {
            const _ = new Choices(dropdown, {
                searchEnabled: false,
                itemSelectText: ''
            });
        });
    }
};

export default Object.create(proto);
