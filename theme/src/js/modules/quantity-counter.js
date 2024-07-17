const proto = {
    init () {
        const counters = [...document.querySelectorAll('.quantity--counter')];
        let loopCount = 0;
        if (counters) {
            counters.forEach((counter) => {
                const minus = counter.getElementsByClassName('subtract')[0];
                const plus = counter.getElementsByClassName('add')[0];
                let input = counter.getElementsByClassName('input-text')[0];
                const event = new Event('input', {
                    bubbles: true,
                    cancelable: true
                });
                const calculate = (type) => {
                    input.dispatchEvent(event);
                    if (type === 'subtract' && parseInt(input.value, 10) < 2) {
                        return;
                    }
                    if (type === 'add') {
                        input.value = parseInt(input.value, 10) + 1;
                        return;
                    }
                    type === 'add' ? input.value = parseInt(input.value, 10) + 1 : input.value = parseInt(input.value, 10) - 1;
                };
                if (loopCount < 1) {
                    minus.addEventListener('click', () => calculate('subtract'));
                    plus.addEventListener('click', () => calculate('add'));
                    loopCount++;
                } else {
                    loopCount = 0;
                }
            });
        }
    }
};

export default Object.create(proto);
