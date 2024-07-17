import gsap from 'gsap';
import ScrollTrigger from 'gsap/dist/ScrollTrigger';

const proto = {
    init () {
        const containers = document.querySelectorAll('.gsap-slide');
        gsap.registerPlugin(ScrollTrigger);

        containers.forEach((container) => {
            const items = container.querySelectorAll('.slide--item');

            gsap.from(items, {
                y: 100,
                opacity: 0,
                duration: 0.5,
                stagger: 0.1, // Adjust the stagger interval here (0.1 seconds)
                // ease: 'power1.inOut',
                scrollTrigger: {
                    markers: false,
                    start: 'top 85%',
                    trigger: container,
                    // toggleActions: "play none none reset",
                    toggleActions: 'play none none reverse'
                    // toggleActions: 'play reverse play reverse'
                }
            });
        });
    }
};

export default Object.create(proto);
