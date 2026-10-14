const slider = document.getElementById('tab-slider');
const tabs = document.querySelectorAll('[data-tab]');

const forYouFeed = document.getElementById('for-you');
const followingFeed = document.getElementById('following');

if (slider && tabs.length > 0 && forYouFeed && followingFeed) {
    const defaultTab = document.querySelector('[data-tab="for-you"]');

    if(defaultTab) {
        defaultTab.classList.add('text-white');
    }

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            const isFollowing = tab.dataset.tab === 'following';

            slider.classList.toggle('translate-x-full', isFollowing);

            // switch
            forYouFeed.classList.toggle('hidden', isFollowing);
            followingFeed.classList.toggle('hidden', !isFollowing);

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