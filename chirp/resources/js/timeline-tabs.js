const slider = document.getElementById('tab-slider');
const tabs = document.querySelectorAll('[data-tab]');

if (slider && tabs.length > 0) {
    const defaultTab = document.querySelector('[data-tab="for-you"]');

    if(defaultTab) {
        defaultTab.classList.add('text-white');
    }

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            const isFollowing = tab.dataset.tab === 'following';
            slider.classList.toggle('translate-x-full', isFollowing);
            tabs.forEach((button) => {
                button.classList.toggle(
                    'font-semibold',
                    button === tab
                );
                button.classList.toggle(
                    'text-white',
                    button === tab
                )
            });
        });
    });
}