// Main application entrypoint.
// Add any site-wide JavaScript here.
console.log('App JS loaded.');

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (!target) return;
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});

const revealEls = document.querySelectorAll(
    '.skill-card, .services__card, .exp-item, .about__content, .newsletter__content'
);

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            // stagger siblings
            const siblings = [...entry.target.parentElement.children];
            const delay = siblings.indexOf(entry.target) * 80;
            setTimeout(() => entry.target.classList.add('visible'), delay);
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.12 });

revealEls.forEach(el => {
    el.classList.add('scroll-reveal');
    observer.observe(el);
});
